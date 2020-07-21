<?php

namespace App\Http\Controllers\Api;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Konsultasi;

class ApiController extends Controller
{
    public function getDataByUser()
    {
        $konsultasis = Konsultasi::with(['user', 'dosen'])->orderBy('created_at', 'DESC')->get();
        return response()->json([$konsultasis, 200]);
    }

    public function getDataByDosen()
    {
        $konsultasis = Konsultasi::with(['dosen'])->orderBy('created_at', 'DESC')->get();
        return response()->json([$konsultasis, 200]);
    }

    public function getDataKonsul()
    {
        $users = User::with(['konsultasi'])->orderBy('created_at', 'ASC')->get();
        return response()->json([$users, 200]);
    }

    public function getDataKonsulDosen()
    {
        $dosens = Dosen::with(['konsultasi', 'user'])->orderBy('created_at', 'ASC')->get();
        return response()->json([$dosens, 200]);
    }
}
