<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use App\Konsultasi;
use App\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Do_;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->level_id == 1) {
            $konsultasis = \App\Konsultasi::all();
        } elseif (auth()->user()->level_id == 3) {
            $konsultasis = \App\Konsultasi::where('id_user', auth()->user()->dosen->id_dsn)->get();
        } else {
            //dd(auth()->user()->mahasiswa->id_mhs);
            $konsultasis = \App\Konsultasi::where('id_user', auth()->user()->mahasiswa->id_mhs)->get();
        }

        $dosen = \App\Dosen::all();

        return view('konsultasi.index', ['konsultasis' => $konsultasis, 'dosen' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $dosens = Dosen::all();

        return view('konsultasi.add', compact('user', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'judul' => 'required',
            'tgl' => 'required',
            'ket' => 'required',
            'dosen' => 'required',
        ]);

        $konsultasi = new Konsultasi;
        $konsultasi->judul = $request->judul;
        $konsultasi->tgl = $request->tgl;
        $konsultasi->ket = $request->ket;
        $konsultasi->id_dsn = $request->dosen;
        $konsultasi->id_user = $user->id;
        $konsultasi->save();

        session()->flash('success', 'Sukses Tambah Data Konsultasi ' . $konsultasi->judul);
        return redirect()->route('konsultasi.index');
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
        $konsultasi = Konsultasi::findOrFail($id);
        $dosens = Dosen::all();

        return view('konsultasi.edit', compact('konsultasi', 'dosens'));
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
            'judul' => 'required',
            'tgl' => 'required',
            'ket' => 'required',
            'dosen' => 'required',
            'user' => 'required'
        ]);

        $konsultasi = new Konsultasi;
        $konsultasi->judul = $request->judul;
        $konsultasi->tgl = $request->tgl;
        $konsultasi->ket = $request->ket;
        $konsultasi->id_dsn = $request->dosen;
        $konsultasi->id_user = $request->user;
        $konsultasi->save();

        session()->flash('success', 'Sukses Ubah Data Konsultasi ' . $konsultasi->judul);
        return redirect()->route('konsultasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        session()->flash('success', 'Sukses Hapus Konsultasi!');
        return redirect()->route('konsultasi.index');
    }
}
