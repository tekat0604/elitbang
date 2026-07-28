<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Permohonan;
use App\Livewire\FrontPage\Landing;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Http\Controllers\GoogleController;
use App\Livewire\Upload\PemohonController;
use App\Livewire\SurveiKepuasanForm;
use App\Livewire\Upload\PermohonanController;
use App\Livewire\Verifikator\PemohonList;
use App\Livewire\Verifikator\PemohonDetail;
use App\Livewire\Verifikator\Brida\PermohonanListBrida;
use App\Livewire\Verifikator\Brida\PermohonanDetailBrida;
use App\Http\Middleware\CekRoleVerifikator;
use App\Http\Middleware\CekRoleUser;
use App\Http\Middleware\CekVerifikasiPemohon;
use App\Http\Middleware\CekVerifikasiPermohonan;
use App\Livewire\Verifikator\Kesbangpol\PermohonanListKesbangpol;
use App\Livewire\Verifikator\Kesbangpol\PermohonanDetailKesbangpol;
use App\Livewire\Verifikator\Brida\PenomoranSurat;
use App\Models\SuratIzin;
use Illuminate\Support\Facades\Storage;

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
    $user = Auth::user();
    $isPemohon = strtolower(trim($user->role ?? 'user')) === 'user';
    $statistikPermohonan = null;

    if ($isPemohon) {
      $queryPermohonan = Permohonan::query()
        ->where('pemohon_id', $user->pemohon?->id);

      $statistikPermohonan = [
        'diajukan' => (clone $queryPermohonan)
          ->whereIn('status_permohonan', ['diajukan', 'proses_verifikasi', 'revisi', 'disetujui', 'ditolak'])
          ->count(),
        'pending' => (clone $queryPermohonan)
          ->whereIn('status_permohonan', ['diajukan', 'proses_verifikasi'])
          ->count(),
        'disetujui' => (clone $queryPermohonan)
          ->where('status_permohonan', 'disetujui')
          ->count(),
        'perlu_tindakan' => (clone $queryPermohonan)
          ->whereIn('status_permohonan', ['ditolak', 'revisi'])
          ->count(),
      ];
    }

    return view('livewire.content.pages-dashboard', compact('isPemohon', 'statistikPermohonan'));
  })->name('dashboard');

  Route::get('/preview-surat/{id}', function ($id) {
    $user = auth()->user();

    // Sesuaikan nama string ini dengan isi tabel users milikmu
    $roleDiizinkan = ['verifikator', 'tanda_tangan'];

    if (!in_array($user->role, $roleDiizinkan)) {
      abort(403, 'Akses Ditolak: Hanya Verifikator dan Pejabat Instansi yang diizinkan melihat draf dokumen ini.');
    }

    $surat = SuratIzin::findOrFail($id);
    $path = $surat->file_surat_draft;

    if (!Storage::disk('public')->exists($path)) {
      abort(404, 'File PDF tidak ditemukan di server.');
    }

    return Storage::disk('public')->response($path);
  })->name('preview-surat');

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

    Route::get('/permohonan/perizinan', function () {
      return view('livewire.content.pages-permohonan-perizinan');
    })->name('permohonan.perizinan');

    Route::get('/survei-kepuasan-masyarakat', SurveiKepuasanForm::class)->name('survei-kepuasan');
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

    Route::get('/brida/penomoran-surat', PenomoranSurat::class)->name('brida.penomoran');

    Route::get('/kesbangpol/permohonan', PermohonanListKesbangpol::class)->name('kesbangpol.permohonan.list');
    Route::get('/kesbangpol/permohonan/{id}', PermohonanDetailKesbangpol::class)->name('kesbangpol.permohonan.detail');

  });


});


Route::get('/cek-desain-surat', function () {
  $permohonan = (object) [
    'nama_instansi' => 'Universitas Sebelas Maret',
    'alamat_instansi' => 'Jl. Ir. Sutami No.36A, Surakarta',
    'judul' => 'Pengaruh AI Terhadap Pendidikan',
    'tgl_mulai' => '2026-08-01',
    'tgl_selesai' => '2026-08-31',
    'pemohon' => (object) [
      'nama_lengkap' => 'Budi Santoso',
      'nomor_identitas' => 'L12345678',
      'alamat' => 'Jl. Kebangsaan No. 1'
    ],
    'opdChild' => (object) [
      'nama' => 'Dinas Pendidikan Kota Surakarta'
    ],
    'pembimbing' => [
      (object) ['nama_pembimbing' => 'Dr. Umi Salamah'],
      (object) ['nama_pembimbing' => 'Prof. Ahmad']
    ]
  ];

  return view('pdf.surat-izin', [
    'nomor_surat' => '070/123/VIII/2026',
    'tanggal_cetak' => '24 Juli 2026',
    'permohonan' => $permohonan
  ]);
});