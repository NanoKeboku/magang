<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\UserPreference;
use App\Services\SAWService;
use Illuminate\Http\Request;
use App\Models\Preference; 

class RecommendationController extends Controller
{
    public function index()
    {
        $preferences = auth()->user()->preference;
        $programs = Program::all();

        $recommendations = SAWService::calculateScores($programs, $preferences);

        return view('recommendations.index', compact('recommendations'));
    }
    public function showRecommendations()
{
    // Ambil data program dan preferensi
    $programs = Program::all();
    $preferences = UserPreference::where('user_id', auth()->id())->first();

    // Hitung skor
    $recommendations = SAWService::calculateScores($programs, $preferences);

    // Tampilkan hasil ke view
    return view('recommendations.index', compact('recommendations'));
}
}
