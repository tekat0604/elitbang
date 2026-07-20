<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\FrontPage\Landing;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Http\Controllers\GoogleController;
use App\Livewire\Upload\PemohonController;
use App\Livewire\Upload\PermohonanController;
use App\Livewire\Verifikator\PemohonList;
use App\Livewire\Verifikator\PemohonDetail;
use App\Http\Middleware\CekRoleVerifikator;
use App\Http\Middleware\CekRoleUser;
use App\Http\Middleware\CekVerifikasiPemohon;
use App\Http\Middleware\CekVerifikasiPermohonan;


Route::get('/', Landing::class)->name('landing');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/auth/forgot-password-basic', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', function () {
    return view('livewire.content.pages-dashboard');
  })->name('dashboard');

  Route::middleware([CekRoleUser::class])->group(function () {
    Route::get('/identitas-diri', function () {
      return view('livewire.content.pages-pemohon');
    })->name('identitas');

    Route::get('/identitas-diri/form', PemohonController::class)->name('identitas-form');

    Route::get('/permohonan', function () {
      return view('livewire.content.pages-permohonan');
    })->name('permohonan');

    Route::get('/permohonan/pilih-jenis', function () {
      return view('livewire.content.pages-pilih-jenis-izin');
    })->name('permohonan.pilih-jenis')->middleware(CekVerifikasiPemohon::class, CekVerifikasiPermohonan::class);

    Route::get('/permohonan/form/{layanan_slug}', PermohonanController::class)
      ->name('permohonan.form')
      ->middleware(CekVerifikasiPemohon::class, CekVerifikasiPermohonan::class);

    Route::get('/permohonan/revisi/{id}', PermohonanController::class)
      ->name('permohonan.revisi')
      ->middleware(CekVerifikasiPemohon::class);
  });

  Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
  })->name('logout');

  Route::middleware([CekRoleVerifikator::class])->prefix('verifikator')->name('verifikator.')->group(function () {
    Route::get('/list-pemohon', PemohonList::class)->name('pemohon.list');
    Route::get('/list-pemohon/{id}', PemohonDetail::class)->name('pemohon.detail');
  });
});
