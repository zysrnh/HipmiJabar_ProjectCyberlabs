<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'nama_usaha',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nomor_telepon',
        'domisili',
        'alamat_domisili',
        'kode_pos',
        'email',
        'nomor_ktp',
        'foto_ktp',
        'foto_diri',
        'nama_usaha_perusahaan',
        'legalitas_usaha',
        'jabatan_usaha',
        'alamat_kantor',
        'bidang_usaha',
        'brand_usaha',
        'jumlah_karyawan',
        'nomor_ktp_perusahaan',
        'usia_perusahaan',
        'omset_perusahaan',
        'npwp_perusahaan',
        'no_nota_pendirian',
        'profile_perusahaan',
        'logo_perusahaan',
        'sfc_hipmi',
        'referensi_hipmi',
        'organisasi_lain',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'approved_at' => 'datetime',
    ];

    // Relationship dengan Admin yang approve
    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    // Accessor untuk URL foto KTP
    public function getFotoKtpUrlAttribute()
    {
        return $this->foto_ktp ? Storage::url($this->foto_ktp) : null;
    }

    // Accessor untuk URL foto diri
    public function getFotoDiriUrlAttribute()
    {
        return $this->foto_diri ? Storage::url($this->foto_diri) : null;
    }

    // Accessor untuk URL profile perusahaan
    public function getProfilePerusahaanUrlAttribute()
    {
        return $this->profile_perusahaan ? Storage::url($this->profile_perusahaan) : null;
    }

    // Accessor untuk URL logo perusahaan
    public function getLogoPerusahaanUrlAttribute()
    {
        return $this->logo_perusahaan ? Storage::url($this->logo_perusahaan) : null;
    }

    // Scope untuk filter berdasarkan status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Method untuk approve anggota
    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $adminId,
            'rejection_reason' => null,
        ]);
    }

    // Method untuk reject anggota
    public function reject($reason, $adminId)
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_by' => $adminId,
            'approved_at' => null,
        ]);

    }
    // Tambahkan method ini di class Anggota
public function getPhotoUrlAttribute()
{
    if ($this->foto_diri) {
        return Storage::url($this->foto_diri);
    }
    
    // Gunakan placeholder berdasarkan jenis kelamin
    return $this->jenis_kelamin === 'Perempuan' 
        ? asset('images/placeholder/female_ph.jpeg') 
        : asset('images/placeholder/male_ph.jpeg');
}

}