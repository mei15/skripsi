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

Route::post('/', 'APILoginController@login');


Route::middleware('jwt.verify')->get('/users', function (Request $request) {
    return auth()->user();
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
