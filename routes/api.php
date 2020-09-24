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
Route::post('/login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/logout', 'API\UserController@logout');
    Route::get('/details', 'API\UserController@detail');
    Route::resource('/konsultasi', 'API\KonsultasiApiController');

    

}); 

Route::get('/dosen','API\ApiController@dsn');
Route::get('/mahasiswa','API\ApiController@mhs');
Route::get('/judul', 'API\ApiController@judul');

// Route::fallback(function () {
//     return response()->json([
//         "message" => "This API is not found!",
//     ], 404);
// });
