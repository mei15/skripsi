<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.add');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::where([
            'userable_type' => Mahasiswa::class,
            'userable_id' => $mahasiswa->id
        ])->first();

        return view('mahasiswa.edit', compact('mahasiswa', 'user'));
    }

    public function update(Request $request, $id)
    {
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
            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa->first_name = $request->first_name;
            $mahasiswa->last_name = $request->last_name;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->prodi = $request->prodi;
            $mahasiswa->save();

            $user = User::where([
                'userable_type' => Mahasiswa::class,
                'userable_id' => $mahasiswa->id
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

        session()->flash('success', 'Sukses Ubah Data Mahasiswa ' . $mahasiswa->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function store(Request $request)
    {
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
            $mahasiswa = new Mahasiswa;
            $mahasiswa->first_name = $request->first_name;
            $mahasiswa->last_name = $request->last_name;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->prodi = $request->prodi;
            $mahasiswa->save();

            $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->userable_type = Mahasiswa::class;
            $user->userable_id = $mahasiswa->id;
            $user->remember_token = Str::random(40);
            $user->email_verified_at = Carbon::now();
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        } catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return redirect()->route('mahasiswa.index');
        }
        
        session()->flash('success', 'Sukses Tambah Data Mahasiswa ' . $mahasiswa->first_name);
        return redirect()->route('mahasiswa.index');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::where([
            'userable_type' => Mahasiswa::class,
            'userable_id' => $mahasiswa->id
        ])->first();
        $mahasiswa->delete();
        $user->delete();
        return redirect('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Dihapus !');
    }
}
