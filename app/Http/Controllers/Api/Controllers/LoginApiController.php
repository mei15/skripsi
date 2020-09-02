<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    public function login(Request $request, JWTAuth $jWTAuth)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                # code...
                return response()->json(['error' => 'invalid username and password'], 401);
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'could not create token'], 500);
        }


        return response()->json(compact('token'));
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
    public function me()
    {
        $user = JWTAuth::user();
        if (count((array)$user) > 0) {
            return response()->json(['status' => 'success', 'user' => $user]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Sukses keluar!']);
    }
}
