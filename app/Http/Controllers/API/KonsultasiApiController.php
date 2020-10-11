<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class KonsultasiApiController extends Controller
{
    public function index()
    {
        $konsultasi = auth()->user()->userable->Konsultasi;
        return response()->json([
            'konsultasi' => $konsultasi,
        ]);
    }

    public function show()
    {
        
        $konsultasi = auth()->user()->userable->konsultasi()->find($id);
 
        if (!$konsultasi) {
            return response()->json('sorry', 400);
        }
 
        return response()->json( [$konsultasi->toArray()] , 200);
    }
 
    public function store(Request $request)
    {

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

        if (auth()->user()->userable->konsultasi()->save($konsultasi))
            return response()->json( 'berhasil!'
        );
        else
            return response()->json('tidak dapat menambah konsultasi'
            , 500);
    }
 
    public function update(Request $request, $id)
    {
        $konsultasi = auth()->user()->userable->konsultasi()->find($id);
 
        if (!$konsultasi) {
            return response()->json('sorry', 400);
        }
 
        $updated = $konsultasi->fill($request->all())->save();
 
        if ($updated)
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
        );
        else
            return response()->json('sorry'
            //     [
            //     'success' => false,
            //     'message' => 'Product could not be updated'
            // ]
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
