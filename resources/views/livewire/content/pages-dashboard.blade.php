@extends('layouts.login_layout')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('page-style')
  <style>
    .sidebar-dash {
      background: linear-gradient(180deg, #ef233c, #c1121f);
      color: #fff;
      min-height: 100%;
      height: 100%;
      padding: 2rem 1rem;
    }

    .sidebar-dash .nav-link:hover,
    .sidebar-dash .nav-link:focus {
      color: #000 !important;
    }

    .sidebar-dash .nav-link:hover,
    .sidebar-dash .nav-link:focus {
      color: #000 !important;
      background-color: rgba(255, 255, 255, .85);
      border-radius: .5rem;
    }

    .sidebar-dash .nav-link {
      color: rgba(255, 255, 255, 0.95);
    }

    .profile-avatar {
      width: 84px;
      height: 84px;
      border-radius: 8px;
      overflow: hidden;
    }

    .card-dash {
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .badge-accent {
      background: #fff;
      color: var(--bs-primary);
      font-weight: 600;
      padding: .35rem .65rem;
      border-radius: 999px;
    }

    @media (max-width: 767.98px) {
  .sidebar-dash {
    min-height: auto;
    padding: 1rem;
  }

  .sidebar-dash .nav {
    flex-direction: row !important;
    gap: .5rem;
    flex-wrap: wrap;
  }

  .sidebar-dash .nav-link {
    padding: .5rem .75rem;
    border-radius: .5rem;
    background-color: rgba(255, 255, 255, .12);
  }

  .profile-avatar {
    width: 56px;
    height: 56px;
  }
}
  </style>
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection


@section('content')
  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Sidebar -->
      <div class="col-12 col-md-3">
        <aside class="sidebar-dash">
          <div class="text-center mb-4">
            <div class="profile-avatar mx-auto mb-2">
              <img src="{{ asset('assets/img/logo_surakarta.png') }}" alt="Logo Surakarta" class="h-100" data-speed="1" />
            </div>
            <h6 class="mb-0 text-white">{{ auth()->user()->name ?? auth()->user()->username }}</h6>
            <small class="text-white-50">{{ config('unit') ?? '' }}</small>
          </div>

          <nav class="nav flex-column">
            <a class="nav-link py-2 mb-1" href="{{ url('/') }}"> Dashboard</a>
            <a class="nav-link py-2 mb-1"
              href="{{ \Illuminate\Support\Facades\Route::has('pengguna.data.diri')
                  ? route('pengguna.data.diri')
                  : url('pages/profile-user') }}"> Data Diri
            </a>
            <a class="nav-link py-2 mb-1"
              href="{{ \Illuminate\Support\Facades\Route::has('pengguna.permohonan.index')
                  ? route('pengguna.permohonan.index')
                  : url('permohonan') }}"> Permohonan
            </a>
          </nav>
        </aside>
      </div>

      <!-- Main content -->
      <div class="col-md-9 p-4">
        <div class="row g-4">
          <div class="col-12">
            <div class="card card-dash p-3">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-1">Dashboard</h4>
                  <strong><small class="text-body-secondary">Selamat datang,
                    {{ auth()->user()->name ?? auth()->user()->username }}</small></strong>
                </div>
                <div>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 fw-semibold text-danger text-decoration-none">
                      Logout
                    </button>
                  </form>
                </div>
              </div>
              <div class="mt-3">
                <div id="chart-overview"></div>
              </div>
            </div>
          </div>

