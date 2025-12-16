<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Berita::active()->latestPublish();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('konten', 'like', '%' . $search . '%');
            });
        }

        // Berita utama (paling baru)
        $beritaUtama = $query->first();

        // Berita lainnya (skip berita utama)
        $beritas = Berita::active()
            ->latestPublish()
            ->when($beritaUtama, function($q) use ($beritaUtama) {
                $q->where('id', '!=', $beritaUtama->id);
            })
            ->when($search, function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('judul', 'like', '%' . $search . '%')
                          ->orWhere('konten', 'like', '%' . $search . '%');
                });
            })
            ->paginate(5);

        // Berita populer (5 terbaru)
        $beritaPopuler = Berita::active()
            ->populer()
            ->latestPublish()
            ->take(5)
            ->get();

        // Berita terbaru (5 terbaru, exclude yang sudah tampil)
        $excludeIds = collect([$beritaUtama?->id])
            ->merge($beritas->pluck('id'))
            ->merge($beritaPopuler->pluck('id'))
            ->filter()
            ->unique()
            ->values();

        $beritaTerbaru = Berita::active()
            ->latestPublish()
            ->whereNotIn('id', $excludeIds)
            ->take(5)
            ->get();

        return view('pages.berita', compact(
            'beritaUtama',
            'beritas',
            'beritaPopuler',
            'beritaTerbaru',
            'search'
        ));
    }

    public function show($slug)
    {
        $berita = Berita::active()->where('slug', $slug)->firstOrFail();

        // Increment views
        $berita->incrementViews();

        // Berita populer (5 terbaru, exclude current)
        $beritaPopuler = Berita::active()
            ->populer()
            ->where('id', '!=', $berita->id)
            ->latestPublish()
            ->take(5)
            ->get();

        // Berita terbaru (5 terbaru, exclude current)
        $beritaTerbaru = Berita::active()
            ->where('id', '!=', $berita->id)
            ->latestPublish()
            ->take(5)
            ->get();

        return view('pages.details.berita-detail', compact(
            'berita',
            'beritaPopuler',
            'beritaTerbaru'
        ));
    }
}