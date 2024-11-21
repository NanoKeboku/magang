<?php

namespace App\Http\Controllers;

use App\Models\User;  // Tambahkan import untuk model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan view ini tersedia
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial login
        if (Auth::attempt($credentials)) {
            // Regenerasi session dan redirect ke halaman yang dimaksud
            $request->session()->regenerate();
            return redirect()->intended('/recommendations'); // Sesuaikan dengan halaman setelah login
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Membuat pengguna baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',  // Validasi email unik
            'password' => 'required',  // Pastikan password memiliki panjang minimal
        ]);

        // Membuat pengguna baru dengan hash password
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);  // Menggunakan bcrypt untuk hash password
        $user->save();

        // Redirect ke halaman yang sesuai
        return redirect()->route('users.index');
    }
}
