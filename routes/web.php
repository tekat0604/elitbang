<?php

use Illuminate\Support\Facades\Route;

// Livewire Components
use App\Livewire\FrontPage\Landing;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Upload\PemohonController;
use App\Livewire\Upload\PermohonanController;
use App\Livewire\SurveiKepuasanForm;
use App\Livewire\LaporanAkhirForm;
use App\Livewire\Admin\DataInstansi;

// Verifikator Components
use App\Livewire\Verifikator\PemohonList;
use App\Livewire\Verifikator\PemohonDetail;
use App\Livewire\Verifikator\Brida\PermohonanListBrida;
use App\Livewire\Verifikator\Brida\PermohonanDetailBrida;
use App\Livewire\Verifikator\Brida\PenomoranSurat;
use App\Livewire\Verifikator\Kesbangpol\PermohonanListKesbangpol;
use App\Livewire\Verifikator\Kesbangpol\PermohonanDetailKesbangpol;

// Penandatangan Components
use App\Livewire\Penandatangan\Brida\TandaTanganList as TandaTanganListBrida;
use App\Livewire\Penandatangan\Brida\TandaTanganDetail as TandaTanganDetailBrida;
use App\Livewire\Penandatangan\Kesbangpol\TandaTanganList as TandaTanganListKesbangpol;
use App\Livewire\Penandatangan\Kesbangpol\TandaTanganDetail as TandaTanganDetailKesbangpol;

// Controllers
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratController;

// Middlewares
use App\Http\Middleware\CekRoleVerifikator;
use App\Http\Middleware\CekRoleUser;
use App\Http\Middleware\CekVerifikasiPemohon;
use App\Http\Middleware\CekVerifikasiPermohonan;
use App\Http\Middleware\CekRoleTandaTangan;
use App\Http\Middleware\CekRoleAdmin;

// Public & Guest Routes
Route::get('/', Landing::class)->name('landing');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/auth/forgot-password-basic', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

// Google SSO Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

// Email Verification
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
  ->middleware(['signed'])
  ->name('verification.verify');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

  // Auth & Dashboard
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/preview-surat/{id}', [SuratController::class, 'preview'])->name('preview-surat');

  // Role: User (Pemohon)
  Route::middleware([CekRoleUser::class])->group(function () {

    // Static Views (Clean Code using Route::view)
    Route::view('/identitas-diri', 'livewire.content.pages-pemohon')->name('identitas');
    Route::view('/permohonan', 'livewire.content.pages-permohonan')->name('permohonan');
    Route::view('/permohonan/perizinan', 'livewire.content.pages-permohonan-perizinan')->name('permohonan.perizinan');
    Route::view('/permohonan/pilih-jenis', 'livewire.content.pages-pilih-jenis-izin')
      ->name('permohonan.pilih-jenis')
      ->middleware([CekVerifikasiPemohon::class, CekVerifikasiPermohonan::class]);

    // Logic-based Routes
    Route::get('/identitas-diri/form', PemohonController::class)->name('identitas-form');
    Route::get('/survei-kepuasan-masyarakat', SurveiKepuasanForm::class)->name('survei-kepuasan');
    Route::get('/laporan-akhir', LaporanAkhirForm::class)->name('laporan-akhir');

    Route::get('/permohonan/form/{layanan_slug}', PermohonanController::class)
      ->name('permohonan.form')
      ->middleware([CekVerifikasiPemohon::class, CekVerifikasiPermohonan::class]);

    Route::get('/permohonan/revisi/{id}', PermohonanController::class)
      ->name('permohonan.revisi')
      ->middleware([CekVerifikasiPemohon::class]);

    Route::get('/permohonan/unduh-surat/{id}', [SuratController::class, 'unduh'])->name('user.unduh-surat');
  });

  // Role: Verifikator
  Route::middleware([CekRoleVerifikator::class])->prefix('verifikator')->name('verifikator.')->group(function () {
    // Brida
    Route::get('/brida/list-pemohon', PemohonList::class)->name('pemohon.list');
    Route::get('/brida/list-pemohon/{id}', PemohonDetail::class)->name('pemohon.detail');
    Route::get('/brida/permohonan', PermohonanListBrida::class)->name('brida.permohonan.list');
    Route::get('/brida/permohonan/{id}', PermohonanDetailBrida::class)->name('brida.permohonan.detail');
    Route::get('/brida/penomoran-surat', PenomoranSurat::class)->name('brida.penomoran');

    // Kesbangpol
    Route::get('/kesbangpol/permohonan', PermohonanListKesbangpol::class)->name('kesbangpol.permohonan.list');
    Route::get('/kesbangpol/permohonan/{id}', PermohonanDetailKesbangpol::class)->name('kesbangpol.permohonan.detail');
  });

  // Role: Penandatangan
  Route::middleware([CekRoleTandaTangan::class])->prefix('penandatangan')->name('penandatangan.')->group(function () {
    Route::get('/brida/permohonan', TandaTanganListBrida::class)->name('brida.list');
    Route::get('/brida/permohonan/{id}', TandaTanganDetailBrida::class)->name('brida.detail');

    Route::get('/kesbangpol/permohonan', TandaTanganListKesbangpol::class)->name('kesbangpol.list');
    Route::get('/kesbangpol/permohonan/{id}', TandaTanganDetailKesbangpol::class)->name('kesbangpol.detail');
  });

  // Role: Admin
  Route::middleware([CekRoleAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/data-instansi', DataInstansi::class)->name('data-instansi');
  });
});
