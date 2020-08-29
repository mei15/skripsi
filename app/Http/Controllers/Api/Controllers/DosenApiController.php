<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DosenApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosens = Dosen::all();
        return response()->json($dosens, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->userable_type = Dosen::class;
            $user->userable_id = $dosen->id;
            $user->remember_token = Str::random(40);
            $user->email_verified_at = Carbon::now();
            $user->save();

            // commit biar perubahan di DB nya kesave
            DB::commit();
        } catch (\Exception $err) {
            // rollback DB nya, datanya gajadi diinput
            DB::rollBack();

            session()->flash('error', 'Terjadi kesalahan!');
            return response()->json('success', 201);
        }
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
            $dosen = Dosen::find($id);
            $dosen->first_name = $request->first_name;
            $dosen->last_name = $request->last_name;
            $dosen->nip = $request->nip;
            $dosen->prodi = $request->prodi;
            $dosen->save();

            $user = User::where([
                'userable_type' => Dosen::class,
                'userable_id' => $dosen->id
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
            return response()->json('success', 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $user = User::where([
            'userable_type' => Dosen::class,
            'userable_id' => $dosen->id
        ])->first();
        $dosen->delete();
        $user->delete();
        return response()->json('delete success');
    }
}
