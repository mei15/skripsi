<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Dosen;
use App\Konsultasi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $data['totalUser'] = User::count();
        $data['totalAdmin'] = User::where('level_id', 1)->count();
        $data['totalMahasiswa'] = User::where('level_id', 2)->count();
        $data['totalDosen'] = User::where('level_id', 3)->count();
        $data['totalKonsultasi'] = Konsultasi::count();
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();
        return view('laporan.index', compact('data'));
    }
}
