<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'field_weight' => 'required|numeric',
            'compensation_weight' => 'required|numeric',
            'location_weight' => 'required|numeric',
            'duration_weight' => 'required|numeric',
            'career_opportunities_weight' => 'required|numeric',
        ]);

        // Hitung total bobot
        $totalWeight = $validated['field_weight'] 
                     + $validated['compensation_weight'] 
                     + $validated['location_weight'] 
                     + $validated['duration_weight'] 
                     + $validated['career_opportunities_weight'];

        // Validasi total bobot
        if ($totalWeight !== 100) {
            return back()->withErrors(['total_weight' => 'Total bobot harus 100%']);
        }

        // Simpan ke database
        UserPreference::create([
            'user_id' => Auth::id(), // Ambil ID pengguna yang sedang login
            'field_weight' => $validated['field_weight'],
            'compensation_weight' => $validated['compensation_weight'],
            'location_weight' => $validated['location_weight'],
            'duration_weight' => $validated['duration_weight'],
            'career_opportunities_weight' => $validated['career_opportunities_weight'],
        ]);

        // Redirect ke halaman create dengan pesan sukses
        return redirect()->route('preferences.create')->with('success', 'Preferences saved successfully!');
    }

    public function create()
    {
        // Tampilkan form input preferences
        return view('preferences.create');
    }
}