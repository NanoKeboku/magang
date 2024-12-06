<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $request->session()->regenerate();
            $user = Auth::user();
            //Pengecekan apakah role pengguna sesuai dengan role yang dipilih
            if ($user->role !== $request->role) {
                // Jika role tidak sesuai, logout dan kembali ke halaman login
                Auth::logout();
                return redirect()->route('login')->withErrors(['role' => 'Role yang dipilih tidak sesuai dengan akun Anda.']);
            }
            // Redirect berdasarkan peran pengguna
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Pastikan rute ini ada
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard'); // Pastikan rute ini ada
            }

            // Jika role tidak valid, logout
            Auth::logout();
            return redirect()->route('login')->with('error', 'Role pengguna tidak dikenali.');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Membuat pengguna baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',  // Pastikan password terkonfirmasi
            'role' => 'required|in:admin,user', // Validasi role
        ]);

        // Membuat pengguna baru
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->role = $validated['role']; // Simpan role ke database
        $user->save();

        // Redirect ke halaman pengguna
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    }
}
