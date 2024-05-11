<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Eksternal\DashboardController;
use App\Http\Controllers\Eksternal\UsulanUjikomController;
use App\Http\Controllers\Eksternal\Auth\PasswordController;
use App\Http\Controllers\Eksternal\ProfileUpdateController;
use App\Http\Controllers\Eksternal\UsulanPelatihanController;
use App\Http\Controllers\Eksternal\Auth\NewPasswordController;
use App\Http\Controllers\Eksternal\Auth\VerifyEmailController;
use App\Http\Controllers\Eksternal\Auth\RegisteredUserController;
use App\Http\Controllers\Eksternal\Auth\PasswordResetLinkController;
use App\Http\Controllers\Eksternal\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Eksternal\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Eksternal\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Ekt\DashboardController as EktDashboardController;
use App\Http\Controllers\Eksternal\Auth\EmailVerificationNotificationController;

Route::group(['middleware' => ['guest:ekt'], 'prefix' => 'eksternal', 'as' => 'eksternal.'],function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

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

Route::group(['middleware' => ['auth:ekt'], 'prefix' => 'eksternal', 'as' => 'eksternal.'],function () {

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

    /** Profile Update Route */
    Route::post('profile/password-update', [ProfileUpdateController::class, 'passwordUpdate'])->name('profile.password-update');
    Route::post('profile/update', [ProfileUpdateController::class, 'update'])->name('profile.update');
    Route::get('profile', [ProfileUpdateController::class, 'index'])->name('profile.index');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
