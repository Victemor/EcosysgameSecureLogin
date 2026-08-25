<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'common_name',
        'scientific_name',
        'corrected_scientific_name',
        'group',
        'family',
        'conservation_status',
        'ecosystem',
        'altitudinal_range',
        'source',
        'reference',
    ];
}
