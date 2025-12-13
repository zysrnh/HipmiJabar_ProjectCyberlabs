<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $katalogs = Katalog::where('is_active', true)
                          ->latest()
                          ->limit(8)
                          ->get();
        
        return view('pages.home', compact('katalogs'));
    }
}