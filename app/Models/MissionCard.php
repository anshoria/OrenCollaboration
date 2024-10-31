<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'mission',
        'mission_title',
        'mission_detail',
        'icon'
    ];
}
