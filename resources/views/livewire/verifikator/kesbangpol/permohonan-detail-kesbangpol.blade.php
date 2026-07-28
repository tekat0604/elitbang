<div>
    <div class="mb-3">
        <a href="{{ route('verifikator.kesbangpol.permohonan.list') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Antrean
        </a>
    </div>
    <div class="row g-4">
        <!-- Kolom Data Permohonan -->
        <div class="col-lg-8">
            <div class="card card-dash border-0 h-100">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="mb-0 fw-bold">Detail Data Substantif Permohonan</h5>
                </div>
                <div class="card-body p-4">
                    
                    <h6 class="fw-bold text-primary border-bottom pb-2">Informasi Umum</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Jenis Izin</span>
                            <div class="fw-semibold">{{ $permohonan->layanan->nama_layanan }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Status Kesbangpol Saat Ini</span>
                            <div>
                                <span class="badge bg-{{ $permohonan->status_kesbangpol == 'disetujui' ? 'success' : ($permohonan->status_kesbangpol == 'revisi' ? 'warning' : 'secondary') }}">
                                    KESBANGPOL: {{ $permohonan->status_kesbangpol ?? 'pending' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary border-bottom pb-2">Data Substantif <span class="badge bg-primary ms-2 text-wrap">Wewenang Kesbangpol</span></h6>
                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <span class="text-muted small">Judul Penelitian</span>
                            <div class="fw-semibold">{{ $permohonan->judul }}</div>
                        </div>
                        @if ($permohonan->layanan->slug_layanan === 'izin-penelitian')
                        <div class="col-12 mt-2">
                            <a href="{{ $permohonan->link_proposal }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Buka Proposal
                            </a>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Panel Aksi Verifikasi KESBANGPOL -->
        <div class="col-lg-4">
            <div class="card card-dash border-0 sticky-top" style="top: 2rem;">
                <div class="card-header bg-primary text-white border-bottom p-4">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-check-double me-2"></i>Verifikasi Kesbangpol</h5>
                </div>
                
                <div class="card-body p-4">
                    
                    @if($permohonan->status_permohonan === 'ditolak')
                        <div class="alert alert-dark text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-ban fa-2x mb-2 text-dark"></i>
                            <h6 class="fw-bold mb-1">Ditolak Permanen</h6>
                            <p class="small mb-0 text-muted">Permohonan ini telah ditolak secara permanen dan tidak dapat diproses lagi.</p>
                        </div>

                    @elseif($permohonan->status_kesbangpol === 'disetujui')
                        <div class="alert alert-success text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                            <h6 class="fw-bold mb-1">Telah Disetujui Kesbangpol</h6>
                            <p class="small mb-0 text-muted">Data substantif telah sah. Menunggu proses selanjutnya.</p>
                        </div>

                    @elseif($permohonan->status_kesbangpol === 'revisi')
                        <div class="alert alert-warning text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-exclamation-circle fa-2x mb-2 text-warning"></i>
                            <h6 class="fw-bold mb-1">Menunggu Perbaikan</h6>
                            <p class="small mb-0 text-muted">Email revisi telah terkirim. Keputusan <b>terkunci</b> hingga pemohon memperbaiki datanya.</p>
                        </div>

                    @else
                        <form wire:submit.prevent="simpanVerifikasi">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Keputusan Substantif</label>
                                <select wire:model.live="status_kesbangpol" class="form-select border-2 @error('status_kesbangpol') is-invalid @enderror">
                                    <option value="pending">Menunggu (Pending)</option>
                                    <option value="disetujui" class="text-success fw-bold">Setujui Judul & Proposal</option>
                                    <option value="revisi" class="text-warning fw-bold">Kembalikan (Revisi)</option>
                                    <option value="ditolak" class="text-danger fw-bold">Tolak Permanen</option>
                                </select>
                                @error('status_kesbangpol') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Catatan Kesbangpol</label>
                                <textarea wire:model="catatan_kesbangpol" class="form-control @error('catatan_kesbangpol') is-invalid @enderror" rows="4" placeholder="Tulis alasan jika revisi atau tolak..."></textarea>
                                <small class="text-muted d-block mt-1">Wajib diisi jika status Revisi atau Ditolak.</small>
                                @error('catatan_kesbangpol') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="fas fa-save me-1"></i> Simpan Keputusan</span>
                                <span wire:loading>Memproses...</span>
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>