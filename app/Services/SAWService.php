<?php

namespace App\Services;

class SAWService
{
    public static function calculateScores($programs, $user_preferences)
    {
        // Validasi masukan
        if (!$programs || !$user_preferences) {
            return collect([]);
        }

        // Ambil nilai maksimum dan minimum untuk normalisasi
        $maxFieldScore = $programs->max('field_score');
        $maxCompensation = $programs->max('compensation');
        $minLocationScore = $programs->min('location_score');
        $maxDuration = $programs->max('duration');
        $maxCareerOpportunitiesScore = $programs->max('career_opportunities_score');

        $scores = [];

        foreach ($programs as $program) {
            // Normalisasi nilai
            $normalizedProgram = [
                'field' => $maxFieldScore > 0 ? $program->field_score / $maxFieldScore : 0,
                'compensation' => $maxCompensation > 0 ? $program->compensation / $maxCompensation : 0,
                'location' => $program->location_score > 0 ? $minLocationScore / $program->location_score : 0,
                'duration' => $maxDuration > 0 ? $program->duration / $maxDuration : 0,
                'career_opportunities' => $maxCareerOpportunitiesScore > 0 ? $program->career_opportunities_score / $maxCareerOpportunitiesScore : 0,
            ];

            // Hitung skor berdasarkan preferensi pengguna
            $score = round(
                ($normalizedProgram['field'] * $user_preferences->field_weight) +
                ($normalizedProgram['compensation'] * $user_preferences->compensation_weight) +
                ($normalizedProgram['location'] * $user_preferences->location_weight) +
                ($normalizedProgram['duration'] * $user_preferences->duration_weight) +
                ($normalizedProgram['career_opportunities'] * $user_preferences->career_opportunities_weight),
                2
            );

            // Tambahkan informasi program
            $scores[] = [
                'id' => $program->id,
                'name' => $program->name,
                'company' => $program->company_name,
                'score' => $score,
                'duration' => $program->duration,
                'compensation' => $program->compensation,
                'description' => $program->description,
            ];
        }

        // Urutkan berdasarkan skor secara menurun dan kembalikan
        return collect($scores)->sortByDesc('score');
    }
}
