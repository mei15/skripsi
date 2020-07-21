<?php

namespace App\Http\Controllers\Api;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Konsultasi;
use Illuminate\Support\Facades\Validator;


class KonsultasiApiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $konsultasis = Konsultasi::with(['dosen'])->where('judul', 'LIKE', "%$search%")->orderBy('id', 'asc')->paginate(10);

        return response()->json($konsultasis, 200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->toArray(), [
            'judul' => 'required',
            'tgl' => 'required',
            'ket' => 'required',
            'dosen' => 'required'
        ]);

        // kalo error, ikutan ini aja
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        } else {
            // kalo berhasil baru insert
            $konsultasi = new Konsultasi;
            $konsultasi->judul = $request->judul;
            $konsultasi->tgl = $request->tgl;
            $konsultasi->ket = $request->ket;
            $konsultasi->id_dsn = $request->dosen;
            $konsultasi->save();

            return response()->json('success', 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->toArray(), [
            'judul' => 'required',
            'tgl' => 'required',
            'ket' => 'required',
            'dosen' => 'required'
        ]);

        // kalo error, ikutan ini aja
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        } else {
            // kalo berhasil baru insert
            $konsultasi = Konsultasi::findOrFail($id);
            $konsultasi = new Konsultasi;
            $konsultasi->judul = $request->judul;
            $konsultasi->tgl = $request->tgl;
            $konsultasi->ket = $request->ket;
            $konsultasi->id_dsn = $request->dosen;
            $konsultasi->save();

            return response()->json('success', 201);
        }
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::find($id);
        $konsultasi->delete();
        return response()->json('delete success');
    }
}
