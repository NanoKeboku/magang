<?php

namespace App\Services;

use App\Models\Program;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class SAWService
{
    public static function calculateScores($programs)
    {
        // Ambil preferensi pengguna yang sedang login
        $user_preferences = UserPreference::where('user_id', Auth::id())->first();

        // Jika preferensi belum diatur, redirect untuk mengisi preferensi
        if (!$user_preferences) {
            return redirect()->route('preferences.create')->with('error', 'Please fill out your preferences first.');
        }

        // Ambil nilai tertinggi dari setiap kolom menggunakan koleksi Laravel
        $maxFieldScore = $programs->max('field_score');
        $maxCompensation = $programs->max('compensation');
        $maxLocationScore = $programs->max('location_score');
        $maxDuration = $programs->max('duration');
        $maxCareerOpportunitiesScore = $programs->max('career_opportunities_score');

        $scores = [];

        foreach ($programs as $program) {
            // Normalisasi nilai
            $normalizedProgram = [
                'field' => $maxFieldScore > 0 ? $program->field_score / $maxFieldScore : 0,
                'compensation' => $maxCompensation > 0 ? $program->compensation / $maxCompensation : 0,
                'location' => $maxLocationScore > 0 ? $program->location_score / $maxLocationScore : 0,
                'duration' => $maxDuration > 0 ? $program->duration / $maxDuration : 0,
                'career_opportunities' => $maxCareerOpportunitiesScore > 0 ? $program->career_opportunities_score / $maxCareerOpportunitiesScore : 0,
            ];

            // Hitung skor berdasarkan preferensi pengguna
            $score = 
                ($normalizedProgram['field'] * $user_preferences->field_weight) +
                ($normalizedProgram['compensation'] * $user_preferences->compensation_weight) +
                ($normalizedProgram['location'] * $user_preferences->location_weight) +
                ($normalizedProgram['duration'] * $user_preferences->duration_weight) +
                ($normalizedProgram['career_opportunities'] * $user_preferences->career_opportunities_weight);

            $scores[] = ['program' => $program, 'score' => $score];
        }

        // Urutkan berdasarkan skor secara menurun dan kembalikan
        return collect($scores)->sortByDesc('score');
    }
}