<!-- Tahapan Pengajuan Permohonan Izin --> 
          <div class="col-12">
  <div class="card card-dash p-4">
    <div class="mb-4">
      <h5 class="mb-1">Tahapan Pengajuan Permohonan Izin</h5>
      <small class="text-body-secondary">
        Ikuti tahapan berikut untuk mengajukan izin penelitian melalui sistem BRIDA Kota Surakarta.
      </small>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-primary mb-2">Tahap 1</span>
          <h6>Daftar Akun</h6>
          <p class="mb-0 text-body-secondary">
            Buat akun atau masuk melalui portal layanan online.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-primary mb-2">Tahap 2</span>
          <h6>Isi Data Pemohon</h6>
          <p class="mb-0 text-body-secondary">
            Setelah berhasil mendaftar dan bisa login akun. pemohon wajib mengisi data diri sebelum bisa mengajukan permohonan.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-primary mb-2">Tahap 3</span>
          <h6>Verifikasi Identitas</h6>
          <p class="mb-0 text-body-secondary">
            Verfikasi data diri pemohon oleh admin dari BRIDA. Pemohon akan menerima notifikasi jika data diri telah diverifikasi.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-primary mb-2">Tahap 4</span>
          <h6>Pilih Jenis Izin</h6>
          <p class="mb-0 text-body-secondary">
            Setelah data diri Pemohon terverifikasi, Pemohon dapat mengajukan permohonan dan bisa memilih katergori yang akan diajukan.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-warning mb-2">Tahap 5</span>
          <h6>Isikan Data Penelitian</h6>
          <p class="mb-0 text-body-secondary">
            Setelah memilih kategori permohonan yang akan diajukan, pemohon mengisi data informasi sesuai dengan permohonan yang diajukan.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-warning mb-2">Tahap 6</span>
          <h6>Upoad Syarat yang Diperlukan</h6>
          <p class="mb-0 text-body-secondary">
            Pemohon mengunggah dokumen persyaratan yang diminta sesuai dengan kategori permohonan yang diajukan.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-warning mb-2">Tahap 7</span>
          <h6>Verifikasi Data Pengajuan Kesbangpol</h6>
          <p class="mb-0 text-body-secondary">
            Data pengajuan permohonan akan dilakukan verifikasi oleh 2 Perangkat Daerah ,yaitu Kesbangpol & BRIDA.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-warning mb-2">Tahap 8</span>
          <h6>TTE Kesbangpol</h6>
          <p class="mb-0 text-body-secondary">
            Setelah verifikasi distujui oleh 2 Perangkat daerah, data permohonan akan di generate menjadi dokumen pdf yang nanti bisa ditandatangi menggunakan TTE dari 2 Perangkat Daerah.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-success mb-2">Tahap 9</span>
          <h6>Isi Survei</h6>
          <p class="mb-0 text-body-secondary">
            Setelah dokumen disetujui dan di tandatangni, pemohon diminta untuk mengisi SKM (Survey Kepuasan Masyarakat).
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-success mb-2">Tahap 10</span>
          <h6>Permohonan Disetujui</h6>
          <p class="mb-0 text-body-secondary">
            Pemohon bisa mengunduh Dokumen persetujuan dan surat selesai penelitian yang telah di tandatangani oleh 2 Perangkat Daerah.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-success mb-2">Tahap 11</span>
          <h6>Upload Laporan Penelitian</h6>
          <p class="mb-0 text-body-secondary">
            Setelah Pemohon melaksanakan kegiatan penelitian, Pemohon wajib mengunggah laporan penelitian ke sistem BRIDA Kota Surakarta.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="border rounded-3 p-3 h-100">
          <span class="badge text-bg-success mb-2">Tahap 12 — Selesai</span>
          <h6>Verifikasi Laporan Oleh BRIDA</h6>
          <p class="mb-0 text-body-secondary">
            Setelah laporan diverifikasi BRIDA, Pemohon akan menerima surat keterangan selesai penelitian.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FAQ Section -->
          <div class="col-12">
  <div class="card card-dash p-4">
    <div class="mb-3">
      <h5 class="mb-1">FAQ</h5>
      <small class="text-body-secondary">
        Pertanyaan yang sering diajukan terkait pengajuan permohonan.
      </small>
    </div>

    <div class="accordion" id="faqDashboard">
      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
            Bagaimana cara membuat permohonan?
          </button>
        </h2>
        <div id="faqOne" class="accordion-collapse collapse show"
          aria-labelledby="faqHeadingOne" data-bs-parent="#faqDashboard">
          <div class="accordion-body">
            Pilih menu <strong>Permohonan</strong>, lalu lengkapi formulir dan unggah
            dokumen persyaratan yang diminta.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
            Bagaimana melihat status permohonan?
          </button>
        </h2>
        <div id="faqTwo" class="accordion-collapse collapse"
          aria-labelledby="faqHeadingTwo" data-bs-parent="#faqDashboard">
          <div class="accordion-body">
            Status permohonan dapat dilihat pada menu <strong>Permohonan</strong>
            setelah Anda berhasil mengirimkan pengajuan.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeadingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
            Apa yang dilakukan jika dokumen ditolak?
          </button>
        </h2>
        <div id="faqThree" class="accordion-collapse collapse"
          aria-labelledby="faqHeadingThree" data-bs-parent="#faqDashboard">
          <div class="accordion-body">
            Periksa catatan atau alasan penolakan, perbaiki dokumen yang diperlukan,
            kemudian kirim ulang permohonan Anda.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
@endsection
