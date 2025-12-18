<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_usaha',
        'bidang_usaha',
        'status_legalitas',
        'jenis_legalitas',
        'tahun_berdiri',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'nomor_hp',
        'email',
        'alamat_domisili',
        'platform_digital',
        'platform',
        'pendapatan',
        'pembiayaan',
        'sumber_pembiayaan',
        'tujuan',
        'pelatihan',
        'status',
        'rejection_reason',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'platform' => 'array', // Cast JSON to array
        'tanggal_lahir' => 'date',
        'verified_at' => 'datetime',
    ];
}
