<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
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
    }

    public function store(Request $request)
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
