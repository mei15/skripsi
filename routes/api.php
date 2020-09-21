<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user/detail', 'API\UserController@details');
    Route::post('logout', 'API\UserController@logout');
}); 
// Route::prefix('auth')->group(function () {
//     Route::post('/login', 'Api\LoginApiController@login');
//     Route::get('/logout', 'Api\LoginApiController@logout')->middleware('jwt.verify');
//     Route::get('/me', 'Api\LoginApiController@me')->middleware('jwt.verify');
// });

// Route::middleware('jwt.verify')->group(function () {
//     Route::get('/semuadosen', 'Api\DosenApiController@index');
// });

// Route::middleware('jwt.verify')->group(function () {
//     Route::get('/semuamahasiswa', 'Api\MahasiswaApiController@index');
// });

// Route::middleware('jwt.verify')->group(function () {
//     Route::resource('/konsultasi', 'Api\KonsultasiApiController');
// });

//Untuk pesan error, kalo route diatas gk ada yg sama A.K.A. Error Handling

// Route::fallback(function () {
//     return response()->json([
//         "message" => "This API is not found!",
//     ], 404);
// });
