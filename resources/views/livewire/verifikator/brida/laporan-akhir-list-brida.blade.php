<div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card card-dash border-0">
        <div class="card-header bg-white border-bottom p-4">
            <h5 class="mb-1 fw-bold">Daftar Laporan Akhir Penelitian</h5>
            <p class="mb-0 text-body-secondary">Pantau dan periksa laporan akhir penelitian yang dikirim oleh pemohon.</p>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No.</th>
                            <th>Jenis Izin</th>
                            <th>Judul Pengajuan</th>
                            <th>Nama Pemohon</th>
                            <th>Tanggal Upload</th>
                            <th>Link Laporan</th>
                            <th>Status BRIDA</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanList as $laporan)
                            <tr>
                                <td class="px-4">{{ $laporanList->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold">{{ $laporan->permohonan->layanan?->nama_layanan ?? '-' }}</td>
                                <td>{{ $laporan->permohonan->judul ?? '-' }}</td>
                                <td>{{ $laporan->permohonan->pemohon?->nama_lengkap ?? '-' }}</td>
                                <td>{{ $laporan->tanggal_upload?->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td><a href="{{ $laporan->file_laporan }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary"><i class="fas fa-external-link-alt me-1"></i>Lihat Dokumen</a></td>
                                <td>
                                    <span class="badge {{ $laporan->status_laporan === 'disetujui' ? 'bg-success' : ($laporan->status_laporan === 'revisi' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                        {{ str($laporan->status_laporan)->replace('_', ' ')->title() }}
                                    </span>
                                </td>
                                <td class="text-center"><a href="{{ route('verifikator.brida.laporan-akhir.detail', $laporan->id) }}" class="btn btn-sm btn-primary">Periksa <i class="fas fa-arrow-right ms-1"></i></a></td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-4 text-body-secondary">Belum ada laporan akhir yang dikirim.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white px-4 py-3 border-top">{{ $laporanList->links() }}</div>
    </div>
</div>
