@extends('layouts.sidebar_layout')

@section('title', 'Permohonan Izin')

@section('main-content')
  @php
    $permohonan = auth()->user()->pemohon?->permohonan()->with('layanan')->latest()->get() ?? collect();

    $statusClass = [
        'draft' => 'text-bg-secondary',
        'diajukan' => 'text-bg-primary',
        'proses_brida' => 'text-bg-info',
        'revisi' => 'text-bg-warning',
        'disetujui' => 'text-bg-success',
        'ditolak' => 'text-bg-danger',
    ];
  @endphp

  <div class="card card-dash border-0">
    <div
      class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center">
      <div>
        <h5 class="mb-1 fw-bold">Daftar Pengajuan Permohonan</h5>
        <p class="mb-0 text-body-secondary">Pantau status seluruh permohonan izin yang pernah Anda ajukan.</p>
      </div>

      <a href="{{ route('permohonan.pilih-jenis') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Ajukan Permohonan
      </a>
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
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($permohonan as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="fw-semibold">{{ $item->layanan?->nama_layanan ?? '-' }}</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->created_at?->translatedFormat('d M Y') }}</td>
                  <td>
                    <span class="badge {{ $statusClass[$item->status_permohonan] ?? 'text-bg-secondary' }}">
                      {{ str($item->status_permohonan)->replace('_', ' ')->title() }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
@endsection
