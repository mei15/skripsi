<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dosen;
use App\Konsultasi;

class KonsultasiApiController extends Controller
{
    public function index()
    {
        // $user = auth()->user()->userable;
        $konsultasi = auth()->user()->userable->Konsultasi;

        return response()->json(
           
            $konsultasi
        ,200);
    }

    public function show($id)
    {

        $konsultasi = auth()->user()->userable->Konsultasi->find($id);

        if (!$konsultasi) {
            return response()->json('sorry', 400);
        }

        return response()->json( [$konsultasi->toArray()] , 200);
    }

    public function add()
    {
        $dosen = Dosen::all();

        return response()->json([
           $dosen
        ],200);
    }

    public function store(Request $request)
    {
        $user = auth()->user()->userable;
    
        $request->validate([
            'judul'         => 'required',
            'keterangan'    => 'required',
            'tanggal'       => 'required',
            'dosen_id'      => 'required'
        ]);

        $konsultasi = new Konsultasi;
        $konsultasi->judul = $request->judul;
        $konsultasi->keterangan = $request->keterangan;
        $konsultasi->tanggal = $request->tanggal;
        $konsultasi->mahasiswa_id = $user->id;
        $konsultasi->dosen_id = $request->dosen_id;
        $konsultasi->save();
        
            return response()->json(
                $konsultasi->toArray()
                
            ,200);
       
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user()->userable;

        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
            'dosen_id'     => 'required'
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->judul = $request->judul;
        $konsultasi->tanggal = $request->tanggal;
        $konsultasi->keterangan = $request->keterangan;
        $konsultasi->dosen_id = $request->dosen_id;
        $konsultasi->save();

        return response()->json(
            $konsultasi->toArray()
            
        ,200);
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
