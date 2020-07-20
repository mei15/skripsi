<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Dosen;

class DosenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $dosens = Dosen::with(['user'])->where('nama', 'LIKE', "%$search%")->orderBy('id', 'asc')->paginate(10);

        return response()->json($dosens, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validationnya pake ini, bukan $request->validate
        $validation = Validator::make($request->toArray(), [ 
            'nama' => 'required',
            'nip' => 'required',
            'prodi' => 'required',
            'user' => 'required'
        ]);

        // kalo error, ikutan ini aja
        if ($validation->fails()){
            return response()->json($validation->messages(), 400);
        }
        else {
            // kalo berhasil baru insert
            $dosen = new Dosen;
            $dosen->nama = $request->nama;
            $dosen->nip = $request->nip;
            $dosen->prodi = $request->prodi;
            $dosen->id_user = $request->user;
            $dosen->save();

            return response()->json('success', 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'prodi' => 'required',
            'user' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->nama = $request->nama;
        $dosen->nip = $request->nip;
        $dosen->prodi = $request->prodi;
        $dosen->id_user = $request->user;

        $dosen->update($request->all());
        return response()->json('update success', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        return response()->json('delete success');
    }
}
