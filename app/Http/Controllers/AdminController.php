<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.add');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $user = User::where([
            'userable_type' => Admin::class,
            'userable_id' => $admin->id
        ])->first();

        return view('admin.edit', compact('admin', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        // Make transaction, biar pasti keinsert dua2 nya query
        DB::beginTransaction();

        try {
            $admin = Admin::find($id);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->save();

            $user = User::where([
                'userable_type' => Admin::class,
                'userable_id' => $admin->id
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
            return redirect()->route('admin.index');
        }

        session()->flash('success', 'Sukses Ubah Data Admin ' . $admin->first_name);
        return redirect()->route('admin.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        // Make transaction, biar pasti keinsert dua2 nya query
        DB::beginTransaction();

        try {
            $admin = new Admin;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->save();

            $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->userable_type = Admin::class;
            $user->userable_id = $admin->id;
            $user->remember_token = Str::random(40);
            $user->email_verified_at = Carbon::now();
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        } catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return redirect()->route('admin.index');
        }

        session()->flash('success', 'Sukses Tambah Data Admin ' . $admin->first_name);
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect('admin.index')->compact('admin')->with('sukses', 'Data Admin Berhasil Dihapus !');
    }
}
