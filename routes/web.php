<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
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

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSimpan'])->name('register.save');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/aksi', [AuthController::class, 'loginAksi'])->name('login.aksi');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix("barang")->group(function () {
    Route::get('/index', [BarangController::class, 'index'])->name('barang');
    Route::get('/tambah', [BarangController::class,'tambah'])->name('barang.tambah');
    Route::post('tambah', [BarangController::class,'simpan'])->name('barang.tambah.simpan');
    Route::get('edit/{id}', [BarangController::class,'edit'])->name('barang.edit');
    Route::post('edit{id}', [BarangController::class,'update'])->name('barang.tambah.update');
    Route::get('hapus/{id}', [BarangController::class, 'hapus'])->name('barang.hapus');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
});
