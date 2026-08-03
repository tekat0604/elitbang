<div>
  <!-- Panduan Status -->
  <div class="card card-dash mb-4 border-0">
    <div class="card-body">
      <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Status Verifikasi BRIDA</h5>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="p-3 border rounded">
            <span class="badge bg-warning text-dark mb-2">Pending</span>
            <p class="mb-0 small text-muted">Data permohonan baru masuk dan menunggu diperiksa kelengkapan teknisnya.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-3 border rounded">
            <span class="badge bg-success mb-2">Disetujui</span>
            <p class="mb-0 small text-muted">Data teknis dan surat pengantar dinyatakan <b>Sah</b>.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-3 border rounded">
            <span class="badge bg-danger mb-2">Revisi</span>
            <p class="mb-0 small text-muted">Ada berkas/data teknis yang salah dan dikembalikan ke pemohon.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="p-3 border rounded">
            <span class="badge bg-dark mb-2">Ditolak</span>
            <p class="mb-0 small text-muted">Kegiatan atau penelitian ini tidak dapat dilaksanakan</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Daftar Permohonan -->
  <div class="card card-dash border-0">
    <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
      <h5 class="mb-0 fw-bold">Daftar Antrean Permohonan Izin</h5>
      <span class="badge bg-primary text-white fs-6 px-3 py-2">
        <i class="fas fa-shield-alt me-1"></i> PANEL BRIDA
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
              <th>Instansi Tujuan / Asal</th>
              <th>Status BRIDA</th>
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
                  <div class="text-truncate" style="max-width: 200px;" title="{{ $item->nama_instansi }}">
                    {{ $item->nama_instansi }}
                  </div>
                </td>
                <td>
                  @if ($item->status_brida == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                  @elseif($item->status_brida == 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                  @elseif($item->status_brida == 'ditolak')
                    <span class="badge bg-dark">Ditolak</span>
                  @else
                    <span class="badge bg-danger">Revisi</span>
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('verifikator.brida.permohonan.detail', $item->id) }}"
                    class="btn btn-sm btn-primary">
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
