<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dosen;

class KonsultasiApiController extends Controller
{
    public function index()
    {
        // $user = auth()->user()->userable;
        $konsultasi = auth()->user()->userable->Konsultasi;

        return response()->json(
            $konsultasi
            // 'user' => $user,
        );
    }

    public function show($id)
    {

        $konsultasi = auth()->user()->userable->Konsultasi->find($id);

        if (!$konsultasi) {
            return response()->json('sorry', 400);
        }

        return response()->json( [$konsultasi->toArray()] , 200);
    }

    public function tambah(){
        $user = auth()->user()->userable;
        $dosens = Dosen::all();

        return response()->json([ 
            'data' => $user,
            'dosen' => $dosens,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user()->userable;
       

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
        $konsultasi->mahasiswa_id = $user->id;
        $konsultasi->dosen_id = $request->dosen;

        if (auth()->user()->userable->konsultasi()->save($konsultasi))
            return response()->json([
                
                'success' => true,
                'token' => $success,
                'data' => $konsultasi->toArray()
            ],200);
        else
            return response()->json([
                'success' => false,
                'message' => 'tidak dapat menambah konsultasi'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $konsultasi = auth()->user()->userable->konsultasi()->find($id);

        if (!$konsultasi) {
            return response()->json( [
                'success' => false,
                'message' => 'tidak ada konsultasi'
            ], 400);
        }

        $updated = $konsultasi->fill($request->all())->save();

        if ($updated)
            return response()->json(
                [
                'success' => true
            ]
        );
        else
            return response()->json(
                [
                'success' => false,
                'message' => 'Konsultasi could not be updated'
            ]
            , 500);
    }

    public function destroy($id)
    {
        $konsultasi = auth()->user()->userable->konsultasi()->find($id);

        if (!$konsultasi) {
            return response()->json('sorry'

            , 400);
        }

        if ($konsultasi->delete()) {
            return response()->json('done'

        );
        } else {
            return response()->json('sorry'

            , 500);
        }
    }
}
