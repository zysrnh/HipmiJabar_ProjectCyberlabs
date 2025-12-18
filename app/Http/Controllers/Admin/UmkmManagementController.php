<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmManagementController extends Controller
{
    /**
     * Display a listing of UMKM submissions
     */
    public function index(Request $request)
    {
        $query = Umkm::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nomor_hp', 'like', "%{$search}%");
            });
        }

        // Sort by latest
        $umkms = $query->latest()->paginate(10);

        // Statistics
        $stats = [
            'total' => Umkm::count(),
            'pending' => Umkm::where('status', 'pending')->count(),
            'approved' => Umkm::where('status', 'approved')->count(),
            'rejected' => Umkm::where('status', 'rejected')->count(),
        ];

        return view('admin.umkm.index', compact('umkms', 'stats'));
    }

    /**
     * Display the specified UMKM
     */
    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.umkm.show', compact('umkm'));
    }

    /**
     * Approve UMKM
     */
    public function approve($id)
    {
        $umkm = Umkm::findOrFail($id);
        
        $umkm->update([
            'status' => 'approved',
            'verified_at' => now(),
            'verified_by' => auth()->guard('admin')->id()
        ]);

        return redirect()->back()->with('success', 'UMKM berhasil disetujui!');
    }

    /**
     * Reject UMKM
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $umkm = Umkm::findOrFail($id);
        
        $umkm->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'verified_at' => now(),
            'verified_by' => auth()->guard('admin')->id()
        ]);

        return redirect()->back()->with('success', 'UMKM berhasil ditolak!');
    }

    /**
     * Delete UMKM
     */
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil dihapus!');
    }

    /**
     * Export UMKM data to Excel/CSV
     */
    public function export(Request $request)
    {
        // Implementation for export functionality
        // You can use Laravel Excel package for this
    }
}