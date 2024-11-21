<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'field',
        'compensation',
        'location',
        'duration',
        'career_opportunities',
        'description',
    ];
    
}
