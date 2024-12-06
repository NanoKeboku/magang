<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');  // Pastikan Anda sudah membuat view ini
    }

    // Menyimpan data pengguna baru
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Pastikan email unik
            'password' => 'required|string|confirmed', // Pastikan password valid dan cocok dengan konfirmasi
            'role' => 'required|string|in:admin,user', // Validasi role yang diterima
        ]);

        // Membuat pengguna baru dengan hash password
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);  // Hash password menggunakan Bcrypt
        $user->role = $validated['role'];  // Menyimpan role yang dipilih
        $user->save();

        // Redirect ke halaman login setelah berhasil mendaftar
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
