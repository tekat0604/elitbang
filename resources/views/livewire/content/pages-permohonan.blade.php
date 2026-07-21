@extends('layouts.sidebar_layout')
@section('title', 'Permohonan Izin')

@section('main-content')
  @php
    $pemohon = auth()->user()->pemohon;
  @endphp

  @if (!$pemohon || $pemohon->status_verifikasi !== 'terverifikasi')
    <div class="card card-dash text-center p-5">
      
      @if (!$pemohon)
        <h4 class="mb-3 text-warning">Akses Terkunci</h4>
        <p class="mb-4">Silakan mengisi data identitas diri Anda terlebih dahulu sebelum membuat permohonan.</p>
        <div>
          <a href="{{ route('identitas-form') }}" class="btn btn-primary">Isi Identitas Diri</a>
        </div>
        
      @elseif ($pemohon->status_verifikasi === 'pending')
        <h4 class="mb-3 text-warning">Menunggu Verifikasi</h4>
        <p class="mb-0">Silakan menunggu profil identitas Anda diverifikasi oleh BRIDA sebelum dapat membuat permohonan.</p>
        
      @elseif ($pemohon->status_verifikasi === 'revisi')
        <h4 class="mb-3 text-danger">Profil Perlu Revisi</h4>
        <p class="mb-4">Data identitas Anda dikembalikan dengan catatan. Harap perbaiki sebelum dapat membuat permohonan.</p>
        <div>
          <a href="{{ route('identitas') }}" class="btn btn-danger">Lihat Catatan BRIDA</a>
        </div>
      @endif

    </div>
  @else
    
    <div class="card card-dash p-4">
      <h5 class="mb-3">Form Pengajuan Permohonan Izin</h5>
      <p>Data Anda telah terverifikasi. Silakan lengkapi form permohonan di bawah ini.</p>
      
      </div>
    
  @endif
@endsection