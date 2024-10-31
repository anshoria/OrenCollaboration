<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_description',
        'hero_img',
        'hero_img2',
        'vision_mission_section_description',
        'team_section_description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($aboutcontent) {
            // Hapus file foto_barang dari storage jika ada
            if ($aboutcontent->hero_img) {
                Storage::disk('public')->delete($aboutcontent->hero_img);
            } 
            if ($aboutcontent->hero_img2) {
                Storage::disk('public')->delete($aboutcontent->hero_img2);
            }
        });
    }
}
