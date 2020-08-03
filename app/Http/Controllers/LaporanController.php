<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Dosen;
use App\Konsultasi;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }
}
