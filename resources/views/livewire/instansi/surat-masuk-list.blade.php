<div>
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold text-dark"><i class="fas fa-inbox text-primary me-2"></i> Daftar Surat Masuk</h5>
            <p class="text-muted small">Daftar permohonan izin penelitian yang ditujukan ke instansi Anda.</p>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center" width="5%">No</th>
                            <th scope="col">Nama Pemohon</th>
                            <th scope="col">Perihal / Layanan</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col" class="text-center" width="15%">Status</th>
                            <th scope="col" class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suratMasuk as $index => $item)
                            <tr>
                                <td class="text-center">{{ $suratMasuk->firstItem() + $index }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $item->permohonan->pemohon->nama_lengkap ?? '-' }}</span><br>
                                    <small class="text-muted">{{ $item->permohonan->nama_instansi ?? '-' }}</small>
                                </td>
                                <td>{{ $item->permohonan->layanan->nama_layanan ?? '-' }}</td>
                                <td>{{ $item->created_at->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td class="text-center">
                                    @if($item->is_read)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Sudah Dibaca</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Belum Dibaca</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- Arahkan ke halaman detail permohonan_id -->
                                    <a href="{{ route('instansi.surat-masuk.detail', $item->permohonan_id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fs-3 mb-2 text-light"></i><br>
                                    Belum ada surat masuk untuk instansi Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $suratMasuk->links() }}
            </div>
        </div>
    </div>
</div>