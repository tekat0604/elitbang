@extends('layouts.sidebar_layout')

@section('title', 'Pilih Jenis Izin')

@section('main-content')
  @php
    $jenisIzin = [
        ['nama' => 'Izin Penelitian', 'slug' => 'izin-penelitian', 'deskripsi' => 'Pengajuan izin untuk kegiatan penelitian.', 'gambar' => 'assets/img/jenis-izin/penelitian.jpg' ],
        ['nama' => 'Izin Kuliah Kerja Nyata', 'slug' => 'izin-kkn', 'deskripsi' => 'Pengajuan izin kegiatan Kuliah Kerja Nyata.', 'gambar' => 'assets/img/jenis-izin/kkn.jpeg'],
        ['nama' => 'Izin Pengabdian Masyarakat', 'slug' => 'izin-pengabdian-masyarakat', 'deskripsi' => 'Pengajuan izin kegiatan pengabdian kepada masyarakat.', 'gambar' => 'assets/img/jenis-izin/pengabdian_masyarakat.jpg'],
        ['nama' => 'Izin Survey', 'slug' => 'izin-survey', 'deskripsi' => 'Pengajuan izin untuk pelaksanaan survei.', 'gambar' => 'assets/img/jenis-izin/survey.jpg'],
        ['nama' => 'Izin Wawancara', 'slug' => 'izin-wawancara', 'deskripsi' => 'Pengajuan izin untuk kegiatan wawancara.', 'gambar' => 'assets/img/jenis-izin/wawancara.jpg'],
        ['nama' => 'Izin Permohonan Data', 'slug' => 'izin-permohonan-data', 'deskripsi' => 'Pengajuan permintaan data kepada instansi terkait.', 'gambar' => 'assets/img/jenis-izin/data.jpg'],
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
            <img
              src="{{ asset($jenis['gambar']) }}"
              alt="Ilustrasi {{ $jenis['nama'] }}"
              class="w-100 rounded-3 object-fit-cover mb-3"
              style="height: 160px;"
            >
            <h5 class="fw-bold">{{ $jenis['nama'] }}</h5>
            <p class="text-body-secondary mb-4">{{ $jenis['deskripsi'] }}</p>
            <a href="{{ route('permohonan.form', ['layanan_slug' => $jenis['slug']]) }}" class="btn btn-outline-primary mt-auto">
              Pilih Jenis Izin
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
