<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Dosen;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.add');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);

        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nip'           => 'required',
            'prodi'         => 'required',
        ]);

        $dosen = Dosen::find($id);
        $dosen->first_name = $request->first_name;
        $dosen->last_name = $request->last_name;
        $dosen->nip = $request->nip;
        $dosen->prodi = $request->prodi;
        $dosen->save();

        session()->flash('success', 'Sukses Ubah Data Dosen ' . $dosen->first_name);
        return redirect()->route('dosen.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'nip'           => 'required',
            'prodi'         => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        // Make transaction, biar pasti keinsert dua2 nya query
        DB::beginTransaction();

        try {
            $dosen = new Dosen;
            $dosen->first_name = $request->first_name;
            $dosen->last_name = $request->last_name;
            $dosen->nip = $request->nip;
            $dosen->prodi = $request->prodi;
            $dosen->save();

            $user = new User;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->email = $request->email;
            $user->userable_type = Dosen::class;
            $user->userable_id = $dosen->id;
            $user->email_verified_at = Carbon::now();
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        }
        catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return redirect()->route('dosen.index');
        }
        
        session()->flash('success', 'Sukses Tambah Data Dosen ' . $dosen->first_name);
        return redirect()->route('dosen.index');
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        
        return redirect('/dosen')->with('sukses', 'Data Dosen Berhasil Dihapus !');
    }
}
