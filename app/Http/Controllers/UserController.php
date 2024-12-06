<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use App\Models\UserPreference;
use App\Services\SAWService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil s  emua program
        $programs = Program::all();

        // Debugging: Pastikan data program ada
        if ($programs->isEmpty()) {
            return redirect()->route('home')->with('error', 'No programs available.');
        }

        // Ambil preferensi pengguna yang sedang login
        $preferences = UserPreference::where('user_id', 3)->first();
        //$preferences = UserPreference::where('user_id', auth()->id())->first();

        // Debugging: Pastikan preferensi ditemukan
        if (!$preferences) {
            return redirect()->route('preferences.create')->with('error', 'Please fill out your preferences first.');
        }

        // Hitung rekomendasi menggunakan metode SAW
        $recommendations = SAWService::calculateScores($programs, $preferences);

        // Filter rekomendasi berdasarkan pencarian jika ada
        $search = $request->input('search');
        if ($search) {
            $recommendations = $recommendations->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), strtolower($search)) ||
                       str_contains(strtolower($item['description']), strtolower($search));
            });
        }

        // Debugging: Pastikan rekomendasi dihitung dengan benar
        if ($recommendations->isEmpty()) {
            return redirect()->route('home')->with('error', 'No recommendations available.');
        }

        // Kirim data ke view
        return view('user.dashboard', compact('recommendations'));
    }

    public function index(){
        $user = User::user();
        return view('user.dashboard', ['user'=> $user]);
    }
}
