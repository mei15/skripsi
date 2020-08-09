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

Route::get('/', function () {
    return response()->json([
        'hello' => 'world!',
    ], 200);
});


Route::prefix('auth')->group(function () {
    Route::post('/login', 'Api\LoginApiController@login');
    Route::get('/logout', 'Api\LoginApiController@logout')->middleware('jwt.verify');
    Route::get('/me', 'Api\LoginApiController@me')->middleware('jwt.verify');
});

Route::middleware('jwt.verify')->group(function () {
    Route::get('/semuadosen', 'Api\DosenApiController');
});

Route::middleware('jwt.verify')->group(function () {
    Route::resource('/semuamahasiswa', 'Api\MahasiswaApiController');
});

Route::middleware('jwt.verify')->group(function () {
    Route::resource('/konsultasi', 'Api\KonsultasiApiController');
});


// Route::resource('/dosen', 'Api\DosenApiController');
// Route::resource('/user', 'Api\UserApiController');

// Route::resource('/konsultasi', 'Api\KonsultasiApiController');

// Route::get('/laporan', 'Api\LaporanApiController@index'); // ditambah nama methodnya

// Route::get('/data', 'Api\ApiController@getDataByUser');

// Route::get('/konsul', 'Api\ApiController@getDataByDosen');

// Route::get('/kuser', 'Api\ApiController@getDataKonsul');

// Route::get('/kusen', 'Api\ApiController@getDataKonsulDosen');

// Untuk pesan error, kalo route diatas gk ada yg sama A.K.A. Error Handling
Route::fallback(function () {
    return response()->json([
        "message" => "This API is not found!",
    ], 404);
});
