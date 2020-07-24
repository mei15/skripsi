<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mhs = Mahasiswa::all();
        return view('mahasiswa.index', compact('mhs'));
    }

    public function create()
    {
        return view('mahasiswa.add');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nim'           => 'required',
            'prodi'         => 'required',
        ]);

        $mhs = Mahasiswa::find($id);
        $mhs->first_name = $request->first_name;
        $mhs->last_name = $request->last_name;
        $mhs->nim = $request->nim;
        $mhs->prodi = $request->prodi;
        $mhs->save();

        session()->flash('success', 'Sukses Ubah Data Mahasiswa ' . $mhs->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nim'           => 'required',
            'prodi'         => 'required',
        ]);

        $mhs = new Mahasiswa();
        $mhs->first_name = $request->first_name;
        $mhs->last_name = $request->last_name;
        $mhs->nim = $request->nim;
        $mhs->prodi = $request->prodi;
        $mhs->save();

        session()->flash('success', 'Sukses Tambah Data Mahasiswa ' . $mhs->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::find($id);
        $mhs->delete();
        return redirect('mahasiswa.index')->with('sukses', 'Data Mahasiwa Berhasil Dihapus !');
    }
}
