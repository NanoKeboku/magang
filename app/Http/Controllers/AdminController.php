<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\UserPreference;
use App\Services\SAWService;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua program dan preferensi user
        $programs = Program::all();
        $preferences = UserPreference::where('user_id', auth()->id())->first();

        // Jika preferensi belum diatur, redirect untuk mengisi preferensi
        if (!$preferences) {
            return redirect()->route('preferences.create')->with('error', 'Please fill out your preferences first.');
        }

        // Hitung skor rekomendasi
        $recommendations = SAWService::calculateScores($programs, $preferences);

        // Kirim data rekomendasi ke view dashboard
        return view('admin.dashboard', compact('recommendations'));
    }
    //cek role
    public function __construct()
{
    $this->middleware('checkrole:admin');
}

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $recommendation = program::findOrFail($id);
    
        // Hapus data
        $recommendation->delete();
    
        // Redirect atau kembalikan response
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Data berhasil dihapus');
    }
}
