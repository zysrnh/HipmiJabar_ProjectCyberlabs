<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaManagementController extends Controller
{
    // Method yang sudah ada untuk verifikasi (hanya untuk menu Dashboard)
    public function index(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        $status = $request->get('status', 'pending');
        $domisili = $request->get('domisili', 'all');
        
        $query = Anggota::query();
        
        if ($admin->category === 'bpc') {
            $query->where('domisili', $admin->domisili);
            
            $stats = [
                'total' => Anggota::where('domisili', $admin->domisili)->count(),
                'pending' => Anggota::where('domisili', $admin->domisili)->where('status', 'pending')->count(),
                'approved' => Anggota::where('domisili', $admin->domisili)->where('status', 'approved')->count(),
                'rejected' => Anggota::where('domisili', $admin->domisili)->where('status', 'rejected')->count(),
            ];
            
            $domisiliList = null;
            
        } elseif ($admin->category === 'bpd') {
            if ($domisili !== 'all') {
                $query->where('domisili', $domisili);
            }
            
            if ($domisili === 'all') {
                $stats = [
                    'total' => Anggota::count(),
                    'pending' => Anggota::where('status', 'pending')->count(),
                    'approved' => Anggota::where('status', 'approved')->count(),
                    'rejected' => Anggota::where('status', 'rejected')->count(),
                ];
            } else {
                $stats = [
                    'total' => Anggota::where('domisili', $domisili)->count(),
                    'pending' => Anggota::where('domisili', $domisili)->where('status', 'pending')->count(),
                    'approved' => Anggota::where('domisili', $domisili)->where('status', 'approved')->count(),
                    'rejected' => Anggota::where('domisili', $domisili)->where('status', 'rejected')->count(),
                ];
            }
            
            $domisiliList = \App\Models\Admin::where('category', 'bpc')
                ->whereNotNull('domisili')
                ->orderBy('domisili')
                ->pluck('domisili')
                ->unique()
                ->values();
        }
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $anggota = $query->latest()->paginate(15)->appends([
            'status' => $status,
            'domisili' => $domisili
        ]);
        
        return view('admin.anggota.index', compact(
            'anggota',
            'stats',
            'status',
            'domisili',
            'domisiliList'
        ));
    }

    // Method baru untuk list semua anggota (read-only)
    public function listAll(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        $status = $request->get('status', 'all');
        $domisili = $request->get('domisili', 'all');
        
        $query = Anggota::query();
        
        // Filter berdasarkan kategori admin
        if ($admin->category === 'bpc') {
            // BPC hanya bisa lihat anggota di domisilinya
            $query->where('domisili', $admin->domisili);
            
            $stats = [
                'total' => Anggota::where('domisili', $admin->domisili)->count(),
                'pending' => Anggota::where('domisili', $admin->domisili)->where('status', 'pending')->count(),
                'approved' => Anggota::where('domisili', $admin->domisili)->where('status', 'approved')->count(),
                'rejected' => Anggota::where('domisili', $admin->domisili)->where('status', 'rejected')->count(),
            ];
            
            $domisiliList = null;
            
        } elseif ($admin->category === 'bpd') {
            // BPD bisa lihat semua anggota dengan filter domisili
            if ($domisili !== 'all') {
                $query->where('domisili', $domisili);
            }
            
            if ($domisili === 'all') {
                $stats = [
                    'total' => Anggota::count(),
                    'pending' => Anggota::where('status', 'pending')->count(),
                    'approved' => Anggota::where('status', 'approved')->count(),
                    'rejected' => Anggota::where('status', 'rejected')->count(),
                ];
            } else {
                $stats = [
                    'total' => Anggota::where('domisili', $domisili)->count(),
                    'pending' => Anggota::where('domisili', $domisili)->where('status', 'pending')->count(),
                    'approved' => Anggota::where('domisili', $domisili)->where('status', 'approved')->count(),
                    'rejected' => Anggota::where('domisili', $domisili)->where('status', 'rejected')->count(),
                ];
            }
            
            // List domisili untuk dropdown
            $domisiliList = \App\Models\Admin::where('category', 'bpc')
                ->whereNotNull('domisili')
                ->orderBy('domisili')
                ->pluck('domisili')
                ->unique()
                ->values();
        }
        
        // Filter berdasarkan status
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        // Get data dengan pagination
        $anggota = $query->latest()->paginate(15)->appends([
            'status' => $status,
            'domisili' => $domisili
        ]);
        
        return view('admin.anggota.list', compact(
            'anggota',
            'stats',
            'status',
            'domisili',
            'domisiliList'
        ));
    }

    // Method untuk show detail read-only (DIPERBAIKI - pakai view yang sama)
    public function showReadOnly(Anggota $anggota)
    {
        $admin = auth()->guard('admin')->user();
        
        // BPC hanya bisa lihat anggota di domisilinya
        if ($admin->category === 'bpc' && $anggota->domisili !== $admin->domisili) {
            abort(403, 'Anda tidak memiliki akses ke data anggota ini.');
        }
        
        // FIXED: Pakai view yang sama dengan show()
        return view('admin.anggota.show', compact('anggota'));
    }

    // Method yang sudah ada (untuk verifikasi)
    public function show(Anggota $anggota)
    {
        $admin = auth()->guard('admin')->user();
        
        if ($admin->category === 'bpc' && $anggota->domisili !== $admin->domisili) {
            abort(403, 'Anda tidak memiliki akses ke data anggota ini.');
        }
        
        return view('admin.anggota.show', compact('anggota'));
    }

    public function approve(Anggota $anggota)
{
    $admin = auth()->guard('admin')->user();
    
    if ($admin->category === 'bpc' && $anggota->domisili !== $admin->domisili) {
        abort(403, 'Anda tidak memiliki akses untuk verifikasi anggota ini.');
    }
    
    // Gunakan method approve() dari Model
    $anggota->approve($admin->id);
    
    return redirect()->route('admin.anggota.index')
        ->with('success', 'Anggota berhasil disetujui!');
}

public function reject(Request $request, Anggota $anggota)
{
    $admin = auth()->guard('admin')->user();
    
    if ($admin->category === 'bpc' && $anggota->domisili !== $admin->domisili) {
        abort(403, 'Anda tidak memiliki akses untuk verifikasi anggota ini.');
    }
    
    $request->validate([
        'alasan_penolakan' => 'required|string|max:500'
    ]);
    
    // Gunakan method reject() dari Model
    $anggota->reject($request->alasan_penolakan, $admin->id);
    
    return redirect()->route('admin.anggota.index')
        ->with('success', 'Anggota berhasil ditolak!');
}

    public function destroy(Anggota $anggota)
    {
        $admin = auth()->guard('admin')->user();
        
        if ($admin->category === 'bpc' && $anggota->domisili !== $admin->domisili) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus anggota ini.');
        }
        
        // Hapus file-file terkait
        if ($anggota->foto_ktp) Storage::disk('public')->delete($anggota->foto_ktp);
        if ($anggota->foto_diri) Storage::disk('public')->delete($anggota->foto_diri);
        if ($anggota->profile_perusahaan) Storage::disk('public')->delete($anggota->profile_perusahaan);
        if ($anggota->logo_perusahaan) Storage::disk('public')->delete($anggota->logo_perusahaan);
        
        $anggota->delete();
        
        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus!');
    }
}