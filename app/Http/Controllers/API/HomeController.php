<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::User()->userable_type == 'App\Mahasiswa') 
        {
            return response()->json([
                'user' => $user,
                'mahasiswa' => $mahasiswa,
            ], 200);
        } else if (Auth::user()->userable_type == 'App\Dosen') 
        {
            return response()->json([
                'user' => $user,
                'dosen' => $dosen,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid User',
            ], 401);
        }
    }

    protected function dosenDashboard()
    {
        $user = Auth::user();
        $dosen = Dosen::user($user);
    }

    protected function mahasiswaDashboard()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::user($user);
        
    }
}
