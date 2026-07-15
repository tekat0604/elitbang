@extends('layouts.sidebar_layout')

@section('title', 'Pilih Jenis Izin')

@section('main-content')
  @php
    $jenisIzin = [
        ['nama' => 'Penelitian', 'deskripsi' => 'Pengajuan izin untuk kegiatan penelitian.'],
        ['nama' => 'KKN', 'deskripsi' => 'Pengajuan izin kegiatan Kuliah Kerja Nyata.'],
        ['nama' => 'Pengabdian Masyarakat', 'deskripsi' => 'Pengajuan izin kegiatan pengabdian kepada masyarakat.'],
        ['nama' => 'Survei', 'deskripsi' => 'Pengajuan izin untuk pelaksanaan survei.'],
        ['nama' => 'Wawancara', 'deskripsi' => 'Pengajuan izin untuk kegiatan wawancara.'],
        ['nama' => 'Permohonan Data', 'deskripsi' => 'Pengajuan permintaan data kepada instansi terkait.'],
    ];
  @endphp

  <div class="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center mb-4">
    <div>
      <h4 class="mb-1">Pilih Jenis Izin</h4>
      <p class="text-body-secondary mb-0">Pilih kategori permohonan yang ingin Anda ajukan.</p>
    </div>
    <a href="{{ route('permohonan') }}" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
  </div>

  <div class="row g-4">
    @foreach ($jenisIzin as $jenis)
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card card-dash border-0 h-100">
          <div class="card-body p-4 d-flex flex-column">
            <div
              class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3"
              style="width: 48px; height: 48px;">
              <i class="fas fa-file-alt"></i>
            </div>
            <h5 class="fw-bold">{{ $jenis['nama'] }}</h5>
            <p class="text-body-secondary mb-4">{{ $jenis['deskripsi'] }}</p>
            <button type="button" class="btn btn-outline-primary mt-auto" disabled>
              Pilih Jenis Izin
            </button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
