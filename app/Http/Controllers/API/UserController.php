<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
        {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('appToken')->accessToken;
               //After successfull authentication, notice how I return json parameters
                return response()->json([
                  'success' => true,
                  'token' => $success,
                  'user' => $user
              ]);
            } else {
           //if authentication is unsuccessfull, notice how I return json parameters
              return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
            }
        }

    public function logout(Request $request)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }

    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
