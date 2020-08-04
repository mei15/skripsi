<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $mhs = Mahasiswa::all();
        return view('mahasiswa.index', compact('mhs'));
    }

    public function create()
    {
        return view('mahasiswa.add');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::where([
            'userable_type' => Mahasiswa::class,
            'userable_id' => $mahasiswa->id
        ])->first();

        return view('mahasiswa.edit', compact('mahasiswa', 'user'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nim'           => 'required',
            'prodi'         => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        // Make transaction, biar pasti keinsert dua2 nya query
        DB::beginTransaction();

        try {
            $mhs = Mahasiswa::find($id);
            $mhs->first_name = $request->first_name;
            $mhs->last_name = $request->last_name;
            $mhs->nim = $request->nim;
            $mhs->prodi = $request->prodi;
            $mhs->save();

            $user = User::where([
                'userable_type' => Mahasiswa::class,
                'userable_id' => $mhs->id
            ])->first();

            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        } catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return redirect()->route('mahasiswa.index');
        }

        session()->flash('success', 'Sukses Ubah Data Mahasiswa ' . $mhs->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nim'           => 'required',
            'prodi'         => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        // Make transaction, biar pasti keinsert dua2 nya query
        DB::beginTransaction();

        try {
            $mhs = new Mahasiswa;
            $mhs->first_name = $request->first_name;
            $mhs->last_name = $request->last_name;
            $mhs->nim = $request->nim;
            $mhs->prodi = $request->prodi;
            $mhs->save();

            $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->userable_type = Mahasiswa::class;
            $user->userable_id = $mhs->id;
            $user->email_verified_at = Carbon::now();
            $user->remember_token = Str::random(40);
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        } catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return redirect()->route('mahasiswa.index');
        }

        session()->flash('success', 'Sukses Tambah Data Mahasiswa ' . $mhs->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::find($id);
        $user = User::where([
            'userable_type' => Mahasiswa::class,
            'userable_id' => $mhs->id
        ])->first();

        $mhs->delete();
        $user->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Dihapus !');
    }
}
