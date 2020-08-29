<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Dosen;
use App\User;
use App\Konsultasi;

class LaporanApiController extends Controller
{
    public function index(Request $request)
    {
        $data['totalUser'] = User::count();
        $data['totalAdmin'] = User::where('level_id', 1)->count();
        $data['totalMahasiswa'] = User::where('level_id', 2)->count();
        $data['totalDosen'] = User::where('level_id', 3)->count();
        $data['totalDosen'] = Dosen::count();
        $data['totalKonsultasi'] = Konsultasi::count();
        $data['totalKonsultasiToday'] = Konsultasi::where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->count();

        return response()->json($data, 200);
    }
}
