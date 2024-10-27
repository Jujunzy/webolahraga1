<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Pelatih;
use App\Models\Pemenang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data1 = Anggota::count('anggota');
        $data2 = Event::count('event');
        $data3 = Pemenang::count('event_id');
        $data4 = Pelatih::count('pelatih');
        return view('home',compact('data1','data2','data3','data4'));
    }
}
