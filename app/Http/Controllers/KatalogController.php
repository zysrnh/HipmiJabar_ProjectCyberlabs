<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Cek apakah user sudah login dan terverifikasi
        $canViewFullDetail = $this->canViewFullDetail();

        return view('pages.details.ekatalog-detail', compact('katalog', 'canViewFullDetail'));
    }

    /**
     * Cek apakah user bisa melihat detail lengkap
     * Hanya admin atau anggota yang terverifikasi
     */
    private function canViewFullDetail()
    {
        // Jika login sebagai admin
        if (Auth::guard('admin')->check()) {
            return true;
        }

        // Jika login sebagai anggota dan statusnya approved
        if (Auth::guard('anggota')->check()) {
            $anggota = Auth::guard('anggota')->user();
            return $anggota->status === 'approved';
        }

        // Jika tidak login atau tidak memenuhi syarat
        return false;
    }
}