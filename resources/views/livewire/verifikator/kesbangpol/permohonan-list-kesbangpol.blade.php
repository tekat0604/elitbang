<div>
    <!-- Panduan Status -->
    <div class="card card-dash mb-4 border-0">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Status Verifikasi Kesbangpol</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="p-3 border rounded h-100">
                        <span class="badge bg-warning text-dark mb-2">Pending</span>
                        <p class="mb-0 small text-muted">Data permohonan baru masuk dan menunggu diperiksa substansinya (Judul & Proposal).</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded h-100">
                        <span class="badge bg-success mb-2">Disetujui</span>
                        <p class="mb-0 small text-muted">Judul dan Proposal dinyatakan <b>Sah</b>.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded h-100">
                        <span class="badge bg-danger mb-2">Revisi</span>
                        <p class="mb-0 small text-muted">Judul atau Proposal kurang sesuai dan dikembalikan ke pemohon.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded h-100">
                        <span class="badge bg-dark mb-2">Ditolak</span>
                        <p class="mb-0 small text-muted">Penelitian ini tidak diizinkan untuk dilaksanakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Permohonan -->
    <div class="card card-dash border-0">
        <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Antrean Permohonan (Substantif)</h5>
            <span class="badge bg-primary text-white fs-6 px-3 py-2">
                <i class="fas fa-shield-alt me-1"></i> PANEL KESBANGPOL
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">Tgl Pengajuan</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Izin</th>
                            <th>Judul Penelitian</th>
                            <th>Status Kesbangpol</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonanList as $item)
                            <tr>
                                <td class="px-4">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="fw-semibold">
                                    {{ $item->pemohon->nama_lengkap ?? 'Data Tidak Ditemukan' }}
                                </td>
                                <td>{{ $item->layanan->nama_layanan ?? '-' }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;" title="{{ $item->judul }}">
                                        {{ $item->judul }}
                                    </div>
                                </td>
                                <td>
                                    @if ($item->status_kesbangpol == 'pending' || empty($item->status_kesbangpol))
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($item->status_kesbangpol == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status_kesbangpol == 'ditolak')
                                        <span class="badge bg-dark">Ditolak</span>
                                    @else
                                        <span class="badge bg-danger">Revisi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('verifikator.kesbangpol.permohonan.detail', $item->id) }}" class="btn btn-sm btn-primary">
                                        Periksa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada antrean permohonan saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer bg-white px-4 py-3 border-top">
            {{ $permohonanList->links() }}
        </div>
    </div>
</div>