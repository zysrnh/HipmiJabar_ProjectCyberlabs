<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index()
    {
        $katalogs = Katalog::latest()->paginate(10);
        return view('admin.katalog.index', compact('katalogs'));
    }

    public function create()
    {
        return view('admin.katalog.create');
    }

    /**
     * Extract Google Maps embed URL from various formats
     */
    private function extractGoogleMapsUrl($input)
    {
        if (empty($input)) {
            return null;
        }

        // Clean input
        $input = trim($input);

        // Jika sudah format embed URL yang benar
        if (strpos($input, 'maps/embed') !== false) {
            // Extract URL dari iframe jika ada
            if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
                return $matches[1];
            }
            return $input;
        }

        // Extract dari iframe (format apapun)
        if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
            $url = $matches[1];
            if (strpos($url, 'google.com/maps') !== false) {
                return $url;
            }
        }

        // Extract koordinat dari Google Maps URL biasa
        // Format: https://www.google.com/maps/place/.../@-6.9034495,107.6189571,17z/...
        // atau: https://www.google.com/maps/@-6.9034495,107.6189571,17z/...
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
            // Gunakan format query sederhana yang lebih reliable
            return "https://www.google.com/maps?q={$lat},{$lng}&output=embed";
        }

        // Extract place_id dari URL
        if (preg_match('/place_id[=:]([A-Za-z0-9_-]+)/', $input, $matches)) {
            $placeId = $matches[1];
            return "https://www.google.com/maps?q=place_id:{$placeId}&output=embed";
        }

        // Extract dari search query URL
        // Format: https://www.google.com/maps/search/Location+Name
        if (preg_match('/maps\/search\/([^\/\?&]+)/', $input, $matches)) {
            $query = urldecode($matches[1]);
            return "https://www.google.com/maps?q=" . urlencode($query) . "&output=embed";
        }

        // Jika format tidak dikenali tapi ada google.com/maps, coba sebagai fallback
        if (strpos($input, 'google.com/maps') !== false || strpos($input, 'maps.app.goo.gl') !== false) {
            // Simpan URL asli, akan di-handle di frontend atau manual
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'map_embed_url' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        // Upload logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('katalog/logos', 'public');
            $validated['logo'] = $logoPath;
        }

        // Upload multiple images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('katalog/images', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        // Auto-extract Google Maps URL
        if ($request->filled('map_embed_url')) {
            $validated['map_embed_url'] = $this->extractGoogleMapsUrl($request->map_embed_url);
        }

        $validated['is_active'] = $request->has('is_active');

        Katalog::create($validated);

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Data katalog berhasil ditambahkan');
    }

    public function edit(Katalog $katalog)
    {
        return view('admin.katalog.edit', compact('katalog'));
    }

    public function update(Request $request, Katalog $katalog)
    {
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

        // Upload logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($katalog->logo && Storage::disk('public')->exists($katalog->logo)) {
                Storage::disk('public')->delete($katalog->logo);
            }
            $validated['logo'] = $request->file('logo')->store('katalog/logos', 'public');
        }

        // Upload images baru jika ada
        if ($request->hasFile('images')) {
            // Hapus images lama
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
            $validated['images'] = $imagePaths;
        }

        // Auto-extract Google Maps URL
        if ($request->filled('map_embed_url')) {
            $validated['map_embed_url'] = $this->extractGoogleMapsUrl($request->map_embed_url);
        }

        $validated['is_active'] = $request->has('is_active');

        $katalog->update($validated);

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Data katalog berhasil diperbarui');
    }

    public function destroy(Katalog $katalog)
    {
        // Hapus logo
        if ($katalog->logo && Storage::disk('public')->exists($katalog->logo)) {
            Storage::disk('public')->delete($katalog->logo);
        }

        // Hapus images
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
}