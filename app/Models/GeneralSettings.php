<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'brand_logo',
        'instagram',
        'facebook',
        'tiktok',
        'twiter',
        'youtube'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($settings) {
            // Hapus file foto_barang dari storage jika ada
            if ($settings->brand_logo) {
                Storage::disk('public')->delete($settings->brand_logo);
            } 
        });
    }
    
}
