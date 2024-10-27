<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AdminAuthController extends Controller
{

    //  Menampilkan form register
     public function showRegistrationForm() {
        return view('page.auth.register');
    }

    // Menangani form register
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat akun baru (misalnya menggunakan model User)
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Menampilkan pesan sukses menggunakan SweetAlert
        Alert::success('Success', 'Akun berhasil dibuat, Selamat datang Admin!');
        return redirect('home');
    }

    public function index(){
        return view('page.auth.login');
    }
    public function doLogin(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            Alert::success('Success', 'Selamat Datang Admin!');
            return redirect('/home');
        }
        return back()->with('loginError', 'Email atau password salah');
    }
    function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    }
}

