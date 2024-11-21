<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function create()
    {
        return view('programs.create'); // Pastikan file Blade berada di folder 'resources/views/programs/create.blade.php'
    }

    public function store(Request $request)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'field' => 'required|string|max:255', // Field adalah string
            'compensation' => 'required|numeric', // Compensation adalah numeric
            'location' => 'required|string|max:255', // Location adalah string
            'duration' => 'required|integer', // Duration adalah integer
            'career_opportunities' => 'required|string|max:255', // Career Opportunities adalah string
            'description' => 'required|string', // Description adalah string
        ]);

        try {
            // Menyimpan data yang telah tervalidasi
            Program::create($validated);

            // Jika berhasil, kembalikan ke halaman create dengan pesan sukses
            return redirect()->route('programs.create')->with('success', 'Program created successfully!');
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan ke halaman create dengan pesan error
            return redirect()->route('programs.create')->with('error', 'Failed to create program. Please try again!');
        }
    }
}
