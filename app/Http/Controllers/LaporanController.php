<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Dosen;
use App\Konsultasi;
use App\Mahasiswa;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $data['totalUser'] = User::count();
        $data['totalAdmin'] = Admin::count();
        $data['totalMahasiswa'] = Mahasiswa::count();
        $data['totalDosen'] = Dosen::count();
        $data['totalKonsultasi'] = Konsultasi::count();
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();
        return view('laporan.index', compact('data'));
    }
}
