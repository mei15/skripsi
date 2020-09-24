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
        return response()->json( [$dosens->toArray()] , 200);
    }

    public function mhs()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json( [$mahasiswa->toArray()] , 200);
    }

    public function judul()
    {
        $konsultasi = Konsultasi::all()->judul;
        return response()->json( [$konsultasi->toArray()] , 200);
    }
}
