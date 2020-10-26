<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;
use App\Dosen;
use App\Mahasiswa;
use App\Konsultasi;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function dsn()
    {
        $dosens = Dosen::all();
        return response()->json($dosens,
            );
    }

    public function mhs()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json(
            $mahasiswa,200
            );
    }

}
