<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dosen;


class DosenController extends Controller
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
        // dd($dosens);
        return view('dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dosen.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'prodi' => 'required',
            'user' => 'required'
        ]);

        $dosen = new Dosen;
        $dosen->nama = $request->nama;
        $dosen->nip = $request->nip;
        $dosen->prodi = $request->prodi;
        $dosen->id_user = $request->user;
        $dosen->save();

        session()->flash('success', 'Sukses Tambah Data Dosen ' . $dosen->nama);
        return redirect()->route('dosen.index');
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
        $dosen = Dosen::findOrFail($id);
        $users = User::all();
        return view('dosen.edit', compact('dosen', 'users'));
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
        $dosen->save();

        session()->flash('success', 'Sukses Ubah Data Dosen ' . $dosen->nama);
        return redirect()->route('dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        session()->flash('success', 'Sukses Hapus Pengguna!');
        return redirect()->route('pengguna.index');
    }
}
