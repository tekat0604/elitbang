<div>
  <div class="card card-dash border-0">
    <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-1 fw-bold">Daftar Surat Menunggu Tanda Tangan</h5><small class="text-muted">Permohonan yang telah
          disetujui BRIDA dan Kesbangpol.</small>
      </div>
      <span class="badge bg-primary text-white fs-6 px-3 py-2"><i class="fas fa-pen-nib me-1"></i> PANEL BRIDA</span>
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
              <th class="text-center">Detail</th>
              <th class="text-center">Tanda Tangan</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($permohonanList as $item)
              <tr>
                <td class="px-4">{{ $item->created_at->format('d M Y') }}</td>
                <td class="fw-semibold">{{ $item->pemohon->nama_lengkap ?? 'Data Tidak Ditemukan' }}</td>
                <td>{{ $item->layanan->nama_layanan ?? '-' }}</td>
                <td>
                  <div class="text-truncate" style="max-width: 200px;" title="{{ $item->nama_instansi }}">
                    {{ $item->nama_instansi }}</div>
                </td>
                <td class="text-center"><a href="{{ route('penandatangan.brida.detail', $item->id) }}"
                    class="btn btn-sm btn-outline-primary"><i class="fas fa-file-alt me-1"></i> Detail</a></td>
                <td class="text-center"><a
                    href=""
                    class="btn btn-sm btn-primary">Tanda Tangan <i class="fas fa-pen-nib ms-1"></i></a></td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">Belum ada surat yang menunggu tanda tangan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer bg-white px-4 py-3 border-top">{{ $permohonanList->links() }}</div>
  </div>
</div>
