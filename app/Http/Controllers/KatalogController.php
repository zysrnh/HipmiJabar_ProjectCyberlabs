<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Katalog::with(['anggota', 'admin'])
            ->where('status', 'approved')
            ->where('is_active', true);

        // Filter Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('business_field', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter Bidang (untuk katalog dari pengurus/admin)
        if ($request->has('bidang') && $request->bidang != '') {
            $bidang = $request->bidang;
            
            // Filter katalog yang dibuat oleh admin dengan bidang tertentu
            $query->whereHas('admin', function($q) use ($bidang) {
                $q->where('bidang', $bidang);
            });
        }

        // Filter Tipe (Anggota atau Pengurus)
        if ($request->has('tipe') && $request->tipe != '') {
            if ($request->tipe === 'anggota') {
                // Katalog dari anggota (anggota_id tidak null)
                $query->whereNotNull('anggota_id');
            } elseif ($request->tipe === 'pengurus') {
                // Katalog dari pengurus/admin (anggota_id null)
                $query->whereNull('anggota_id');
            }
        }

        $katalogs = $query->latest()->paginate(12)->withQueryString();

        return view('pages.ekatalog', compact('katalogs'));
    }

    public function show(Katalog $katalog)
    {
        // Pastikan katalog sudah approved dan aktif
        if ($katalog->status !== 'approved' || !$katalog->is_active) {
            abort(404);
        }

        // Load relationships
        $katalog->load(['anggota', 'admin']);

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