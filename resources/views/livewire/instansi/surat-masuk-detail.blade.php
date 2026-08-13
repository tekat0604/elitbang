<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Permohonan Izin</h4>
        <a href="{{ route('instansi.surat-masuk.list') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Informasi Pemohon -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4" style="max-height: 800px; overflow-y: auto;">
                    <!-- Penyaluran ke uptd -->
                @if(auth()->user()->role === 'opd' && $permohonan->id_opd_child)
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 bg-primary bg-opacity-10 rounded-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1 text-primary"><i class="fas fa-share-square me-2"></i>Penyaluran ke UPTD</h6>
                                <p class="text-muted small mb-0">Lokasi kegiatan ini menargetkan UPTD spesifik. Apakah Anda ingin menyalurkan surat ini?</p>
                            </div>
                            <div class="ms-3 text-end">
                                
                                @if($statusPenyaluran === 'disalurkan')
                                    <span class="badge bg-success px-3 py-2 fs-6 rounded-pill"><i class="fas fa-check-circle me-1"></i> Telah Disalurkan</span>
                                
                                @elseif($statusPenyaluran === 'ditolak')
                                    <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill"><i class="fas fa-times-circle me-1"></i> Penyaluran Ditolak</span>
                                
                                @else
                                    <div class="d-flex gap-2">
                                        <button wire:click="tolakPenyaluran" class="btn btn-outline-danger rounded-pill px-4 fw-semibold" wire:loading.attr="disabled">
                                            Tolak
                                        </button>
                                        <button wire:click="salurkanKeUptd" class="btn btn-primary rounded-pill px-4 fw-semibold" wire:loading.attr="disabled">
                                            <span wire:loading.remove>Salurkan</span>
                                            <span wire:loading>Memproses...</span>
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Notifikasi -->
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                    
                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Informasi Umum & Akademik</h6>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Nama Lengkap</label>
                        <span class="fw-semibold">{{ $permohonan->pemohon->nama_lengkap ?? '-' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Jenis Izin</label>
                        <span class="fw-semibold">{{ $permohonan->layanan->nama_layanan ?? '-' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Asal Instansi/Universitas</label>
                        <span class="fw-semibold">{{ $permohonan->nama_instansi ?? '-' }}</span>
                    </div>
                    @if($permohonan->fakultas || $permohonan->program_studi || $permohonan->nim)
                        <div class="row">
                            @if($permohonan->fakultas)
                                <div class="col-6 mb-3">
                                    <label class="text-muted small d-block mb-1">Fakultas</label>
                                    <span class="fw-semibold">{{ $permohonan->fakultas }}</span>
                                </div>
                            @endif
                            @if($permohonan->program_studi)
                                <div class="col-6 mb-3">
                                    <label class="text-muted small d-block mb-1">Program Studi</label>
                                    <span class="fw-semibold">{{ $permohonan->program_studi }}</span>
                                </div>
                            @endif
                            @if($permohonan->nim)
                                <div class="col-12 mb-3">
                                    <label class="text-muted small d-block mb-1">NIM</label>
                                    <span class="fw-semibold">{{ $permohonan->nim }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <h6 class="fw-bold text-primary mb-3 mt-2 border-bottom pb-2">Data Substantif</h6>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Judul Penelitian/Kegiatan</label>
                        <span class="fw-semibold">{{ $permohonan->judul ?? '-' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Tujuan Penelitian/Kegiatan</label>
                        <div class="fw-semibold" style="text-align: justify;">{{ $permohonan->tujuan ?? '-' }}</div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">Pelaksanaan & Lokasi</h6>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="text-muted small d-block mb-1">Tanggal Mulai</label>
                            <span class="fw-semibold">{{ \Carbon\Carbon::parse($permohonan->tgl_mulai)->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-muted small d-block mb-1">Tanggal Selesai</label>
                            <span class="fw-semibold">{{ \Carbon\Carbon::parse($permohonan->tgl_selesai)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Kategori Lokasi</label>
                        <span class="fw-semibold">{{ $permohonan->opdChild?->kategori?->kategori ?? $permohonan->opd?->kategori?->kategori ?? '-' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Lokasi Tujuan Surat</label>
                        <span class="fw-semibold">{{ $permohonan->id_opd_child ? $permohonan->opdChild->nama : $permohonan->opd->nama_opd }}</span>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">Tim Peneliti</h6>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Dosen Pembimbing</label>
                        @forelse($permohonan->pembimbing as $pembimbing)
                            <span class="badge bg-light text-dark border me-1 mb-1">{{ $pembimbing->nama_pembimbing }}</span>
                        @empty
                            <span class="text-muted">-</span>
                        @endforelse
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Jenis Pengajuan</label>
                        <span class="fw-semibold">{{ strtolower($permohonan->jenis_pengajuan) === 'kelompok' ? 'Kelompok' : 'Personal (Individu)' }}</span>
                    </div>
                    @if(strtolower($permohonan->jenis_pengajuan) === 'kelompok')
                        <div class="mb-2">
                            <label class="text-muted small d-block mb-1">Anggota Kelompok</label>
                            <ul class="list-group list-group-flush border rounded">
                                @foreach($permohonan->anggota as $anggota)
                                    <li class="list-group-item py-2 px-3 small">
                                        {{ $anggota->nama_anggota }} <span class="text-muted">— {{ $anggota->nik }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>

        <!-- Preview PDF Surat Izin -->
        <div class="col-md-6 mb-4">
            
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h6 class="fw-bold text-primary mb-4 border-bottom pb-2">Dokumen Surat Izin</h6>
                    
                    @if($surat && $surat->file_path)
                        <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info-emphasis d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fs-4"></i>
                            <div>
                                <small>Dokumen di bawah ini telah disetujui dan ditandatangani secara elektronik oleh BRIDA dan Kesbangpol.</small>
                            </div>
                        </div>
                        
                        <!-- Menampilkan file PDF -->
                        <div class="flex-grow-1 border rounded bg-light d-flex align-items-center justify-content-center" style="min-height: 300px;">
                            <iframe src="{{ asset('storage/' . $surat->file_path) }}" width="100%" height="100%" style="border: none; min-height: 300px;"></iframe>
                        </div>
                        
                        <div class="mt-3 text-end">
                            <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-external-link-alt me-1"></i> Buka Dokumen
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5 my-auto text-muted">
                            <i class="fas fa-file-excel fs-1 mb-3 text-light"></i>
                            <h5>Dokumen Belum Tersedia</h5>
                            <p>Surat final belum diterbitkan untuk permohonan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>