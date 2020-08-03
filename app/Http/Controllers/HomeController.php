<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Dosen;
use App\Konsultasi;
use App\Admin;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::User()->userable_type == 'App\Admin') {
            return $this->adminDashboard();
        } else if (Auth::user()->userable_type == 'App\Dosen') {
            return $this->dosenDashboard();
        } else {
            return $this->mahasiswaDashboard();
        }
    }

    protected function adminDashboard()
    {
        $user = Auth::user();
        $data['totalUser'] = User::count();
        $data['totalAdmin'] = Admin::count();
        $data['totalMahasiswa'] = Mahasiswa::count();
        $data['totalDosen'] = Dosen::count();
        $data['totalKonsultasi'] = Konsultasi::count();
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();
        return view('dashboard.admin', compact('data', 'user'));
    }

    protected function dosenDashboard()
    {
        $user = Auth::user();
        $konsultasis = Konsultasi::user($user)->paginate(10);
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();
        return view('dashboard.dosen', compact('data', 'konsultasis', 'user'));
    }

    protected function mahasiswaDashboard()
    {
        $user = Auth::user();
        $konsultasis = Konsultasi::user($user)->paginate(10);
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();
        return view('dashboard.mahasiswa', compact('data', 'konsultasis', 'user'));
    }
}
