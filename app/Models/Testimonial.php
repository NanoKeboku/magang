<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'program_id',
        'review',
        'rating',
    ];

    // Relasi dengan model Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
