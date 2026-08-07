<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Permohonan Izin</h4>
        <a href="{{ route('instansi.surat-masuk.list') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- Informasi Pemohon -->
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-primary mb-4 border-bottom pb-2">Informasi Kegiatan</h6>
                    
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Nama Lengkap</label>
                        <span class="fw-semibold">{{ $permohonan->pemohon->nama_lengkap ?? '-' }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Asal Instansi/Universitas</label>
                        <span class="fw-semibold">{{ $permohonan->nama_instansi ?? '-' }}</span>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Judul Penelitian/Kegiatan</label>
                        <span class="fw-semibold">{{ $permohonan->judul ?? '-' }}</span>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Tujuan Penelitian/Kegiatan</label>
                        <span class="fw-semibold">{{ $permohonan->tujuan ?? '-' }}</span>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small d-block mb-1">Lokasi Tujuan (UPTD)</label>
                        <span class="fw-semibold">{{ $permohonan->opdChild->nama ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview PDF Surat Izin -->
        <div class="col-md-7 mb-4">
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
                        <div class="flex-grow-1 border rounded bg-light d-flex align-items-center justify-content-center" style="min-height: 400px;">
                            <iframe src="{{ asset('storage/' . $surat->file_path) }}" width="100%" height="100%" style="border: none; min-height: 400px;"></iframe>
                        </div>
                        
                        <div class="mt-3 text-end">
                            <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-external-link-alt me-1"></i> Buka Layar Penuh
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