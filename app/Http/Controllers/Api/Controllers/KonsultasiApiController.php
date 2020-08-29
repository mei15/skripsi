<?php

namespace App\Http\Controllers\Api;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Konsultasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class KonsultasiApiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $konsultasis = Konsultasi::user($user)->paginate(10);

        return response()->json($konsultasis, 200);
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return response()->json('delete success');
    }
}
