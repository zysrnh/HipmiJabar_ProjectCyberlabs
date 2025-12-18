<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Anggota extends Authenticatable
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
        'password',
        'initial_password', // ← TAMBAHKAN INI
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'approved_at' => 'datetime',
    ];

    // ... sisa method tetap sama
    
    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function getFotoKtpUrlAttribute()
    {
        return $this->foto_ktp ? Storage::url($this->foto_ktp) : null;
    }

    public function getFotoDiriUrlAttribute()
    {
        return $this->foto_diri ? Storage::url($this->foto_diri) : null;
    }

    public function getProfilePerusahaanUrlAttribute()
    {
        return $this->profile_perusahaan ? Storage::url($this->profile_perusahaan) : null;
    }

    public function getLogoPerusahaanUrlAttribute()
    {
        return $this->logo_perusahaan ? Storage::url($this->logo_perusahaan) : null;
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->foto_diri) {
            return Storage::url($this->foto_diri);
        }
        
        return $this->jenis_kelamin === 'Perempuan' 
            ? asset('images/placeholder/female_ph.jpeg') 
            : asset('images/placeholder/male_ph.jpeg');
    }

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

    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $adminId,
            'rejection_reason' => null,
        ]);
    }

    public function reject($reason, $adminId)
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_by' => $adminId,
            'approved_at' => null,
        ]);
    }
}