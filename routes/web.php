<?php

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

    Route::resource('dosen', 'DosenController');

    Route::middleware(['role.dosen', 'role.admin', 'role.mahasiswa'])->group(function () {
        Route::prefix('laporan')->group(function () {
            Route::get('/', 'LaporanController@index')->name('laporan.index');
        });
    });

    Route::middleware(['role.mahasiswa', 'role.dosen'])->group(function () {
        Route::prefix('konsultasi')->group(function () {
            Route::resource('konsultasi', 'KonsultasiController');
        });
    });
});
