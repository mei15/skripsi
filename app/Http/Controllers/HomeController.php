<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Dosen;
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
        if (Auth::User()->level_id == 1) {
            return $this->adminDashboard();
        } elseif (Auth::user()->level_id == 2) {
            return $this->mahasiswaDashboard();
        } else {
            return $this->dosenDashboard();
        }
    }

    protected function adminDashboard()
    {
        return view('dashboard.admin');
    }

    protected function mahasiswaDashboard()
    {
        return view('dashboard.mahasiswa');
    }

    protected function dosenDashboard()
    {
        return view('dashboard.dosen');
    }
}
