<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    use HasFactory;
    protected $fillable = [
        'vision',
        'events_completed',
        'client_satisfaction',
    ];
}
