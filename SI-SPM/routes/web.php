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
Route::get('/about', function () {
    return view('about');
    
});

Route::get('/datauser', function () {
    return view('datauser');
});

Route::get('/home', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});

Route::get('/spm', function () {
    return view('spm');
});
Route::get('/inputspm', function () {
    return view('inputspm');
});

use App\Http\Controllers\DataSpmController;

Route::get('/dataspm', [SPMController::class, 'index'], function () {
    return view('/dataspm');
});
use App\Http\Controllers\DetailController;

Route::get('/detail/{nospm}', [DetailController::class, 'show'])->name('detail.show');
use App\Http\Controllers\SPMController;

Route::get('/dataspm', [DataSPMController::class, 'index'])->name('dataspm.index');  // Route untuk halaman index



Route::get('/search', [DataSpmController::class, 'showSearchForm']);
Route::post('/search', [DataSpmController::class, 'searchSPM']);

Route::get('search_form', [SPMController::class, 'search'])->name('spm.search');


Route::post('/search', [SPMController::class, 'search'])->name('search');


Route::get('/input-spm', [SPMController::class, 'create'])->name('spm.create'); // Menampilkan form
Route::post('/input-spm', [SPMController::class, 'store'])->name('spm.store');  // Menyimpan data


// Route untuk menampilkan form edit, menggunakan metode GET
Route::get('/edit/{nospm}', [SPMController::class, 'edit'])->name('edit');

// Route untuk memproses pembaruan data, menggunakan metode PUT
Route::put('/update/{nospm}', [SPMController::class, 'update'])->name('update');
use App\Http\Controllers\UserController;

Route::get('/input-user', [UserController::class, 'create'])->name('user.create'); // Menampilkan form
Route::post('/input-user', [UserController::class, 'store'])->name('user.store');  // Menyimpan data
Route::get('/datauser', [UserController::class, 'index'])->name('datauser.index');
Route::get('user/search', [UserController::class, 'search'])->name('user.search');

use App\Http\Controllers\RakController;

Route::get('/input-rak', [RakController::class, 'create'])->name('rak.create'); // Menampilkan form
Route::post('/input-rak', [RakController::class, 'store'])->name('rak.store');  // Menyimpan data
Route::get('/datarak', [RakController::class, 'index'])->name('datarak.index');
Route::get('rak/search', [RakController::class, 'search'])->name('rak.search');

use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::delete('/spm/{nospm}', [SPMController::class, 'destroy'])->name('destroy');

use App\Http\Controllers\LaporanSpmController;

Route::get('/laporan-spm', [LaporanSpmController::class, 'index'])->name('laporan.spm');
Route::get('/laporan-spm/pdf', [LaporanSpmController::class, 'exportPDF'])->name('laporan.spm.pdf');

Route::get('/laporan', function () {
    return view('laporan.index');
});
Route::get('/laporan/search', [LaporanSPMController::class, 'search'])->name('laporan.search');
Route::get('/laporan/convert-to-pdf', [LaporanSpmController::class, 'convertToPdf'])->name('laporan.convertToPdf');

Route::get('/laporanunit', function () {
    return view('laporanunit.index');
});

use App\Http\Controllers\LaporanSpmControllerUnit;

Route::get('/laporanunit', [LaporanSpmControllerUnit::class, 'showLaporanUnit'])->name('laporanunit.index');
Route::get('/laporanunit/search', [LaporanSpmControllerUnit::class, 'search'])->name('laporanunit.search');
Route::get('/laporanunit/pdf', [LaporanSpmControllerUnit::class, 'convertToPdf'])->name('laporanunit.convertToPdf');

//Route::get('/spm/{nospm}/pdf', [DetailController::class, 'generatePdf'])->name('detail.generatePdf');
Route::get('spm/{nospm}/pdf', [DetailController::class, 'generatePdf'])->name('detail.generatePdf');



// Show the form for editing a specific SPM
Route::get('/spm/{nospm}/edit', [SpmController::class, 'edit'])->name('edit');

// Update the specified SPM
Route::put('/spm/{nospm}', [SpmController::class, 'update'])->name('update');

//home

Route::get('/home', function () {
    return view('home');
})->name('home');

//



Route::get('/indexfilter', function () {
    return view('indexfilter');
});

Route::get('/indexfilter/search', [SPMController::class, 'search'])->name('indexfilter.search');



Route::post('/search', [DataSPMController::class, 'search'])->name('search');



Route::post('/dataspm', [DataSPMController::class, 'search'])->name('search');

use App\Http\Controllers\LaporanByNoSpmController;

Route::get('/laporanbyno', [LaporanByNoSpmController::class, 'showLaporan'])->name('laporanbyno.index');
Route::get('/laporanbyno/search', [LaporanByNoSpmController::class, 'search'])->name('laporanbyno.search');
Route::get('/laporanbyno/pdf', [LaporanByNoSpmController::class, 'convertToPdf'])->name('laporanbyno.convertToPdf');

use App\Http\Controllers\UnitController;

Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
Route::post('/unit', [UnitController::class, 'store']);


Route::delete('unit/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
Route::get('unit/{id_unit}/edit', [UnitController::class, 'edit'])->name('unit.edit');
Route::put('unit/{id_unit}', [UnitController::class, 'update'])->name('unit.update');

// Display the edit form for Rak
Route::get('rak/{id_rak}/edit', [RakController::class, 'edit'])->name('rak.edit');

// Handle the update of Rak data
Route::put('rak/{id_rak}', [RakController::class, 'update'])->name('rak.update');

// Handle the deletion of Rak data
Route::delete('rak/{id_rak}', [RakController::class, 'destroy'])->name('rak.destroy');

// Route untuk Hapus
Route::delete('datauser/{NIP}', [UserController::class, 'destroy'])->name('datauser.destroy');



// Route untuk menampilkan form edit (GET)
Route::get('/datauser/{NIP}/edit', [UserController::class, 'edit'])->name('datauser.edit');

// Route untuk melakukan update (PUT)
Route::put('/datauser/{NIP}', [UserController::class, 'update'])->name('datauser.update');

