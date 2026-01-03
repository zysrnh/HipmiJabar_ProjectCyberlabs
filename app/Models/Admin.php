<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'photo',
        'password',
        'category',
        'domisili',
        'bidang', // ✅ TAMBAHAN BARU
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * ✅ TAMBAHAN: List semua bidang (1-12)
     */
    public static function getBidangList(): array
    {
        return [
            'bidang_1' => 'Bidang 1',
            'bidang_2' => 'Bidang 2',
            'bidang_3' => 'Bidang 3',
            'bidang_4' => 'Bidang 4',
            'bidang_5' => 'Bidang 5',
            'bidang_6' => 'Bidang 6',
            'bidang_7' => 'Bidang 7',
            'bidang_8' => 'Bidang 8',
            'bidang_9' => 'Bidang 9',
            'bidang_10' => 'Bidang 10',
            'bidang_11' => 'Bidang 11',
            'bidang_12' => 'Bidang 12',
        ];
    }

    /**
     * ✅ TAMBAHAN: Get nama bidang yang readable
     */
    public function getBidangNameAttribute(): ?string
    {
        $bidangList = self::getBidangList();
        return $bidangList[$this->bidang] ?? null;
    }

    public function isSuperAdmin(): bool
    {
        return $this->category === 'super_admin';
    }

    public function isBPC(): bool
    {
        return $this->category === 'bpc';
    }

    public function isBPD(): bool
    {
        return $this->category === 'bpd';
    }

    public function canManageAdmins(): bool
    {
        return $this->isSuperAdmin();
    }

    public function canManageContent(): bool
    {
        return $this->isSuperAdmin() || $this->isBPD();
    }

    public function canApproveAnggota(): bool
    {
        return $this->category === 'bpc';
    }

    public function canApproveAnggotaByDomisili($domisili): bool
    {
        if ($this->category === 'bpd' || $this->category === 'super_admin') {
            return false; 
        }
        
        return $this->domisili === $domisili;
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            return Storage::url($this->photo);
        }
        
        return '';
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 2));
    }

    public function approvedAnggotas()
    {
        return $this->hasMany(Anggota::class, 'approved_by');
    }
}