<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\ReturnTypePass;

class LoginApiController extends Controller
{
    public function login(Request $request, JWTAuth $jWTAuth)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->JWTAuth::attempt($credentials)) {
            $token = auth()->user()->JWTAuth::createToken('MySecret')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function me()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
    // $credentials = $request->only('email', 'password');

    // try {
    //     if (!$token = JWTAuth::attempt($credentials)) {
    //         return response()->json(['message' => 'Email atau password salah!'], 400);
    //     }
    // } catch (JWTException $e) {
    //     return response()->json(['message' => 'Tidak dapat mengambil token!'], 500);
    // }

    // return response()->json([
    //     'access_token' => $token,
    //     'token_type' => 'bearer',
    //     'expires_in' => JWTAuth::factory()->getTTL() * 60
    // ]);



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function me()
    // {
    //     $user = JWTAuth::user();
    //     if (count((array)$user) > 0) {
    //         return response()->json(['status' => 'success', 'user' => $user]);
    //     } else {
    //         return response()->json(['status' => 'fail'], 401);
    //     }
    // }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function logout()
    // {
    //     Auth::logout();

    //     return response()->json(['message' => 'Sukses keluar!']);
    // }
}
