<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\PreferenceController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/recommendations', [RecommendationController::class, 'index'])->middleware('auth');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Untuk menampilkan form login
Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // Untuk memproses login
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::resource('programs', ProgramController::class);
Route::resource('preferences', PreferenceController::class);
Route::post('/preferences/store', [UserPreferenceController::class, 'store'])->name('preferences.store');
Route::get('preferences/create', [PreferenceController::class, 'create'])->name('preferences.create');
Route::post('preferences/store', [PreferenceController::class, 'store'])->name('preferences.store');
Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
Route::post('/programs/store', [ProgramController::class, 'store'])->name('programs.store');

