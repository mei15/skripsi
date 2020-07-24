<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('user.index', ['user' => $user]);
    }

    public function create()
    {
        return view('user.add');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id = $request->userable_id;
        $user->remember_token = str::random(60);
        $user->save();

        return redirect('user.index')->with('sukses', 'Data User Berhasil Diinput');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id = $request->userable_id;
        $user->remember_token = str::random(60);
        $user->save();

        return redirect('user.index')->with('sukses', 'Data User Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return view('user.index')->with('sukses', 'Data User Berhasil Dihapus');
    }
}
