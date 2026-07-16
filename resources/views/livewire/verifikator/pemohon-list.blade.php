<div>
    <div class="card card-dash mb-4 border-0">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Status Verifikasi</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="p-3 border rounded">
                        <span class="badge bg-warning text-dark mb-2">Pending</span>
                        <p class="mb-0 small text-muted">Data baru masuk dan menunggu diperiksa oleh Verifikator.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded">
                        <span class="badge bg-success mb-2">Terverifikasi</span>
                        <p class="mb-0 small text-muted">Data sah dan disetujui. <b>Tidak dapat diubah lagi</b>.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded">
                        <span class="badge bg-danger mb-2">Revisi</span>
                        <p class="mb-0 small text-muted">Ada data salah. Dikembalikan ke pemohon untuk diedit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-dash border-0">
        <div class="card-header bg-white border-bottom p-4">
            <h5 class="mb-0 fw-bold">Daftar Antrean Verifikasi Identitas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">Tgl Daftar</th>
                            <th>Nama Lengkap</th>
                            <th>Identitas</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemohonList as $item)
                            <tr>
                                <td class="px-4">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="fw-semibold">{{ $item->nama_lengkap }}</td>
                                <td>{{ strtoupper($item->jenis_identitas) }} - {{ $item->nomor_identitas }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    @if ($item->status_verifikasi == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($item->status_verifikasi == 'terverifikasi')
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Revisi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('verifikator.pemohon.detail', $item->id) }}" class="btn btn-sm btn-primary">
                                        Periksa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada antrean verifikasi saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white px-4 py-3 border-top">
            {{ $pemohonList->links() }}
        </div>
    </div>
</div>