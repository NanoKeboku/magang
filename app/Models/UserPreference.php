<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_weight',
        'compensation_weight',
        'location_weight',
        'duration_weight',
        'career_opportunities_weight',
    ];

    // Cast kolom menjadi tipe data numerik
    protected $casts = [
        'field_weight' => 'float',
        'compensation_weight' => 'float',
        'location_weight' => 'float',
        'duration_weight' => 'float',
        'career_opportunities_weight' => 'float',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}