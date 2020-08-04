<?php

use App\Admin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('pengguna', 'UserController');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('profile', 'ProfileController@edit')->name('profile.edit');
        Route::patch('profile', 'ProfileController@update')->name('profile.update');
    });

    Route::resource('dosen', 'DosenController');

    Route::resource('admin', 'AdminController');

    Route::resource('mahasiswa', 'MahasiswaController');

    Route::group(['prefix' => 'konsultasi'], function () {
        Route::resource('/konsultasi', 'KonsultasiController');
        Route::get('/cetak_pdf', ['uses' => 'KonsultasiController@cetak_pdf', 'as' => 'konsultasi.cetak_pdf']);
    });
});
