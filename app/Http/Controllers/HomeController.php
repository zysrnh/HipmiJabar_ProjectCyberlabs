<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 katalog terbaru untuk ditampilkan
        $katalogs = Katalog::where('is_active', true)
                          ->latest()
                          ->limit(8)
                          ->get();
        
        // Hitung total semua katalog aktif
        $totalKatalog = Katalog::where('is_active', true)->count();
        
        return view('pages.home', compact('katalogs', 'totalKatalog'));
    }
}