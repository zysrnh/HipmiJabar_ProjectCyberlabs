<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnggotaKatalogController extends Controller
{
    public function index()
    {
        $anggota = Auth::guard('anggota')->user();
        $katalogs = $anggota->katalogs()->latest()->paginate(10);

        $stats = [
            'total' => $anggota->katalogs()->count(),
            'pending' => $anggota->pendingKatalogs()->count(),
            'approved' => $anggota->approvedKatalogs()->count(),
            'rejected' => $anggota->katalogs()->where('status', 'rejected')->count(),
        ];

        return view('anggota.katalog.index', compact('katalogs', 'stats'));
    }

    public function create()
    {
        $anggota = Auth::guard('anggota')->user();

        // Hanya anggota yang approved bisa submit katalog
        if ($anggota->status !== 'approved') {
            return redirect()->route('profile-anggota')
                ->with('error', 'Anda harus terverifikasi terlebih dahulu untuk menambahkan katalog.');
        }

        return view('anggota.katalog.create');
    }

    public function store(Request $request)
    {
        $anggota = Auth::guard('anggota')->user();

        if ($anggota->status !== 'approved') {
            return redirect()->route('profile-anggota')
                ->with('error', 'Anda harus terverifikasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_field' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'map_embed_url' => 'nullable|string',
        ]);

        try {
            // Upload logo
            $logoPath = $request->file('logo')->store('katalog/logos', 'public');

            // Upload images
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('katalog/images', 'public');
                }
            }

            // Auto-extract Google Maps URL (copy dari AdminKatalogController)
            $mapUrl = null;
            if ($request->filled('map_embed_url')) {
                $mapUrl = $this->extractGoogleMapsUrl($request->map_embed_url);
            }

            Katalog::create([
                'anggota_id' => $anggota->id,
                'company_name' => $validated['company_name'],
                'business_field' => $validated['business_field'],
                'description' => $validated['description'],
                'logo' => $logoPath,
                'images' => $imagePaths,
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'map_embed_url' => $mapUrl,
                'status' => 'pending',
                'submitted_at' => now(),
                'is_active' => false,
            ]);

            return redirect()->route('profile-anggota.katalog.index')
                ->with('success', 'Katalog berhasil disubmit! Menunggu persetujuan admin.');

        } catch (\Exception $e) {
            if (isset($logoPath)) Storage::disk('public')->delete($logoPath);
            if (isset($imagePaths)) {
                foreach ($imagePaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Katalog $katalog)
    {
        $anggota = Auth::guard('anggota')->user();

        // Cek ownership
        if ($katalog->anggota_id !== $anggota->id) {
            abort(403, 'Anda tidak memiliki akses ke katalog ini.');
        }

        // Hanya bisa edit kalau pending atau rejected
        if (!$katalog->canBeEdited()) {
            return redirect()->route('profile-anggota.katalog.index')
                ->with('error', 'Katalog yang sudah disetujui tidak bisa diedit.');
        }

        return view('anggota.katalog.edit', compact('katalog'));
    }

    public function update(Request $request, Katalog $katalog)
    {
        $anggota = Auth::guard('anggota')->user();

        if ($katalog->anggota_id !== $anggota->id) {
            abort(403);
        }

        if (!$katalog->canBeEdited()) {
            return redirect()->route('profile-anggota.katalog.index')
                ->with('error', 'Katalog yang sudah disetujui tidak bisa diedit.');
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_field' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'map_embed_url' => 'nullable|string',
        ]);

        try {
            $data = $request->except(['logo', 'images']);

            // Upload logo baru
            if ($request->hasFile('logo')) {
                if ($katalog->logo) Storage::disk('public')->delete($katalog->logo);
                $data['logo'] = $request->file('logo')->store('katalog/logos', 'public');
            }

            // Upload images baru
            if ($request->hasFile('images')) {
                if ($katalog->images) {
                    foreach ($katalog->images as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('katalog/images', 'public');
                }
                $data['images'] = $imagePaths;
            }

            // Auto-extract Google Maps URL
            if ($request->filled('map_embed_url')) {
                $data['map_embed_url'] = $this->extractGoogleMapsUrl($request->map_embed_url);
            }

            // Reset ke pending kalau diupdate setelah rejected
            $data['status'] = 'pending';
            $data['submitted_at'] = now();
            $data['rejection_reason'] = null;

            $katalog->update($data);

            return redirect()->route('profile-anggota.katalog.index')
                ->with('success', 'Katalog berhasil diperbarui dan akan direview kembali.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Katalog $katalog)
    {
        $anggota = Auth::guard('anggota')->user();

        if ($katalog->anggota_id !== $anggota->id) {
            abort(403);
        }

        // Hanya bisa hapus kalau pending atau rejected
        if (!$katalog->canBeEdited()) {
            return redirect()->route('profile-anggota.katalog.index')
                ->with('error', 'Katalog yang sudah disetujui tidak bisa dihapus.');
        }

        // Hapus files
        if ($katalog->logo) Storage::disk('public')->delete($katalog->logo);
        if ($katalog->images) {
            foreach ($katalog->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $katalog->delete();

        return redirect()->route('profile-anggota.katalog.index')
            ->with('success', 'Katalog berhasil dihapus.');
    }

    // Helper function (sama seperti AdminKatalogController)
    private function extractGoogleMapsUrl($input)
    {
        if (empty($input)) return null;

        $input = trim($input);

        if (strpos($input, 'maps/embed') !== false) {
            if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
                return $matches[1];
            }
            return $input;
        }

        if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
            $url = $matches[1];
            if (strpos($url, 'google.com/maps') !== false) {
                return $url;
            }
        }

        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
            return "https://www.google.com/maps?q={$lat},{$lng}&output=embed";
        }

        if (preg_match('/place_id[=:]([A-Za-z0-9_-]+)/', $input, $matches)) {
            $placeId = $matches[1];
            return "https://www.google.com/maps?q=place_id:{$placeId}&output=embed";
        }

        if (preg_match('/maps\/search\/([^\/\?&]+)/', $input, $matches)) {
            $query = urldecode($matches[1]);
            return "https://www.google.com/maps?q=" . urlencode($query) . "&output=embed";
        }

        if (strpos($input, 'google.com/maps') !== false || strpos($input, 'maps.app.goo.gl') !== false) {
            return $input;
        }

        return null;
    }
}