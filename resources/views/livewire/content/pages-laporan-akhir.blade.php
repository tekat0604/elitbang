<div>
  <div class="card card-dash border-0 mb-4">
    <div class="card-header bg-white border-bottom p-4">
      <h5 class="mb-1 fw-bold">Upload Laporan Akhir Penelitian</h5>
      <p class="mb-0 text-body-secondary">Setelah penelitian selesai, unggah link dokumen laporan akhir Anda untuk diverifikasi oleh BRIDA.</p>
    </div>
    <div class="card-body p-4">
      @if ($isSubmitted)
        <div class="alert alert-success d-flex align-items-center mb-0" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <div>Link laporan berhasil disiapkan. Berikut adalah daftar laporan akhir penelitian Anda.</div>
        </div>
      @else
        <form wire:submit="submit">
          <div class="row g-3 align-items-end">
            <div class="col-md-5">
              <label for="permohonanId" class="form-label fw-semibold">Permohonan Penelitian</label>
              <select wire:model="permohonanId" id="permohonanId" class="form-select @error('permohonanId') is-invalid @enderror">
                <option value="">Pilih permohonan penelitian</option>
                @foreach ($permohonanList as $item)
                  <option value="{{ $item->id }}">{{ $item->judul }} - {{ $item->layanan?->nama_layanan ?? 'Izin Penelitian' }}</option>
                @endforeach
              </select>
              @error('permohonanId') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-5">
              <label for="linkDokumen" class="form-label fw-semibold">Link Dokumen Laporan (Google Drive)</label>
              <input wire:model="linkDokumen" type="url" id="linkDokumen" class="form-control @error('linkDokumen') is-invalid @enderror" placeholder="https://drive.google.com/...">
              @error('linkDokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-2 d-grid">
              <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i>Kirim Laporan</button>
            </div>
          </div>
          @if ($permohonanList->isEmpty())
            <div class="form-text mt-3">Belum ada permohonan yang selesai dan dapat dilaporkan.</div>
          @endif
        </form>
      @endif
    </div>
  </div>

  @if ($isSubmitted)
    @php
      $selectedPermohonan = $permohonanList->firstWhere('id', $permohonanId);
    @endphp
    <div class="card card-dash border-0">
      <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-1 fw-bold">Daftar Laporan Akhir</h5>
        <p class="mb-0 text-body-secondary">Pantau status verifikasi laporan akhir oleh BRIDA.</p>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>No.</th>
                <th>Jenis Izin</th>
                <th>Judul Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Link Laporan</th>
                <th>Status BRIDA</th>
                <th>Catatan BRIDA</th>
                <th>Status Utama</th>
                <th>Surat Keterangan Selesai Penelitian</th>
              </tr>
            </thead>
            <tbody>
              @if ($selectedPermohonan)
                <tr>
                  <td>1</td>
                  <td class="fw-semibold">{{ $selectedPermohonan->layanan?->nama_layanan ?? '-' }}</td>
                  <td>{{ $selectedPermohonan->judul }}</td>
                  <td>{{ $selectedPermohonan->created_at?->translatedFormat('d M Y') }}</td>
                  <td><a href="{{ $linkDokumen }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary"><i class="fas fa-external-link-alt me-1"></i>Lihat Dokumen</a></td>
                  <td><span class="badge text-bg-warning">Menunggu Verifikasi</span></td>
                  <td>-</td>
                  <td><span class="badge text-bg-warning">Dikirim</span></td>
                  <td><span class="text-body-secondary">Belum tersedia</span></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @endif
</div>
