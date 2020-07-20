<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Level;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'LIKE', "%$search%")->orderBy('id', 'desc')->paginate(10);

        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Level::all();
        return response()->json('roles');
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
            'name' => 'required',
            'id_num' => 'required',
            'tlp' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required|unique:users',
            'role' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->id_num = $request->id_num;
        $user->tlp = $request->tlp;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->level_id = $request->role;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json('success', 201);
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
        $user = User::findOrFail($id);
        $roles = Level::all();

        return response()->json($user, $roles);
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
            'name' => 'required',
            'id_num' => 'required',
            'tlp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->id_num = $request->id_num;
        $user->tlp = $request->tlp;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->level_id = $request->role;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->update($request->all());
        return response()->json('update success', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('delete success');
    }
}
