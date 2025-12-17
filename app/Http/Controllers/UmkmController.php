<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Tampilkan form registrasi UMKM
     */
    public function create()
    {
        return view('pages.registrasi-umkm');
    }

    /**
     * Simpan data registrasi UMKM
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            // Data Usaha
            'nama_usaha' => 'required|string|max:255',
            'bidang_usaha' => 'required|in:Makanan & Minuman,Fashion,Kerajinan / Handmade,Pertanian / Perikanan,Jasa,Lainnya',
            'status_legalitas' => 'required|in:Sudah Berizin,Belum Berizin',
            'jenis_legalitas' => 'nullable|in:NIB,PIRT,Halal,BPOM,Sertifikat Lainnya,Lainnya',
            'tahun_berdiri' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            
            // Data Pribadi
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date|before:today',
            'nomor_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'email' => 'required|email|max:255',
            'alamat_domisili' => 'required|string',
            
            // Data Lainnya
            'platform_digital' => 'required|in:Ya,Tidak',
            'platform' => 'required|array|min:1',
            'platform.*' => 'in:Instagram,Facebook,Tiktok,Shopee,Tokopedia,Website Sendiri,Lainnya',
            'pendapatan' => 'required|in:1 juta s/d 10 juta,10 juta s/d 100 juta,100 juta s/d 500 juta,500 juta s/d 1 miliar,Lebih dari 1 miliar',
            'pembiayaan' => 'nullable|in:Ya,Tidak',
            'sumber_pembiayaan' => 'nullable|in:Bank,Fintech,Koperasi,Lainnya',
            'tujuan' => 'required|in:Meningkatkan penjualan online,Mendapatkan akses pembiayaan,Meningkatkan literasi keuangan,Mencari mitra atau jaringan,Lainnya',
            'pelatihan' => 'required|string',
        ], [
            // Custom error messages (opsional)
            'nama_usaha.required' => 'Nama usaha wajib diisi',
            'bidang_usaha.required' => 'Bidang usaha wajib dipilih',
            'tahun_berdiri.digits' => 'Tahun berdiri harus 4 digit',
            'tahun_berdiri.max' => 'Tahun berdiri tidak boleh lebih dari tahun sekarang',
            'nomor_hp.regex' => 'Nomor HP hanya boleh berisi angka',
            'nomor_hp.min' => 'Nomor HP minimal 10 digit',
            'email.email' => 'Format email tidak valid',
            'platform.required' => 'Pilih minimal 1 platform',
            'platform.min' => 'Pilih minimal 1 platform',
        ]);

        try {
            // Simpan data ke database
            Umkm::create($validated);

            // Redirect dengan pesan sukses
            return redirect()->route('umkm')
                ->with('success', 'Terima kasih! Pendaftaran UMKM Anda berhasil disimpan. Tim kami akan segera menghubungi Anda.');
                
        } catch (\Exception $e) {
            // Jika terjadi error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }
}