<?php

use App\Models\Pengaturan;
use App\Models\JenisUjikom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\UjikomController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelatihanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\JenisUjikomController;
use App\Http\Controllers\Admin\UsulanUjikomController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\ProfileUpdateController;
use App\Http\Controllers\Admin\JenisPelatihanController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UsulanPelatihanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\UserController;

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

     /** Usulan Pelatihan Route */
    Route::get('/usulan-pelatihan/ajax-get-users', [UsulanPelatihanController::class, 'ajaxGetUsers'])->name('usulan-pelatihan.ajaxGetUsers');
    Route::get('/usulan-pelatihan/ajax-get-jenis-pelatihan', [UsulanPelatihanController::class, 'ajaxGetJenisPelatihan'])->name('usulan-pelatihan.ajaxGetJenisPelatihan');
    Route::get('/usulan-pelatihan/ajax-get-pelatihan', [UsulanPelatihanController::class, 'ajaxGetPelatihan'])->name('usulan-pelatihan.ajaxGetPelatihan');
    Route::get('/usulan-pelatihan/ajax', [UsulanPelatihanController::class, 'ajax'])->name('usulan-pelatihan.ajax');
    Route::get('/usulan-pelatihan/ajax/validasi/{id}', [UsulanPelatihanController::class, 'ajaxValidasi'])->name('usulan-pelatihan.ajaxValidasi');
    Route::get('/usulan-pelatihan/ajax/nonvalidasi/{id}', [UsulanPelatihanController::class, 'ajaxNonValidasi'])->name('usulan-pelatihan.ajaxNonValidasi');
    Route::resource('usulan-pelatihan', UsulanPelatihanController::class);

     /** Usulan Ujikom Route */
    Route::get('/usulan-ujikom/ajax-get-users', [UsulanUjikomController::class, 'ajaxGetUsers'])->name('usulan-ujikom.ajaxGetUsers');
    Route::get('/usulan-ujikom/ajax-get-jenis-ujikom', [UsulanUjikomController::class, 'ajaxGetJenisUjikom'])->name('usulan-ujikom.ajaxGetJenisUjikom');
    Route::get('/usulan-ujikom/ajax-get-ujikom', [UsulanUjikomController::class, 'ajaxGetUjikom'])->name('usulan-ujikom.ajaxGetUjikom');
    Route::get('/usulan-ujikom/ajax', [UsulanUjikomController::class, 'ajax'])->name('usulan-ujikom.ajax');
    Route::get('/usulan-ujikom/ajax/validasi/{id}', [UsulanUjikomController::class, 'ajaxValidasi'])->name('usulan-ujikom.ajaxValidasi');
    Route::get('/usulan-ujikom/ajax/nonvalidasi/{id}', [UsulanUjikomController::class, 'ajaxNonValidasi'])->name('usulan-ujikom.ajaxNonValidasi');
    Route::resource('usulan-ujikom', UsulanUjikomController::class);

    /** Laporan Route */
    Route::post('/usulan-pelatihan/export', [ExportController::class, 'exportUsulanPelatihan'])->name('usulan-pelatihan.export');
    Route::post('/usulan-ujikom/export', [ExportController::class, 'exportUsulanUjikom'])->name('usulan-ujikom.export');
    Route::post('/usulan-pelatihan/import', [ImportController::class, 'importUsulanPelatihan'])->name('usulan-pelatihan.import');
    Route::post('/usulan-ujikom/import', [ImportController::class, 'importUsulanUjikom'])->name('usulan-ujikom.import');

    /** Role Permission Route */
    Route::get('/role/ajax', [RolePermissionController::class, 'ajax'])->name('role.ajax');
    Route::resource('role', RolePermissionController::class);
    Route::get('/role-user/ajax', [RoleUserController::class, 'ajax'])->name('role-user.ajax');
    Route::resource('role-user', RoleUserController::class);

    /** Profile Update Route */
    Route::post('profile/password-update', [ProfileUpdateController::class, 'passwordUpdate'])->name('profile.password-update');
    Route::post('profile/update', [ProfileUpdateController::class, 'update'])->name('profile.update');
    Route::get('profile', [ProfileUpdateController::class, 'index'])->name('profile.index');

    /** Pengaturan Route */
    Route::get('/pengaturan/ajax/open/{id}', [PengaturanController::class, 'ajaxOpen'])->name('pengaturan.ajaxOpen');
    Route::get('/pengaturan/ajax/close/{id}', [PengaturanController::class, 'ajaxClose'])->name('pengaturan.ajaxClose');
    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');

    /** User Route */
    Route::get('/user/ajax', [UserController::class, 'ajax'])->name('user.ajax');
    Route::get('/user/active/{id}', [UserController::class, 'active'])->name('user.active');
    Route::get('/user/nonactive/{id}', [UserController::class, 'nonactive'])->name('user.nonactive');
    Route::resource('user', UserController::class);

     /** Notify Usulan Route */
     Route::get('/notifikasi/ajax/read-all-notify', [NotifikasiController::class, 'ajaxReadAll'])->name('notifikasi.ajaxReadAll');
     Route::get('/notifikasi/ajax/read-notify/{id}', [NotifikasiController::class, 'ajaxRead'])->name('notifikasi.ajaxRead');
     Route::get('/notifikasi/ajax', [NotifikasiController::class, 'ajax'])->name('notifikasi.ajax');
     Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
