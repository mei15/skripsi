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

        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return  response()->json([
                'status' => 'invalid_credentials',
                'message' => 'Tidak ada data.',
            ], 401);
        }

        return  response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
        ]);
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
    public  function  logout(Request  $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return  response()->json([
                'status' => 'ok',
                'message' => 'Cierre de sesión exitoso.'
            ]);
        } catch (JWTException  $exception) {
            return  response()->json([
                'status' => 'unknown_error',
                'message' => 'Al usuario no se le pudo cerrar la sesión.'
            ], 500);
        }
    }

    public  function  getAuthUser(Request  $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        return  response()->json(['user' => $user]);
    }

    protected function jsonResponse($data, $code = 200)
    {
        return response()->json(
            $data,
            $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
