<?php

namespace App\Http\Controllers\Api;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Konsultasi;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    function loginAndroid(Request $request)
    {
        $logins = DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->get();

        if (count($logins) > 0) {
            foreach ($logins as $logg) {
                $result["success"] = "1";
                $result["message"] = "success";
                //untuk memanggil data sesi Login
                $result["id"] = $logg->id;
                $result["first_name"] = $logg->first_name;
                $result["nim"] = $logg->nim;
                $result["email"] = $logg->email;
            }
            echo json_encode($result);
        } else {
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }
    // public function getDataByUser()
    // {
    //     $konsultasis = Konsultasi::with(['user', 'dosen'])->orderBy('created_at', 'DESC')->get();
    //     return response()->json([$konsultasis, 200]);
    // }

    // public function getDataByDosen()
    // {
    //     $konsultasis = Konsultasi::with(['dosen'])->orderBy('created_at', 'DESC')->get();
    //     return response()->json([$konsultasis, 200]);
    // }

    // public function getDataKonsul()
    // {
    //     $users = User::with(['konsultasi'])->orderBy('created_at', 'ASC')->get();
    //     return response()->json([$users, 200]);
    // }

    // public function getDataKonsulDosen()
    // {
    //     $dosens = Dosen::with(['konsultasi', 'user'])->orderBy('created_at', 'ASC')->get();
    //     return response()->json([$dosens, 200]);
    // }
}
