<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Memastikan pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();
            // Debugging: Log role pengguna
            Log::info('User role: ' . $user->role);
            
            // Memeriksa apakah role pengguna sesuai dengan role yang dibutuhkan
            if ($user->hasRole($role)) {
                return $next($request); // Lanjutkan request jika role sesuai
            } else {
                // Jika role tidak sesuai, arahkan ke halaman yang relevan
                return redirect('/home')->with('error', 'You do not have permission to access this page.');
            }
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect('/login')->with('error', 'Please log in first.');
    }
}
