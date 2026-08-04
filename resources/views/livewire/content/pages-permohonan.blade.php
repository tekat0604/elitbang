@extends('layouts.sidebar_layout')
@section('title', 'Permohonan Izin')

@section('main-content')
  @php
    $permohonan = auth()->user()->pemohon?->permohonan()->with('layanan')->latest()->get() ?? collect();
    $pemohon = auth()->user()->pemohon;

    $adaIzinAktif = $permohonan
        ->whereIn('status_permohonan', ['draft', 'diajukan', 'proses_verifikasi', 'revisi', 'disetujui'])
        ->isNotEmpty();

    $statusClass = [
        'draft' => 'text-bg-primary',
        'diajukan' => 'text-bg-secondary',
        'proses_verifikasi' => 'text-bg-info',
        'pending' => 'text-bg-warning',
        'revisi' => 'text-bg-warning',
        'disetujui' => 'text-bg-success',
        'ditolak' => 'text-bg-danger',
    ];
  @endphp

  @if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi')
    <div class="card card-dash border-0 p-5 text-center">
      @if (!$pemohon)
        <h4 class="mb-3 text-warning">Akses Terkunci</h4>
        <p class="mb-4">Silakan mengisi data identitas diri Anda terlebih dahulu sebelum membuat permohonan.</p>
        <div>
          <a href="{{ route('identitas-form') }}" class="btn btn-primary">Isi Identitas Diri</a>
        </div>
      @elseif ($pemohon->status_verifikasi === 'pending')
        <h4 class="mb-3 text-warning">Menunggu Verifikasi</h4>
        <p class="mb-0">Silakan menunggu profil identitas Anda diverifikasi oleh BRIDA sebelum dapat membuat permohonan.
        </p>
      @elseif ($pemohon->status_verifikasi === 'revisi')
        <h4 class="mb-3 text-danger">Profil Perlu Revisi</h4>
        <p class="mb-4">Data identitas Anda dikembalikan dengan catatan. Harap perbaiki sebelum dapat membuat permohonan.
        </p>
        <div>
          <a href="{{ route('identitas') }}" class="btn btn-danger">Lihat Catatan BRIDA</a>
        </div>
      @endif
    </div>
  @else
    <div class="card card-dash border-0">
      <div
        class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
        <div>
          <h5 class="mb-1 fw-bold">Daftar Pengajuan Permohonan</h5>
          <p class="mb-0 text-body-secondary">Pantau status seluruh permohonan izin yang pernah Anda ajukan.</p>
        </div>

        @if ($adaIzinAktif)
          <button type="button" class="btn btn-info" disabled>
            <i class="fas fa-lock me-1"></i> Selesaikan Izin Aktif Terlebih Dahulu
          </button>
        @else
          <a href="{{ route('permohonan.pilih-jenis') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajukan Permohonan
          </a>
        @endif
      </div>

      <div class="card-body p-4">
        @if ($permohonan->isEmpty())
          <div class="text-center py-5">
            <i class="fas fa-folder-open text-body-secondary fs-1"></i>
            <h6 class="mt-3 mb-1">Belum ada pengajuan permohonan izin</h6>
            <p class="text-body-secondary mb-3">Mulai pengajuan baru dengan memilih jenis izin yang Anda butuhkan.</p>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>No.</th>
                  <th>Jenis Izin</th>
                  <th>Judul Pengajuan</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Status Brida</th>
                  <th>Catatan Brida</th>
                  <th>Status Kesbangpol</th>
                  <th>Catatan Kesbangpol</th>
                  <th>Status Utama</th>
                  <th>Surat Rekomendasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($permohonan as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $item->layanan?->nama_layanan ?? '-' }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->created_at?->translatedFormat('d M Y') }}</td>

                    <!-- Status BRIDA -->
                    <td>
                      <span class="badge {{ $statusClass[$item->status_brida] ?? 'text-bg-secondary' }}">
                        {{ $item->status_brida ?? 'Pending' }}
                      </span>
                    </td>
                    <td>{{ $item->catatan_brida ?? '-' }}</td>

                    <!-- Status KESBANGPOL -->
                    <td>
                      <span class="badge {{ $statusClass[$item->status_kesbangpol] ?? 'text-bg-secondary' }}">
                        {{ $item->status_kesbangpol ?? 'Pending' }}
                      </span>
                    </td>
                    <td>{{ $item->catatan_kesbangpol ?? '-' }}</td>

                    <!-- Status Utama -->
                    <td>
                      <span class="badge {{ $statusClass[$item->status_permohonan] ?? 'text-bg-secondary' }}">
                        {{ str($item->status_permohonan)->replace('_', ' ')->title() }}
                      </span>

                      @if ($item->status_brida === 'revisi' || $item->status_kesbangpol === 'revisi')
                        <div class="mt-2">
                          <a href="{{ route('permohonan.revisi', $item->id) }}" class="btn btn-sm btn-warning shadow-sm">
                            <i class="fas fa-edit me-1"></i> Perbaiki Data
                          </a>
                        </div>
                      @endif
                    </td>

                    <!-- Surat Rekomendasi -->
                    <td>
                      @if ($item->status_permohonan === 'disetujui' && $item->suratIzin?->status_tte_kesbangpol === 'selesai' && $item->suratIzin?->status_tte_brida === 'selesai')
                        @if ($item->surveiKepuasan)
                          <a href="{{ route('user.unduh-surat', $item->suratIzin->qr_code_link) }}" target="_blank"
                            class="btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-download me-1"></i> Unduh Surat
                          </a>
                        @else
                          <a href="#"
                            onclick="alert('Silakan mengisi survei kepuasan masyarakat terlebih dahulu untuk dapat mengunduh surat rekomendasi.'); window.location.href='{{ route('survei-kepuasan') }}'; return false;"
                            class="btn btn-sm btn-warning shadow-sm">
                            <i class="fas fa-download me-1"></i> Unduh Surat
                          </a>
                        @endif
                      @else
                        <span class="text-body-secondary">Belum tersedia</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  @endif
@endsection
