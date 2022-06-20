<?php

use App\Models\User;
// use ChangeController;
// use ChangeController;
// use App\Http\Controllers\ChangeController;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use PHPUnit\Framework\Constraint\Operator;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// register
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/postregister', [RegisterController::class, 'postregister'])->name('postregister');


// Login
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// change password
// Route::get('/change', [ChangeController::class, 'change_password'])->name('change');

// Route::patch('/update', [ChangeController::class, 'update_password'])->name('update_password');

// middleware
Route::group(['middleware' => ['auth']], function () {
    // Home
    Route::get('/home', function () {
        $datamasuk = BarangMasuk::count();
        $datakeluar = BarangKeluar::count();
        $databarang = Barang::count();
        $datauser = User::count();
        return view('dashboard', compact('datamasuk', 'datakeluar', 'databarang', 'datauser'));
    })->name('home');
});



// Operator
Route::get('/operator', [OperatorController::class, 'index'])->name('operator');
Route::get('/tambahoperator', [OperatorController::class, 'create'])->name('tambahoperator');
Route::post('/insertoperator', [OperatorController::class, 'store'])->name('insertoperator');
Route::get('/editoperator/{id}', [OperatorController::class, 'edit'])->name('editoperator');
Route::put('/updateoperator/{id}', [OperatorController::class, 'update'])->name('updateoperator');
Route::get('/deleteoperator/{id}', [OperatorController::class, 'destroy'])->name('deleteoperator');

// Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/tambahbarang', [BarangController::class, 'create'])->name('tambahbarang');
Route::post('/insertbarang', [BarangController::class, 'store'])->name('insertbarang');
Route::get('/editbarang/{id}', [BarangController::class, 'edit'])->name('editbarang');
Route::put('/updatebarang/{id}', [BarangController::class, 'update'])->name('updatebarang');
Route::get('/deletebarang/{id}', [BarangController::class, 'destroy'])->name('deletebarang');

// Barang Masuk
Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk');
Route::get('/tambahbarangmasuk', [BarangMasukController::class, 'create'])->name('tambahbarangmasuk');
Route::post('/insertbarangmasuk', [BarangMasukController::class, 'store'])->name('insertbarangmasuk');
Route::get('/editbarangmasuk/{id}', [BarangMasukController::class, 'edit'])->name('editbarangmasuk');
Route::put('/updatebarangmasuk/{id}', [BarangMasukController::class, 'update'])->name('updatebarangmasuk');
Route::get('/deletebarangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('deletebarangmasuk');
Route::get('/excelbarangmasuk', [BarangMasukController::class, 'excel'])->name('excelbarangmasuk');

// Barang Keluar
Route::get('/barangkeluar', [BarangKeluarController::class, 'keluar'])->name('barangkeluar');
Route::get('/tambahbarangkeluar', [BarangKeluarController::class, 'create'])->name('tambahbarangkeluar');
Route::post('/insertbarangkeluar', [BarangKeluarController::class, 'store'])->name('insertbarangkeluar');
Route::get('/editbarangkeluar/{id}', [BarangKeluarController::class, 'edit'])->name('editbarangkeluar');
Route::put('/updatebarangkeluar/{id}', [BarangKeluarController::class, 'update'])->name('updatebarangkeluar');
Route::get('/deletebarangkeluar/{id}', [BarangKeluarController::class, 'destroy'])->name('deletebarangkeluar');
Route::get('/excelbarangkeluar', [BarangKeluarController::class, 'excel'])->name('excelbarangkeluar');

