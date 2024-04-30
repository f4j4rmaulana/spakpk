<?php

use App\Models\JenisUjikom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UjikomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelatihanController;
use App\Http\Controllers\Admin\JenisUjikomController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\JenisPelatihanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;

Route::group(['middleware' => ['guest:admin'], 'prefix' => 'admin', 'as' => 'admin.'],function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'],function () {

    /** Dashboard Route */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /** Jenis Pelatihan Route */
    // ajax harus ditempatkan diatas resource agar terbaca
    Route::get('/jenis-pelatihan/ajax', [JenisPelatihanController::class, 'ajax'])->name('jenis-pelatihan.ajax');
    Route::get('/jenis-pelatihan/active/{id}', [JenisPelatihanController::class, 'active'])->name('jenis-pelatihan.active');
    Route::get('/jenis-pelatihan/nonactive/{id}', [JenisPelatihanController::class, 'nonactive'])->name('jenis-pelatihan.nonactive');
    Route::resource('jenis-pelatihan', JenisPelatihanController::class);

    /** Pelatihan Route */
    Route::get('/pelatihan/ajax', [PelatihanController::class, 'ajax'])->name('pelatihan.ajax');
    Route::get('/pelatihan/active/{id}', [PelatihanController::class, 'active'])->name('pelatihan.active');
    Route::get('/pelatihan/nonactive/{id}', [PelatihanController::class, 'nonactive'])->name('pelatihan.nonactive');
    Route::resource('pelatihan', PelatihanController::class);

    /** Jenis Uji Kompetensi Route */
    Route::get('/jenis-ujikom/ajax', [JenisUjikomController::class, 'ajax'])->name('jenis-ujikom.ajax');
    Route::get('/jenis-ujikom/active/{id}', [JenisUjikomController::class, 'active'])->name('jenis-ujikom.active');
    Route::get('/jenis-ujikom/nonactive/{id}', [JenisUjikomController::class, 'nonactive'])->name('jenis-ujikom.nonactive');
    Route::resource('jenis-ujikom', JenisUjikomController::class);

    /** Uji Kompetensi Route */
    Route::get('/ujikom/ajax', [UjikomController::class, 'ajax'])->name('ujikom.ajax');
    Route::get('/ujikom/active/{id}', [UjikomController::class, 'active'])->name('ujikom.active');
    Route::get('/ujikom/nonactive/{id}', [UjikomController::class, 'nonactive'])->name('ujikom.nonactive');
    Route::resource('ujikom', UjikomController::class);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
