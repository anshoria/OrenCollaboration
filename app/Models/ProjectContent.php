<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'main_description',
        'review',
        'reviewer',
        'company_review',
    ];
}
