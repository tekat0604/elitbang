<div>
    <div class="mb-3">
        <a href="{{ route('verifikator.brida.permohonan.list') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Antrean
        </a>
    </div>
    <div class="row g-4">
        <!-- Kolom Data Permohonan -->
        <div class="col-lg-8">
            <div class="card card-dash border-0 h-100">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="mb-0 fw-bold">Detail Data Teknis Permohonan</h5>
                </div>
                <div class="card-body p-4">
                    
                    <h6 class="fw-bold text-primary border-bottom pb-2">Informasi Umum</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Jenis Izin</span>
                            <div class="fw-semibold">{{ $permohonan->layanan->nama_layanan }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Status BRIDA Saat Ini</span>
                            <div>
                                <span class="badge bg-{{ $permohonan->status_brida == 'disetujui' ? 'success' : ($permohonan->status_brida == 'revisi' ? 'warning' : 'secondary') }}">
                                    {{ strtoupper($permohonan->status_brida) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ======== data Akademik & kepesertaan ======== -->
                    <h6 class="fw-bold text-primary border-bottom pb-2">Data Akademik & Kepesertaan <span class="badge bg-primary ms-2 text-wrap">Wewenang BRIDA</span></h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Jenjang Pendidikan</span>
                            <div class="fw-semibold">{{ $permohonan->jenjang_pendidikan }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Jenis Pengajuan & Total Peserta</span>
                            <div class="fw-semibold">
                                {{ ucfirst($permohonan->jenis_pengajuan) }} 
                                @if(strtolower($permohonan->jenis_pengajuan) === 'kelompok')
                                    <span class="badge bg-info ms-1">{{ $permohonan->jumlah_anggota }} Orang</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Bidang Penelitian</span>
                            <div class="fw-semibold">{{ $permohonan->bidang_penelitian }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Rumpun Penelitian</span>
                            <div class="fw-semibold">{{ $permohonan->rumpun_penelitian }}</div>
                        </div>

                        <!-- Daftar Pembimbing -->
                        @if($permohonan->pembimbing->count() > 0)
                        <div class="col-12 mb-3">
                            <span class="text-muted small">Dosen Pembimbing / Penanggung Jawab</span>
                            <ul class="list-group list-group-flush border mt-1 rounded">
                                @foreach($permohonan->pembimbing as $index => $p)
                                    <li class="list-group-item py-2 px-3 small">
                                        {{ $index + 1 }}. {{ $p->nama_pembimbing }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Daftar Anggota Kelompok -->
                        @if(strtolower($permohonan->jenis_pengajuan) === 'kelompok' && $permohonan->anggota->count() > 0)                        <div class="col-12 mb-3">
                            <span class="text-muted small">Daftar Anggota Kelompok</span>
                            <div class="table-responsive mt-1">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No</th>
                                            <th>Nama Anggota</th>
                                            <th>NIK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permohonan->anggota as $index => $a)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $a->nama_anggota }}</td>
                                                <td>{{ $a->nik }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>

                    <h6 class="fw-bold text-primary border-bottom pb-2">Data Teknis & Pelaksanaan <span class="badge bg-primary ms-2 text-wrap">Wewenang BRIDA</span></h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Instansi / Universitas Asal</span>
                            <div class="fw-semibold">{{ $permohonan->nama_instansi }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="text-muted small">Tanggal Pelaksanaan</span>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($permohonan->tgl_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($permohonan->tgl_selesai)->format('d M Y') }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted small">Lokasi Penelitian (OPD)</span>
                            <div class="fw-semibold">{{ $permohonan->lokasi }}</div>
                        </div>
                        <div class="col-12 mt-2">
                            <a href="{{ $permohonan->link_pengantar_kampus }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Buka Surat Pengantar (G-Drive)
                            </a>
                        </div>
                        <div class="col-12 mt-2">
                            <a href="{{ $permohonan->link_proposal }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Buka Proposal
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Panel Aksi Verifikasi BRIDA -->
        <div class="col-lg-4">
            <div class="card card-dash border-0 sticky-top" style="top: 2rem;">
                <div class="card-header bg-primary text-white border-bottom p-4">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-check-double me-2"></i>Verifikasi BRIDA</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if($permohonan->status_permohonan === 'ditolak')
                        <div class="alert alert-dark text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-ban fa-2x mb-2 text-dark"></i>
                            <h6 class="fw-bold mb-1">Ditolak Permanen</h6>
                            <p class="small mb-0 text-muted">Permohonan ini telah ditolak secara permanen dan tidak dapat diproses lagi.</p>
                        </div>

                    @elseif($permohonan->status_brida === 'disetujui')
                        <div class="alert alert-success text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                            <h6 class="fw-bold mb-1">Telah Disetujui BRIDA</h6>
                            <p class="small mb-0 text-muted">Data teknis telah sah. Menunggu keputusan Kesbangpol untuk proses Laporan Akhir.</p>
                        </div>

                    @elseif($permohonan->status_brida === 'revisi')
                        <div class="alert alert-warning text-center mb-0 border-0 shadow-sm">
                            <i class="fas fa-exclamation-circle fa-2x mb-2 text-warning"></i>
                            <h6 class="fw-bold mb-1">Menunggu Perbaikan</h6>
                            <p class="small mb-0 text-muted">Email notifikasi revisi telah dikirim. Keputusan <b>terkunci</b> hingga pemohon memperbaiki datanya.</p>
                        </div>

                    @else
                        <!-- FORM TERBUKA HANYA UNTUK STATUS PENDING -->
                        <form wire:submit.prevent="simpanVerifikasi">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Keputusan Teknis</label>
                                <select wire:model.live="status_brida" class="form-select border-2 @error('status_brida') is-invalid @enderror">
                                    <option value="pending">Menunggu (Pending)</option>
                                    <option value="disetujui" class="text-success fw-bold">Setujui Data Teknis</option>
                                    <option value="revisi" class="text-warning fw-bold">Kembalikan (Revisi)</option>
                                    <option value="ditolak" class="text-danger fw-bold">Tolak Permanen</option>
                                </select>
                                @error('status_brida') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Catatan Revisi BRIDA</label>
                                <textarea wire:model="catatan_brida" class="form-control @error('catatan_brida') is-invalid @enderror" rows="4" placeholder="Tulis catatan jika data teknis salah..."></textarea>
                                @error('catatan_brida') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="fas fa-save me-1"></i> Simpan Keputusan BRIDA</span>
                                <span wire:loading>Memproses...</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>