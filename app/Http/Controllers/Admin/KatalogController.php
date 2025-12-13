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
            'map_embed_url' => 'nullable|url',
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
            'map_embed_url' => 'nullable|url',
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