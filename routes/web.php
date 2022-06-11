<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

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
    return view('welcome');
});

// Home
Route::get('/home', function () {
    return view('dashboard');
})->name('home');

// Operator
Route::get('/operator', [OperatorController::class, 'index'])->name('operator');
Route::get('/tambahoperator',[OperatorController::class, 'create'])->name('tambahoperator');
Route::post('/insertoperator',[OperatorController::class, 'store'])->name('insertoperator');
Route::get('/editoperator/{id}',[OperatorController::class, 'edit'])->name('editoperator');
Route::put('/updateoperator/{id}',[OperatorController::class, 'update'])->name('updateoperator');
Route::get('/deleteoperator/{id}',[OperatorController::class, 'destroy'])->name('deleteoperator');

// Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/tambahbarang',[BarangController::class, 'create'])->name('tambahbarang');
Route::post('/insertbarang',[BarangController::class, 'store'])->name('insertbarang');
Route::get('/editbarang/{id}',[BarangController::class, 'edit'])->name('editbarang');
Route::put('/updatebarang/{id}',[BarangController::class, 'update'])->name('updatebarang');
Route::get('/deletebarang/{id}',[BarangController::class, 'destroy'])->name('deletebarang');

// Barang Masuk
Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk');
Route::get('/tambahbarangmasuk',[BarangMasukController::class, 'create'])->name('tambahbarangmasuk');
Route::post('/insertbarangmasuk',[BarangMasukController::class, 'store'])->name('insertbarangmasuk');
Route::get('/editbarangmasuk/{id}',[BarangMasukController::class, 'edit'])->name('editbarangmasuk');
Route::put('/updatebarangmasuk/{id}',[BarangMasukController::class, 'update'])->name('updatebarangmasuk');
Route::get('/deletebarangmasuk/{id}',[BarangMasukController::class, 'destroy'])->name('deletebarangmasuk');

// Barang Keluar
Route::get('/barangkeluar', [BarangKeluarController::class, 'keluar'])->name('barangkeluar');
Route::get('/tambahbarangkeluar',[BarangKeluarController::class, 'create'])->name('tambahbarangkeluar');
Route::post('/insertbarangkeluar',[BarangKeluarController::class, 'store'])->name('insertbarangkeluar');
Route::get('/editbarangkeluar/{id}',[BarangKeluarController::class, 'edit'])->name('editbarangkeluar');
Route::put('/updatebarangkeluar/{id}',[BarangKeluarController::class, 'update'])->name('updatebarangkeluar');
Route::get('/deletebarangkeluar/{id}',[BarangKeluarController::class, 'destroy'])->name('deletebarangkeluar');