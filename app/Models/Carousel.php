<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Carousel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($carousel) {
            // Hapus file foto_barang dari storage jika ada
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);
            } 
        });
    }
}
