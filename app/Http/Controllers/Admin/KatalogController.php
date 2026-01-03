<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    /**
     * Cek apakah admin bisa edit/hapus katalog ini
     */
    private function canManageKatalog(Katalog $katalog)
    {
        $admin = Auth::guard('admin')->user();
        
        // Super Admin bisa manage semua
        if ($admin->isSuperAdmin()) {
            return true;
        }
        
        // Katalog dari anggota tidak bisa diedit/dihapus (hanya approve/reject)
        if ($katalog->isSubmittedByAnggota()) {
            return false;
        }
        
        // Admin BPD hanya bisa manage katalog dari bidangnya sendiri
        if ($admin->isBPD()) {
            // Cek apakah katalog dibuat oleh admin dengan bidang yang sama
            if ($katalog->admin && $katalog->admin->bidang === $admin->bidang) {
                return true;
            }
            return false;
        }
        
        // BPC bisa manage katalog yang dia buat sendiri
        if ($admin->isBPC()) {
            return $katalog->approved_by === $admin->id;
        }
        
        return false;
    }

    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $status = $request->get('status', 'all');

        $query = Katalog::with(['anggota', 'admin']);

        // Filter berdasarkan status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Stats untuk semua katalog
        $stats = [
            'total' => Katalog::count(),
            'pending' => Katalog::where('status', 'pending')->count(),
            'approved' => Katalog::where('status', 'approved')->count(),
            'rejected' => Katalog::where('status', 'rejected')->count(),
        ];

        $katalogs = $query->latest()->paginate(15)->appends(['status' => $status]);

        return view('admin.katalog.index', compact('katalogs', 'stats', 'status'));
    }

    public function create()
    {
        return view('admin.katalog.create');
    }

    private function extractGoogleMapsUrl($input)
    {
        if (empty($input)) {
            return null;
        }

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

    public function store(Request $request)
    {
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
            'is_active' => 'boolean'
        ]);

        try {
            $logoPath = $request->file('logo')->store('katalog/logos', 'public');

            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('katalog/images', 'public');
                }
            }

            $mapUrl = null;
            if ($request->filled('map_embed_url')) {
                $mapUrl = $this->extractGoogleMapsUrl($request->map_embed_url);
            }

            $admin = Auth::guard('admin')->user();

            Katalog::create([
                'anggota_id' => null,
                'company_name' => $validated['company_name'],
                'business_field' => $validated['business_field'],
                'description' => $validated['description'],
                'logo' => $logoPath,
                'images' => $imagePaths,
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'map_embed_url' => $mapUrl,
                'status' => 'approved',
                'is_active' => $request->has('is_active') ? true : false,
                'approved_at' => now(),
                'approved_by' => $admin->id,
            ]);

            return redirect()->route('admin.katalog.index')
                ->with('success', 'Data katalog berhasil ditambahkan');
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
        // ✅ Cek permission
        if (!$this->canManageKatalog($katalog)) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit katalog ini.');
        }

        return view('admin.katalog.edit', compact('katalog'));
    }

    public function update(Request $request, Katalog $katalog)
    {
        // ✅ Cek permission
        if (!$this->canManageKatalog($katalog)) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit katalog ini.');
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
            'is_active' => 'boolean'
        ]);

        try {
            $data = $request->except(['logo', 'images']);

            if ($request->hasFile('logo')) {
                if ($katalog->logo && Storage::disk('public')->exists($katalog->logo)) {
                    Storage::disk('public')->delete($katalog->logo);
                }
                $data['logo'] = $request->file('logo')->store('katalog/logos', 'public');
            }

            if ($request->hasFile('images')) {
                if ($katalog->images) {
                    foreach ($katalog->images as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }

                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('katalog/images', 'public');
                }
                $data['images'] = $imagePaths;
            }

            if ($request->filled('map_embed_url')) {
                $data['map_embed_url'] = $this->extractGoogleMapsUrl($request->map_embed_url);
            }

            $data['is_active'] = $request->has('is_active');

            $katalog->update($data);

            return redirect()->route('admin.katalog.index')
                ->with('success', 'Data katalog berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Katalog $katalog)
    {
        // ✅ Cek permission
        if (!$this->canManageKatalog($katalog)) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus katalog ini.');
        }

        // ✅ Katalog approved dari anggota tidak bisa dihapus
        if ($katalog->isSubmittedByAnggota() && $katalog->status === 'approved') {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Katalog yang sudah disetujui tidak bisa dihapus.');
        }

        if ($katalog->logo && Storage::disk('public')->exists($katalog->logo)) {
            Storage::disk('public')->delete($katalog->logo);
        }

        if ($katalog->images) {
            foreach ($katalog->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $katalog->delete();

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Data katalog berhasil dihapus');
    }

    public function approve(Katalog $katalog)
    {
        if (!$katalog->isSubmittedByAnggota()) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Hanya katalog dari anggota yang bisa diapprove.');
        }

        if ($katalog->status !== 'pending') {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Katalog sudah diproses sebelumnya.');
        }

        $admin = Auth::guard('admin')->user();
        $katalog->approve($admin->id);

        return redirect()->route('admin.katalog.index')
            ->with('success', "Katalog {$katalog->company_name} berhasil disetujui!");
    }

    public function reject(Request $request, Katalog $katalog)
    {
        if (!$katalog->isSubmittedByAnggota()) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Hanya katalog dari anggota yang bisa direject.');
        }

        if ($katalog->status !== 'pending') {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Katalog sudah diproses sebelumnya.');
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $admin = Auth::guard('admin')->user();
        $katalog->reject($request->alasan_penolakan, $admin->id);

        return redirect()->route('admin.katalog.index')
            ->with('success', "Katalog {$katalog->company_name} berhasil ditolak.");
    }
}