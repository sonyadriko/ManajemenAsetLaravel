<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk menampilkan halaman daftar aset
Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
// Route untuk mengekspor data aset ke Excel
Route::get('/aset/export', [AsetController::class, 'export'])->name('aset.export');
Route::get('/aset/tambah', [AsetController::class, 'create'])->name('aset.create'); // Menampilkan form
Route::post('/aset/tambah', [AsetController::class, 'store'])->name('aset.store'); // Memproses data
// Route untuk mendapatkan kabupaten berdasarkan provinsi
Route::post('/get-kabupaten', [AsetController::class, 'getKabupaten'])->name('get.kabupaten');

// Route untuk mendapatkan kecamatan berdasarkan kabupaten
Route::post('/get-kecamatan', [AsetController::class, 'getKecamatan'])->name('get.kecamatan');

require __DIR__.'/auth.php';
