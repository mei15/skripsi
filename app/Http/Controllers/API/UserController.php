<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login()
    //     {
    //         if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
    //             $user = Auth::user();
    //             $success['token'] = $user->createToken('appToken')->accessToken;

    //            //After successfull authentication, notice how I return json parameters
    //             return response()->json([
    //               'success' => true,
    //               'token' => $success,
    //               'user' => $user,
                  
    //           ]);
    //         } else {
    //        //if authentication is unsuccessfull, notice how I return json parameters
    //           return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid Email or Password',
    //         ], 401);
    //         }
    //     }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (Auth::attempt($credentials)) {
            $success = auth()->user()->createToken('MySecret')->accessToken;
            $user = Auth::user();
            return response()->json([
              'token' => $success,
              'user' => $user,
              
          ]);
        } else {
       //if authentication is unsuccessfull, notice how I return json parameters
          return response()->json([
            'message' => 'Invalid Email or Password',
        ], 401);
        }
    }

    

    public function detail(){
      return response()->json([
        'user' => auth()->user()->userable
        ]);
    }

         /**
     * Logout api.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function logout(Request $res)
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
}
