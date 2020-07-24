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
        if (Auth::User()->userable_type == 'App\Admin') {
            return $this->adminDashboard();
        }
        else if (Auth::user()->userable_type == 'App\Dosen') {
            return $this->dosenDashboard();
        }
        else {
            return $this->mahasiswaDashboard();
        }
    }

    protected function adminDashboard()
    {
        return view('dashboard.admin');
    }

    protected function dosenDashboard()
    {
        return view('dashboard.dosen');
    }

    protected function mahasiswaDashboard()
    {
        return view('dashboard.mahasiswa');
    }
}
