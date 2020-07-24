<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function edit($id_mhs)
    {
        $mahasiswa = Mahasiswa::findOrFail($id_mhs);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
    }

    public function store(Request $request)
    {
        $user = new \App\User;
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->nim = $request->nim;
        $user->email = $request->email;
        $user->prodi = $request->prodi;
        $user->password = $request->password;
        $user->id_mhs = $request->userable_id;
        $user->remember_token = str::random(60);
        $user->save();

        $request->request->add(['id' => $user->id]);
        \App\Mahasiswa::store($request->all());
        return redirect('mahasiswa.index')->with('sukses', 'Data Mahasiswa Berhasil Diinput');
    }

    public function delete($id)
    {
        $mahasiswa = \App\Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect('mahasiswa.index')->with('sukses', 'Data Mahasiswa Berhasil Dihapus !');
    }
}
