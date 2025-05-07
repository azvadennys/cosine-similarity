<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Additional routes for Mahasiswa (Students)
    Route::post('/kelas/join', [KelasController::class, 'joinClass'])->name('kelas.join');
    Route::post('/kelas/leave/{kelas}', [KelasController::class, 'leaveClass'])->name('kelas.leave');

    //Route for Tugas
    Route::get('/tugas/create/{id}', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/tugas/hasil/{id}', [TugasController::class, 'hasilTugas'])->name('tugas.hasil');


    Route::get('/tugas/kerjakan/{id}', [TugasController::class, 'kerjakan'])->name('tugas.kerjakan');
    Route::post('/tugas/kerjakan/simpan/{id}', [TugasController::class, 'simpanJawaban'])->name('tugas.simpanJawaban');
});

Route::middleware(['auth'])->group(
    function () {
        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
        Route::get('/pengguna/create', [UserController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    }
);