<div>
    <div class="mb-3"><a href="{{ route('penandatangan.kesbangpol.list') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar</a></div>
    @if ($mode === 'detail')
        <div class="card card-dash border-0">
            <div class="card-header bg-white border-bottom p-4"><h5 class="mb-1 fw-bold">Detail Surat Rekomendasi</h5><small class="text-muted">Tinjau kelengkapan surat sebelum proses tanda tangan elektronik.</small></div>
            <div class="card-body p-4">
                <div class="row g-4 mb-4"><div class="col-md-6"><span class="text-muted small">Nama Pemohon</span><div class="fw-semibold">{{ $permohonan->pemohon->nama_lengkap ?? '-' }}</div></div><div class="col-md-6"><span class="text-muted small">Jenis Izin</span><div class="fw-semibold">{{ $permohonan->layanan->nama_layanan ?? '-' }}</div></div><div class="col-md-6"><span class="text-muted small">Instansi Asal</span><div class="fw-semibold">{{ $permohonan->nama_instansi ?? '-' }}</div></div><div class="col-md-6"><span class="text-muted small">Judul Penelitian</span><div class="fw-semibold">{{ $permohonan->judul ?? '-' }}</div></div></div>
                <h6 class="fw-bold text-primary border-bottom pb-2">Detail Pelaksanaan</h6>
                <div class="row g-4 mb-4">
                    <div class="col-md-6"><span class="text-muted small">Tanggal Mulai</span><div class="fw-semibold">{{ \Carbon\Carbon::parse($permohonan->tgl_mulai)->format('d/m/Y') }}</div></div>
                    <div class="col-md-6"><span class="text-muted small">Tanggal Selesai</span><div class="fw-semibold">{{ \Carbon\Carbon::parse($permohonan->tgl_selesai)->format('d/m/Y') }}</div></div>
                </div>
                <h6 class="fw-bold text-primary border-bottom pb-2">Tujuan Lokasi Penelitian</h6>
                <div class="row g-4 mb-4">
                    <div class="col-md-4"><span class="text-muted small">Kategori Lokasi</span><div class="fw-semibold">{{ $permohonan->opdChild->kategori->kategori ?? '-' }}</div></div>
                    <div class="col-md-4"><span class="text-muted small">Instansi Induk (Tembusan)</span><div class="fw-semibold">{{ $permohonan->opdChild->opd->nama_opd ?? '-' }}</div></div>
                    <div class="col-md-4"><span class="text-muted small">Lokasi Penelitian Asli</span><div class="fw-semibold">{{ $permohonan->opdChild->nama ?? '-' }}</div></div>
                    <div class="col-12"><span class="text-muted small d-block mb-1">Nama Pembimbing</span>@forelse($permohonan->pembimbing as $pembimbing)<span class="badge bg-light text-dark border me-1 mb-1">{{ $pembimbing->nama_pembimbing }}</span>@empty <span class="text-muted">-</span> @endforelse</div>
                </div>
                <h6 class="fw-bold text-primary border-bottom pb-2">Kategori Pengajuan</h6>
                <div class="row g-4 mb-4"><div class="col-md-6"><span class="text-muted small">Jenis Pengajuan</span><div class="fw-semibold">{{ strtolower($permohonan->jenis_pengajuan) === 'kelompok' ? 'Kelompok' : 'Personal (Individu)' }}</div></div>
                    @if(strtolower($permohonan->jenis_pengajuan) === 'kelompok')<div class="col-12"><span class="text-muted small d-block mb-1">Anggota Kelompok</span><ul class="list-group list-group-flush border rounded">@foreach($permohonan->anggota as $anggota)<li class="list-group-item py-2">{{ $anggota->nama_anggota }} <span class="text-muted">— {{ $anggota->nik }}</span></li>@endforeach</ul></div>@endif
                </div>
                <h6 class="fw-bold text-primary border-bottom pb-2">Dokumen Surat</h6>
                <div class="row g-3"><div class="col-md-6"><div class="border rounded p-3 h-100"><i class="fas fa-file-alt text-primary me-2"></i><span class="fw-semibold">Surat Rekomendasi</span><p class="small text-muted mb-2 mt-2">Surat belum dibuat. Dokumen akan tampil di halaman ini setelah generator surat tersedia.</p><button class="btn btn-sm btn-outline-secondary" disabled>Belum tersedia</button></div></div><div class="col-md-6"><div class="border rounded p-3 h-100"><i class="fas fa-file-signature text-primary me-2"></i><span class="fw-semibold">Surat untuk Tanda Tangan</span><p class="small text-muted mb-2 mt-2">Draf surat tanda tangan elektronik belum dibuat.</p><a href="{{ route('penandatangan.kesbangpol.surat', ['id' => $permohonan->id, 'mode' => 'surat']) }}" class="btn btn-sm btn-primary">Buka Surat <i class="fas fa-arrow-right ms-1"></i></a></div></div></div>
            </div>
        </div>
    @else
        <div class="card card-dash border-0"><div class="card-header bg-primary text-white p-4"><h5 class="mb-0 fw-bold"><i class="fas fa-pen-nib me-2"></i>Surat Tanda Tangan Elektronik</h5></div><div class="card-body p-4"><div class="alert alert-info border-0"><i class="fas fa-info-circle me-1"></i> Draf surat dan integrasi tanda tangan elektronik belum tersedia. Halaman serta rute ini sudah disiapkan untuk proses tersebut.</div><div class="border rounded p-4 text-center text-muted"><i class="fas fa-file-signature fa-3x mb-3"></i><h6 class="fw-bold">Pratinjau Surat Belum Tersedia</h6><p class="mb-0 small">Surat untuk {{ $permohonan->pemohon->nama_lengkap ?? 'pemohon' }} akan ditampilkan di sini.</p></div></div></div>
    @endif
</div>
