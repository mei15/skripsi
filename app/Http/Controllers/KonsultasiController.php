<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;
use App\Dosen;
use App\Konsultasi;
use App\User;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $konsultasis = Konsultasi::user($user)->paginate(10);

        return view('konsultasi.index', compact('konsultasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
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
