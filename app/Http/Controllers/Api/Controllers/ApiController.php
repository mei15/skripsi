<?php

namespace App\Http\Controllers\Api;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Konsultasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function indexapi()
    {
        $user = Auth::user();
        $konsultasis = Konsultasi::user($user)->paginate(10);

        return response()->json($konsultasis, 200);
    }

    public function loginapi(User $user, Request $request)
    {
        $user = User::where('email', $request->email)->where('password', $request->password)->get();

        if (count($user) > 0) {
            foreach ($user as $u) {
                $result["hasil"] = "1";
                $result["first_name"] = $u->first_name;
                $result["last_name"] = $u->last_name;
                $result["last_name"] = $u->last_name;
                $result["email"] = $u->email;
                $result["username"] = $u->username;
                $result["password"] = $u->password;
                $result['id'] = $u->id;
            }
        } else {
            $result['hasil'] = '0';
        }
        echo json_encode($result);
    }

    public function storeapi(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'judul'         => 'required',
            'keterangan'    => 'required',
            'tanggal'       => 'required',
            'dosen'         => 'required',
        ]);

        $konsultasi = new Konsultasi;
        $konsultasi->judul = $request->judul;
        $konsultasi->keterangan = $request->keterangan;
        $konsultasi->tanggal = $request->tanggal;
        $konsultasi->mahasiswa_id = $user->userable->id;
        $konsultasi->dosen_id = $request->dosen;
        $konsultasi->save();


        return response()->json('success', 201);
    }

    public function updateapi(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'dosen' => 'required',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->judul = $request->judul;
        $konsultasi->tanggal = $request->tanggal;
        $konsultasi->keterangan = $request->keterangan;
        $konsultasi->dosen_id = $request->dosen;
        $konsultasi->save();

        return response()->json('success', 201);
    }

    public function destroyapi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return response()->json('delete success');
    }
}
