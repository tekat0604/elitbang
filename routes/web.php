<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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
use App\Livewire\Verifikator\Brida\PermohonanListBrida;
use App\Livewire\Verifikator\Brida\PermohonanDetailBrida;
use App\Http\Middleware\CekRoleVerifikator;
use App\Http\Middleware\CekRoleUser;
use App\Http\Middleware\CekVerifikasiPemohon;
use App\Http\Middleware\CekVerifikasiPermohonan;
use App\Http\Middleware\CekRoleTandaTangan;
use App\Livewire\Verifikator\Kesbangpol\PermohonanListKesbangpol;
use App\Livewire\Verifikator\Kesbangpol\PermohonanDetailKesbangpol;


Route::get('/', Landing::class)->name('landing');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/auth/forgot-password-basic', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
  // Cari user berdasarkan ID yang ada di tautan email
  $user = User::findOrFail($id);

  // Cocokkan hash di URL dengan hash email pengguna (Keamanan)
  if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
    abort(403, 'Tautan verifikasi tidak valid atau sudah kedaluwarsa.');
  }

  // Jika belum diverifikasi, maka verifikasi sekarang
  if (!$user->hasVerifiedEmail()) {
    $user->markEmailAsVerified();
  }

  // Arahkan ke halaman login dengan pesan sukses
  return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan masuk menggunakan akun Anda.');

})->middleware(['signed'])->name('verification.verify');


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
    Route::get('/brida/list-pemohon', PemohonList::class)->name('pemohon.list');
    Route::get('/brida/list-pemohon/{id}', PemohonDetail::class)->name('pemohon.detail');

    Route::get('/brida/permohonan', PermohonanListBrida::class)->name('brida.permohonan.list');
    Route::get('/brida/permohonan/{id}', PermohonanDetailBrida::class)->name('brida.permohonan.detail');

    Route::get('/kesbangpol/permohonan', PermohonanListKesbangpol::class)->name('kesbangpol.permohonan.list');
    Route::get('/kesbangpol/permohonan/{id}', PermohonanDetailKesbangpol::class)->name('kesbangpol.permohonan.detail');
  });

  Route::middleware([CekRoleTandaTangan::class])->prefix('penandatangan')->name('penandatangan.')->group(function () {
    // Route::get('/brida/list-penandatangan', )->name('penandatangan.brida.list');

  });


});
