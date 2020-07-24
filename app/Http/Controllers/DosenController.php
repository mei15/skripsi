<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dosen;


class DosenController extends Controller
{
    public function index()
    {

        $dosen = \App\Dosen::all();
        return view('dosen.index', ['dosen' => $dosen]);
    }

    public function edit($id_dosen)
    {
        $dosen = \App\Dosen::find($id_dosen);
        return view('Dosen.edit', ['dosen' => $id_dosen]);
    }

    public function update(Request $request, $id_dosen)
    {
        $dosen = \App\Dosen::find($id_dosen);
        $usr = \App\User::find($dosen->user_id);
        $usr->name = $request->nama;
        $usr->email = $request->email;
        if ($request->password != $dosen->password) {
            $usr->password = bcrypt($request->password);
            $request->merge(['password' => $usr->password]);
        }
        $usr->save();
        $dosen->update($request->all());

        return redirect('/dosen')->with('sukses', 'Data Dosen Berhasil Diupdated');
    }

    public function create(Request $request)
    {

        $user = new \App\User();
        $user->role = 'Dosen';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        $request->merge(['password' => $user->password]);
        \App\Dosen::create($request->all());
        return redirect('/dosen')->with('sukses', 'Data Dosen Berhasil Diinput');
    }

    public function delete($id_dosen)
    {
        $dosen = \App\Dosen::find($id_dosen);
        $usr = \App\User::find($dosen->user_id);
        $dosen->delete();
        $usr->delete();
        return redirect('/dosen')->with('sukses', 'Data Dosen Berhasil Dihapus !');
    }
}
