<?php

// use App\Http\Controllers\PageAnggotaController;
// use App\Http\Controllers\PageJenisController;
// use App\Http\Controllers\PageLatihanController;
// use App\Http\Controllers\PagePelatihController;
// use App\Http\Controllers\PageEventController;
// use App\Http\Controllers\PagePemenangController;
// use App\Http\Controllers\PageJadwalController;
// use App\Http\Controllers\Dashboard;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageAnggotaController;
use App\Http\Controllers\PageJenisController;
use App\Http\Controllers\PageLatihanController;
use App\Http\Controllers\PagePelatihController;
use App\Http\Controllers\PageEventController;
use App\Http\Controllers\PagePemenangController;
use App\Http\Controllers\PageJadwalController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('dashboard', [Dashboard::class, 'dashboard']);
// Route::resource('/anggota', PageAnggotaController::class);
// Route::resource('/jenisolahraga', PageJenisController::class);
// Route::resource('/latihan', PageLatihanController::class);
// Route::resource('/pelatih', PagePelatihController::class);
// Route::resource('/event', PageEventController::class);
// Route::resource('/pemenang', PagePemenangController::class);
// Route::resource('/jadwal', PageJadwalController::class);
// Disable registration route
Auth::routes(['register' => false]);

// Redirect the main page to login if not authenticated
Route::get('/', function () {
    return auth()->check() ? redirect('/home') : redirect()->route('login');
});

// Authentication routes
Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AdminAuthController::class, 'register']);
Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->middleware('guest');
Route::get('logout', [AdminAuthController::class, 'logout'])->middleware('auth');

// Dashboard route, accessible only if authenticated
Route::get('home', [HomeController::class, 'index'])->middleware('auth');

// Resources routes for the rest of the application
Route::resource('/anggota', PageAnggotaController::class)->middleware('auth');
Route::resource('/jenisolahraga', PageJenisController::class)->middleware('auth');
Route::resource('/latihan', PageLatihanController::class)->middleware('auth');
Route::resource('/pelatih', PagePelatihController::class)->middleware('auth');
Route::resource('/event', PageEventController::class)->middleware('auth');
Route::resource('/pemenang', PagePemenangController::class)->middleware('auth');
Route::resource('/jadwal', PageJadwalController::class)->middleware('auth');
