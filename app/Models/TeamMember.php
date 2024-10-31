<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'description',
        'image',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'tiktok_url',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($teammember) {
            // Hapus file foto_barang dari storage jika ada
            if ($teammember->image) {
                Storage::disk('public')->delete($teammember->image);
            }
        });
    }
}
