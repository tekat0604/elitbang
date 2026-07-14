@extends('layouts.login_layout')
@section('title', 'Data Identitas Diri')

@section('content')
  <div class="container-xxl py-5">
    @php
      $pemohon = auth()->user()->pemohon;
    @endphp

    @if (!$pemohon)
      <div class="text-center py-5">
        <h4 class="mb-3">Anda belum melengkapi Identitas Diri</h4>
        <a href="{{ route('identitas-form') }}" class="btn btn-primary">Lengkapi Sekarang</a>
      </div>
    @else
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
              <h5 class="mb-0 fw-bold">Profil Identitas Diri</h5>

              @if ($pemohon->status_verifikasi == 'pending')
                <span class="badge bg-warning text-dark px-3 py-2">Menunggu Verifikasi</span>
              @elseif($pemohon->status_verifikasi == 'terverifikasi')
                <span class="badge bg-success px-3 py-2">Terverifikasi</span>
              @elseif($pemohon->status_verifikasi == 'revisi')
                <span class="badge bg-danger px-3 py-2">Perlu Revisi</span>
              @elseif($pemohon->status_verifikasi == 'ditolak')
                <span class="badge bg-dark px-3 py-2">Ditolak Permanen</span>
              @endif
            </div>

            <div class="card-body p-4">
              @if (in_array($pemohon->status_verifikasi, ['revisi', 'ditolak']) && $pemohon->catatan_verifikasi)
                <div class="alert alert-danger mb-4">
                  <h6 class="alert-heading fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Catatan dari
                    Kesbangpol:</h6>
                  <p class="mb-0">{{ $pemohon->catatan_verifikasi }}</p>
                </div>
              @endif

              <div class="row gy-4">
                <div class="col-md-8">
                  <div class="row text-sm">
                    <div class="col-sm-4 text-muted mb-1">Nama Lengkap</div>
                    <div class="col-sm-8 fw-semibold mb-3">{{ $pemohon->nama_lengkap }}</div>

                    <div class="col-sm-4 text-muted mb-1">Identitas ({{ strtoupper($pemohon->jenis_identitas) }})</div>
                    <div class="col-sm-8 fw-semibold mb-3">{{ $pemohon->nomor_identitas }}</div>

                    <div class="col-sm-4 text-muted mb-1">Kontak</div>
                    <div class="col-sm-8 fw-semibold mb-3">{{ $pemohon->no_hp }} <br> <span
                        class="text-primary">{{ $pemohon->email }}</span></div>

                    <div class="col-sm-4 text-muted mb-1">Kewarganegaraan</div>
                    <div class="col-sm-8 fw-semibold mb-3">{{ $pemohon->kewarganegaraan }}</div>

                    <div class="col-sm-4 text-muted mb-1">Alamat Domisili</div>
                    <div class="col-sm-8 fw-semibold mb-3">
                      {{ $pemohon->alamat }}<br>
                      Kel. {{ $pemohon->kelurahan_desa }}, Kec. {{ $pemohon->kecamatan }}<br>
                      {{ $pemohon->kota_kabupaten }}, {{ $pemohon->provinsi }}
                    </div>
                  </div>
                </div>

                <div class="col-md-4 text-center">
                  <div class="text-muted mb-2 text-start">Berkas Identitas</div>
                  <div class="border rounded p-1">
                    <img src="{{ asset('storage/' . $pemohon->path_identitas) }}" class="img-fluid rounded"
                      alt="Foto Identitas">
                  </div>
                </div>
              </div>

              <div class="mt-5 border-top pt-4 text-end">
                @if ($pemohon->status_verifikasi == 'revisi')
                  <a href="{{ route('identitas-form') }}" class="btn btn-danger">
                    <i class="fas fa-edit me-1"></i> Edit Data Identitas
                  </a>
                @elseif($pemohon->status_verifikasi == 'ditolak')
                  <button class="btn btn-dark"
                    onclick="alert('Fitur hapus data & mulai ulang akan dibuat di tahap selanjutnya.')">
                    <i class="fas fa-sync me-1"></i> Ajukan Ulang dari Awal
                  </button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection
