<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Select2Controller;
use Illuminate\Support\Facades\Route;


    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/dashboard', 'index');
    });

    Route::controller(Select2Controller::class)->group(function () {
        Route::get('/select2/searchKabupaten', 'searchKabupaten');
        Route::get('/select2/searchKecamatan', 'searchKecamatan');
        Route::get('/select2/searchKelurahan', 'searchKelurahan');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index');
        Route::get('/login/logout', 'logout');
        Route::post('/login/login', 'login');
    });

    Route::controller(PenggunaController::class)->group(function () {
        Route::get('/pengguna', 'index');
        Route::get('/pengguna/tambah', 'tambah');
        Route::get('/pengguna/edit/{IdPrimary}', 'edit');
        Route::get('/pengguna/listindex', 'listindex');
        Route::get('/pengguna/hapus/{IdPrimary}', 'hapus');
        Route::get('/pengguna/getId/', 'getId');
        Route::post('/pengguna/simpan', 'simpan');
    });

    Route::controller(KabupatenController::class)->group(function () {
        Route::get('/kabupaten', 'index');
        Route::get('/kabupaten/tambah', 'tambah');
        Route::get('/kabupaten/edit/{IdPrimary}', 'edit');
        Route::get('/kabupaten/listindex', 'listindex');
        Route::get('/kabupaten/hapus/{IdPrimary}', 'hapus');
        Route::get('/kabupaten/getId/', 'getId');
        Route::post('/kabupaten/simpan', 'simpan');
    });

    Route::controller(KecamatanController::class)->group(function () {
        Route::get('/kecamatan', 'index');
        Route::get('/kecamatan/tambah', 'tambah');
        Route::get('/kecamatan/edit/{IdPrimary}', 'edit');
        Route::get('/kecamatan/listindex', 'listindex');
        Route::get('/kecamatan/hapus/{IdPrimary}', 'hapus');
        Route::get('/kecamatan/getId/', 'getId');
        Route::post('/kecamatan/simpan', 'simpan');
    });

    Route::controller(KelurahanController::class)->group(function () {
        Route::get('/kelurahan', 'index');
        Route::get('/kelurahan/tambah', 'tambah');
        Route::get('/kelurahan/edit/{IdPrimary}', 'edit');
        Route::get('/kelurahan/listindex', 'listindex');
        Route::get('/kelurahan/hapus/{IdPrimary}', 'hapus');
        Route::get('/kelurahan/getId/', 'getId');
        Route::post('/kelurahan/simpan', 'simpan');
    });
