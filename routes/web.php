<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\PengaturanController;
use App\Http\Controllers\admin\PenggunaController;
use App\Http\Controllers\admin\Select2Controller;
use Illuminate\Support\Facades\Route;


    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/dashboard', 'index');
    });

    Route::controller(Select2Controller::class)->group(function () {
        Route::get('/select2/kategori', 'kategori');
        Route::get('/select2/formasiasn', 'formasiasn');
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
