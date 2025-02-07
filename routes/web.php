<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/simpan', [App\Http\Controllers\HomeController::class, 'simpan'])->name('simpan');
Route::get('/ubah/{idkegiatan}/{status}', [App\Http\Controllers\HomeController::class, 'ubahStatus'])->name('ubahStatus');
Route::get('/hapus/{id}', [App\Http\Controllers\HomeController::class, 'hapus'])->name('hapus');
Route::get('/edit{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::put('/editproses/{id}', action: [App\Http\Controllers\HomeController::class, 'editproses'])->name('editproses');



