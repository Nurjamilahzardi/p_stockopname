<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UPController;
use App\Http\Controllers\ULPController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
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
    return view('home');
});
Route::get('/layout', function () {
    return view('layout');
})->middleware('auth'); 

Auth::routes();

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    
    Route::get('trans/input', [TransaksiController::class, 'input'])->name('transaksi.input')->middleware('auth');
    Route::post('trans/input', [TransaksiController::class, 'caribarangmasuk'])->name('transaksi.inputPost')->middleware('auth');
    Route::get('trans/detail/{trans_id}', [TransaksiController::class, 'detail'])->name('transaksi.detail')->middleware('auth');
    Route::resource('transaksi', TransaksiController::class)->middleware('auth');
    Route::post('/simpandatamasuk', [TransaksiController::class, 'simpanDataMasuk'])->name('transaksi.simpanmasuk')->middleware('auth');
    Route::get('trans/keluar', [TransaksiController::class, 'keluar'])->name('transaksi.keluar')->middleware('auth');
    Route::post('trans/keluar', [TransaksiController::class, 'caribarangkeluar'])->name('transaksi.keluarPost')->middleware('auth');
    Route::post('/simpandatakeluar', [TransaksiController::class, 'simpanDataKeluar'])->name('transaksi.simpankeluar')->middleware('auth');
    Route::post('/autocomplete', [TransaksiController::class, 'autocomplete'])->name('transaksi.autocomplete');
    Route::get('/trans/keluar/cetak-barang-keluar/{trans_id}', [TransaksiController::class, 'cetakBarangKeluar'])->name('cetak-barang-keluar')->middleware('auth');
    Route::get('/trans/masuk/cetak-barang-masuk/{trans_id}', [TransaksiController::class, 'cetakBarangMasuk'])->name('cetak-barang-masuk')->middleware('auth');
    Route::get('trans/barangkeluar', [TransaksiController::class, 'barangkeluar'])->middleware('auth');
    Route::get('trans/barangmasuk', [TransaksiController::class, 'barangmasuk'])->middleware('auth');
    
    Route::get('/report', [App\Http\Controllers\DashboardController::class, 'laporan'])->name('dashboard')->middleware('auth');
    Route::get('/report/print', [App\Http\Controllers\DashboardController::class, 'print'])->name('print')->middleware('auth');
    Route::post('/report', [App\Http\Controllers\DashboardController::class,'filter'])->name('dashboard.filter')->middleware('auth');
    Route::resource('/barang', \App\Http\Controllers\BarangController::class)->middleware('auth');
    Route::get('/barang-unit', [\App\Http\Controllers\BarangController::class,'barangunit'])->middleware('auth');
    Route::resource('/up', \App\Http\Controllers\UPController::class)->middleware('auth');
    Route::resource('/ulp', \App\Http\Controllers\ULPController::class)->middleware('auth');
    Route::resource('/user', \App\Http\Controllers\UserController::class)->middleware('auth');
// Route user
    Route::get('/beranda', [TransaksiController::class, 'trans']);

    //up
    Route::get('/up-informasi', [App\Http\Controllers\UPController::class, 'index'])->middleware('auth');
    Route::get('/up-up3padang', [App\Http\Controllers\UPController::class, 'up3padang'])->name('up3padang')->middleware('auth');
    Route::get('/up-up3bukittinggi', [App\Http\Controllers\UPController::class, 'up3bukittinggi'])->name('up3bukittinggi')->middleware('auth');
    Route::get('/up-up3solok', [App\Http\Controllers\UPController::class, 'up3solok'])->name('up3solok')->middleware('auth');
    Route::get('/up-up3payakumbuh', [App\Http\Controllers\UPController::class, 'up3payakumbuh'])->name('up3payakumbuh')->middleware('auth');
    Route::get('/up-up2d', [App\Http\Controllers\UPController::class, 'up2d'])->name('up2d')->middleware('auth');
