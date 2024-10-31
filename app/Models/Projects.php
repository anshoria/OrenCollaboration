<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'cover_img',
        'banner_img',
        'category',
        'overview',
        'key_highlights',
        'approach',
        'gallery',
        'venue',
        'attendees',
        'review',
        'reviewer',
        'company_review',
        'date',
    ];
    protected $casts = [
        'gallery' => 'array',
        'date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($projects) {
            // Hapus file foto_barang dari storage jika ada
            if ($projects->cover_img) {
                Storage::disk('public')->delete($projects->cover_img);
            } 
            if ($projects->banner_img) {
                Storage::disk('public')->delete($projects->banner_img);
            }
            if ($projects->gallery) {
                Storage::disk('public')->delete($projects->gallery);
            }
        });
    }
}
