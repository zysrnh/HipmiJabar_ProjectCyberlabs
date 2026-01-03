<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Katalog extends Model
{
    protected $fillable = [
        'anggota_id',
        'company_name',
        'business_field',
        'description',
        'logo',
        'images',
        'address',
        'phone',
        'email',
        'map_embed_url',
        'is_active',
        'status',
        'rejection_reason',
        'submitted_at',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    // Accessors
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::url($this->logo);
        }
        return asset('images/hipmi-logo.png');
    }

    public function getImagesUrlAttribute()
    {
        if (!$this->images) {
            return [];
        }
        
        return collect($this->images)->map(function ($image) {
            if (Storage::disk('public')->exists($image)) {
                return Storage::url($image);
            }
            return null;
        })->filter()->values()->toArray();
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge badge-warning">Menunggu Verifikasi</span>',
            'approved' => '<span class="badge badge-success">Disetujui</span>',
            'rejected' => '<span class="badge badge-danger">Ditolak</span>',
        ];
        return $badges[$this->status] ?? '<span class="badge badge-secondary">-</span>';
    }

    // Scopes
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

    public function scopeByAnggota($query)
    {
        return $query->whereNotNull('anggota_id');
    }

    public function scopeByAdmin($query)
    {
        return $query->whereNull('anggota_id');
    }

    // Methods
    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'is_active' => true,
            'approved_at' => now(),
            'approved_by' => $adminId,
            'rejection_reason' => null,
        ]);
    }

    public function reject($reason, $adminId)
    {
        $this->update([
            'status' => 'rejected',
            'is_active' => false,
            'rejection_reason' => $reason,
            'approved_by' => $adminId,
            'approved_at' => null,
        ]);
    }

    public function isSubmittedByAnggota()
    {
        return !is_null($this->anggota_id);
    }

    public function canBeEdited()
    {
        return in_array($this->status, ['pending', 'rejected']);
    }
}