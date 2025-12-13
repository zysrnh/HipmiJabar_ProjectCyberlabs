<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Katalog extends Model
{
    protected $fillable = [
        'company_name',
        'business_field',
        'description',
        'logo',
        'images',
        'address',
        'phone',
        'email',
        'map_embed_url',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean'
    ];

    // Accessor untuk URL logo
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::url($this->logo);
        }
        return asset('images/hipmi-logo.png');
    }

    // Accessor untuk URL images
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
}