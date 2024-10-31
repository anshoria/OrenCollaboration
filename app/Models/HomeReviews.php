<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeReviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'description',
        'profile_img',
        'star',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($review) {
            // Hapus file foto_barang dari storage jika ada
            if ($review->profile_img) {
                Storage::disk('public')->delete($review->profile_img);
            } 
        });
    }
}
