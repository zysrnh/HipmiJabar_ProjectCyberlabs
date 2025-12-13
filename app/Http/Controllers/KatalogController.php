<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Katalog::where('is_active', true);


        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('business_field', 'like', "%{$search}%");
            });
        }

        $katalogs = $query->latest()->paginate(12);

        return view('pages.ekatalog', compact('katalogs'));
    }

    public function show(Katalog $katalog)
    {
        
        if (!$katalog->is_active) {
            abort(404);
        }

        return view('pages.details.ekatalog-detail', compact('katalog'));
    }
}