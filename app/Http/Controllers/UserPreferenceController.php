<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'field_weight' => 'required|integer|min:1',
            'compensation_weight' => 'required|integer|min:1',
            'location_weight' => 'required|integer|min:1',
            'duration_weight' => 'required|integer|min:1',
            'career_opportunities_weight' => 'required|integer|min:1',
        ]);

        // Simpan data ke database
        UserPreference::create([
            'user_id' => Auth::id(), // ID pengguna saat ini
            'field_weight' => $validatedData['field_weight'],
            'compensation_weight' => $validatedData['compensation_weight'],
            'location_weight' => $validatedData['location_weight'],
            'duration_weight' => $validatedData['duration_weight'],
            'career_opportunities_weight' => $validatedData['career_opportunities_weight'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Preferences saved successfully!');
    }
}
