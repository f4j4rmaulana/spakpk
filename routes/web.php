<?php

use App\Http\Controllers\Internal\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Internal\Admin\UsulanPelatihanController as AdminUsulanPelatihanController;
use App\Http\Controllers\Internal\Admin\UsulanUjikomController as AdminUsulanUjikomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Internal\DashboardController;
use App\Http\Controllers\Internal\UsulanUjikomController;
use App\Http\Controllers\Internal\UsulanPelatihanController;

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
    return view('frontend.layouts.master');
});


Route::group(['middleware' => ['auth'], 'as' => 'internal.'],function () {

    /** Dashboard Route */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /** Usulan Pelatihan Route */
    Route::get('/usulan-pelatihan/ajax-get-jenis-pelatihan', [UsulanPelatihanController::class, 'ajaxGetJenisPelatihan'])->name('usulan-pelatihan.ajaxGetJenisPelatihan');
    Route::get('/usulan-pelatihan/ajax-get-pelatihan', [UsulanPelatihanController::class, 'ajaxGetPelatihan'])->name('usulan-pelatihan.ajaxGetPelatihan');
    Route::get('/usulan-pelatihan/ajax', [UsulanPelatihanController::class, 'ajax'])->name('usulan-pelatihan.ajax');
    Route::resource('usulan-pelatihan', UsulanPelatihanController::class);

    /** Usulan Ujikom Route */
    Route::get('/usulan-ujikom/ajax-get-jenis-ujikom', [UsulanUjikomController::class, 'ajaxGetJenisUjikom'])->name('usulan-ujikom.ajaxGetJenisUjikom');
    Route::get('/usulan-ujikom/ajax-get-ujikom', [UsulanUjikomController::class, 'ajaxGetUjikom'])->name('usulan-ujikom.ajaxGetUjikom');
    Route::get('/usulan-ujikom/ajax', [UsulanUjikomController::class, 'ajax'])->name('usulan-ujikom.ajax');
    Route::resource('usulan-ujikom', UsulanUjikomController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/** Internal Admin Route */
Route::group(['middleware' => ['auth', 'cek.akun:multirole'], 'prefix' => 'internal/admin', 'as' => 'internal.admin.'],function () {

    /** Dashboard Route */
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /** Usulan Pelatihan Route */
    Route::get('/usulan-pelatihan/ajax-get-users', [AdminUsulanPelatihanController::class, 'ajaxGetUsers'])->name('usulan-pelatihan.ajaxGetUsers');
    Route::get('/usulan-pelatihan/ajax-get-jenis-pelatihan', [AdminUsulanPelatihanController::class, 'ajaxGetJenisPelatihan'])->name('usulan-pelatihan.ajaxGetJenisPelatihan');
    Route::get('/usulan-pelatihan/ajax-get-pelatihan', [AdminUsulanPelatihanController::class, 'ajaxGetPelatihan'])->name('usulan-pelatihan.ajaxGetPelatihan');
    Route::get('/usulan-pelatihan/ajax', [AdminUsulanPelatihanController::class, 'ajax'])->name('usulan-pelatihan.ajax');
    Route::get('/usulan-pelatihan/ajax/validasi/{id}', [AdminUsulanPelatihanController::class, 'ajaxValidasi'])->name('usulan-pelatihan.ajaxValidasi');
    Route::get('/usulan-pelatihan/ajax/nonvalidasi/{id}', [AdminUsulanPelatihanController::class, 'ajaxNonValidasi'])->name('usulan-pelatihan.ajaxNonValidasi');
    Route::resource('usulan-pelatihan', AdminUsulanPelatihanController::class);

    /** Usulan Ujikom Route */
    Route::get('/usulan-ujikom/ajax-get-users', [AdminUsulanUjikomController::class, 'ajaxGetUsers'])->name('usulan-ujikom.ajaxGetUsers');
    Route::get('/usulan-ujikom/ajax-get-jenis-ujikom', [AdminUsulanUjikomController::class, 'ajaxGetJenisUjikom'])->name('usulan-ujikom.ajaxGetJenisUjikom');
    Route::get('/usulan-ujikom/ajax-get-ujikom', [AdminUsulanUjikomController::class, 'ajaxGetUjikom'])->name('usulan-ujikom.ajaxGetUjikom');
    Route::get('/usulan-ujikom/ajax', [AdminUsulanUjikomController::class, 'ajax'])->name('usulan-ujikom.ajax');
    Route::get('/usulan-ujikom/ajax/validasi/{id}', [AdminUsulanUjikomController::class, 'ajaxValidasi'])->name('usulan-ujikom.ajaxValidasi');
    Route::get('/usulan-ujikom/ajax/nonvalidasi/{id}', [AdminUsulanUjikomController::class, 'ajaxNonValidasi'])->name('usulan-ujikom.ajaxNonValidasi');
    Route::resource('usulan-ujikom', AdminUsulanUjikomController::class);

});

require __DIR__.'/auth.php';
