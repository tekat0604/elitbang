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
                        
                        <!-- Informasi Utama -->
                        <div class="col-md-4 mb-3">
                            <span class="text-muted small">Jenis Izin</span>
                            <div class="fw-semibold">{{ $permohonan->layanan->nama_layanan }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted small">Status KESBANGPOL</span>
                            <div>
                                <span class="badge bg-{{ $permohonan->status_kesbangpol == 'disetujui' ? 'success' : ($permohonan->status_kesbangpol == 'revisi' ? 'warning' : ($permohonan->status_kesbangpol == 'ditolak' ? 'danger' : 'secondary')) }}">
                                    {{ str($permohonan->status_kesbangpol)->title() }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted small">Status BRIDA</span>
                            <div>
                                <span class="badge bg-{{ $permohonan->status_brida == 'disetujui' ? 'success' : ($permohonan->status_brida == 'revisi' ? 'warning' : ($permohonan->status_brida == 'ditolak' ? 'danger' : 'secondary')) }}">
                                    {{ str($permohonan->status_brida)->title() }}
                                </span>
                            </div>
                        </div>

                        {{-- Identitas Pemohon --}}
                        <div class="col-12 mb-3 mt-2">
                            <span class="text-muted small">Nama Pemohon</span>
                            <div class="fw-semibold">{{ $permohonan->pemohon->nama_lengkap ?? '-' }}</div>
                        </div>
                        <div class="col-12 mb-3 mt-2">
                            <span class="text-muted small">Instansi / Universitas Asal</span>
                            <div class="fw-semibold">{{ $permohonan->nama_instansi ?? '-' }}</div>
                        </div>

                        @if($permohonan->nim || $permohonan->fakultas || $permohonan->program_studi)
                            <div class="col-12 mt-2">
                                
                                @if($permohonan->fakultas)
                                    <div class="mb-3">
                                        <span class="text-muted small">Fakultas</span>
                                        <div class="fw-semibold">{{ $permohonan->fakultas }}</div>
                                    </div>
                                @endif

                                @if($permohonan->program_studi)
                                    <div class="mb-3">
                                        <span class="text-muted small">Program Studi</span>
                                        <div class="fw-semibold">{{ $permohonan->program_studi }}</div>
                                    </div>
                                @endif

                                @if($permohonan->nim)
                                    <div class="mb-3">
                                        <span class="text-muted small">Nomor Induk Mahasiswa (NIM)</span>
                                        <div class="fw-semibold">{{ $permohonan->nim }}</div>
                                    </div>
                                @endif
                                
                            </div>
                        @endif
                    </div>

                    <h6 class="fw-bold text-primary border-bottom pb-2">Data Substantif <span class="badge bg-primary ms-2 text-wrap">Wewenang Kesbangpol</span></h6>
                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <span class="text-muted small">Judul Penelitian</span>
                            <div class="fw-semibold">{{ $permohonan->judul }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted small">Tujuan Penelitian/Kegiatan</span>
                            <div class="fw-semibold" style="text-align: justify;">
                                {{ $permohonan->tujuan ?? '-' }}
                            </div>
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
                    <h5 class="mb-0 fw-bold text-white"><i class="fas fa-check-double me-2"></i>Verifikasi Kesbangpol</h5>
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
                                    <option value="disetujui" class="text-success fw-bold">Setujui</option>
                                    <option value="revisi" class="text-warning fw-bold">Revisi</option>
                                    <option value="ditolak" class="text-danger fw-bold">Tolak</option>
                                </select>
                                @error('status_kesbangpol') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Catatan Kesbangpol</label>
                                <textarea wire:model="catatan_kesbangpol" class="form-control @error('catatan_kesbangpol') is-invalid @enderror" rows="4" placeholder="Wajib diisi jika status Revisi atau Ditolak..."></textarea>
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