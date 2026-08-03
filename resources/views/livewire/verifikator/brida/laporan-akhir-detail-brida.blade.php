<div>
    <div class="mb-3"><a href="{{ route('verifikator.brida.laporan-akhir.list') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar Laporan</a></div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-dash border-0 h-100">
                <div class="card-header bg-white border-bottom p-4"><h5 class="mb-0 fw-bold">Detail Pengajuan Laporan Akhir Penelitian</h5></div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-primary border-bottom pb-2">Informasi Pengajuan</h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3"><span class="text-muted small">Nama Pemohon</span><div class="fw-semibold">{{ $laporan->permohonan->pemohon?->nama_lengkap ?? '-' }}</div></div>
                        <div class="col-md-6 mb-3"><span class="text-muted small">Jenis Izin</span><div class="fw-semibold">{{ $laporan->permohonan->layanan?->nama_layanan ?? '-' }}</div></div>
                        <div class="col-12 mb-3"><span class="text-muted small">Judul Penelitian</span><div class="fw-semibold">{{ $laporan->permohonan->judul ?? '-' }}</div></div>
                        <div class="col-md-6 mb-3"><span class="text-muted small">Instansi / Universitas</span><div class="fw-semibold">{{ $laporan->permohonan->nama_instansi ?? '-' }}</div></div>
                        <div class="col-md-6 mb-3"><span class="text-muted small">Tanggal Upload</span><div class="fw-semibold">{{ $laporan->tanggal_upload?->locale('id')->isoFormat('D MMMM Y') }}</div></div>
                    </div>
                    <h6 class="fw-bold text-primary border-bottom pb-2">Dokumen Laporan Akhir</h6>
                    <a href="{{ $laporan->file_laporan }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary"><i class="fas fa-external-link-alt me-1"></i>Buka Laporan Akhir</a>
                    @if ($laporan->catatan_revisi)
                        <div class="alert alert-warning mt-4 mb-0"><strong>Catatan BRIDA:</strong> {{ $laporan->catatan_revisi }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-dash border-0 sticky-top" style="top: 2rem;">
                <div class="card-header bg-primary text-white border-bottom p-4"><h5 class="mb-0 fw-bold"><i class="fas fa-check-double me-2"></i>Tindakan Verifikator</h5></div>
                <div class="card-body p-4">
                    @if ($laporan->status_laporan === 'diterima')
                        <div class="alert alert-success text-center mb-0"><i class="fas fa-check-circle fa-2x mb-2"></i><h6 class="fw-bold">Laporan Telah Diterima</h6><p class="small mb-0">Laporan akhir telah diverifikasi oleh BRIDA.</p></div>
                    @elseif ($laporan->status_laporan === 'revisi')
                        <div class="alert alert-warning text-center mb-0"><i class="fas fa-exclamation-circle fa-2x mb-2"></i><h6 class="fw-bold">Menunggu Perbaikan</h6><p class="small mb-0">Pemohon telah diberi catatan untuk mengunggah ulang laporan.</p></div>
                    @else
                        <form wire:submit="simpanVerifikasi">
                            <div class="mb-4"><label class="form-label fw-semibold">Keputusan</label><select wire:model.live="statusLaporan" class="form-select @error('statusLaporan') is-invalid @enderror"><option value="dikirim">Menunggu</option><option value="diterima">Terima Laporan</option><option value="revisi">Minta Revisi</option></select>@error('statusLaporan') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                            <div class="mb-4"><label class="form-label fw-semibold">Catatan BRIDA</label><textarea wire:model="catatanRevisi" rows="4" class="form-control @error('catatanRevisi') is-invalid @enderror" placeholder="Wajib diisi jika meminta revisi..."></textarea>@error('catatanRevisi') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" wire:loading.attr="disabled"><span wire:loading.remove><i class="fas fa-save me-1"></i>Simpan Keputusan</span><span wire:loading>Memproses...</span></button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
