<div>
  <div class="card card-dash border-0 mb-4">
    <div class="card-header bg-white border-bottom p-4">
      <h5 class="mb-1 fw-bold">Upload Laporan Akhir Penelitian</h5>
      <p class="mb-0 text-body-secondary">Setelah penelitian selesai, unggah link dokumen laporan akhir Anda untuk diverifikasi oleh BRIDA.</p>
    </div>
    <div class="card-body p-4">
      @if (session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <div>{{ session('success') }}</div>
        </div>
      @endif

      @if ($laporanId || $permohonanList->isNotEmpty())
        <form wire:submit="submit">
          @if ($laporanId)
            <div class="alert alert-warning d-flex align-items-center" role="alert">
              <i class="fas fa-edit me-2"></i>
              <div>Anda sedang mengunggah ulang laporan yang diminta revisi oleh BRIDA.</div>
            </div>
          @endif
          <div class="row g-3 align-items-end">
            <div class="col-md-5">
              <label for="permohonanId" class="form-label fw-semibold">Permohonan Penelitian</label>
              <select wire:model="permohonanId" id="permohonanId" class="form-select @error('permohonanId') is-invalid @enderror" @disabled($laporanId)>
                <option value="">Pilih permohonan penelitian</option>
                @foreach ($permohonanList as $item)
                  <option value="{{ $item->id }}">{{ $item->judul }} - {{ $item->layanan?->nama_layanan ?? 'Izin Penelitian' }}</option>
                @endforeach
                @if ($laporanId)
                  @php($laporanRevisi = $laporanList->firstWhere('id', $laporanId))
                  @if ($laporanRevisi)
                    <option value="{{ $laporanRevisi->permohonan_id }}">{{ $laporanRevisi->permohonan->judul }} - {{ $laporanRevisi->permohonan->layanan?->nama_layanan ?? 'Izin Penelitian' }}</option>
                  @endif
                @endif
              </select>
              @error('permohonanId') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-5">
              <label for="linkDokumen" class="form-label fw-semibold">Link Dokumen Laporan (Google Drive)</label>
              <input wire:model="linkDokumen" type="url" id="linkDokumen" class="form-control @error('linkDokumen') is-invalid @enderror" placeholder="https://drive.google.com/...">
              @error('linkDokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-2 d-grid gap-2">
              <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i>{{ $laporanId ? 'Kirim Ulang' : 'Kirim Laporan' }}</button>
              @if ($laporanId)
                <button type="button" wire:click="batalRevisi" class="btn btn-label-secondary">Batal</button>
              @endif
            </div>
          </div>
        </form>
      @else
        <div class="text-body-secondary">Belum ada permohonan selesai yang dapat dikirim sebagai laporan akhir.</div>
      @endif
    </div>
  </div>

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
              <th>Tanggal Upload</th>
              <th>Link Laporan</th>
              <th>Status BRIDA</th>
              <th>Catatan BRIDA</th>
              <th>Surat Keterangan Selesai Penelitian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($laporanList as $laporan)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $laporan->permohonan->layanan?->nama_layanan ?? '-' }}</td>
                <td>{{ $laporan->permohonan->judul }}</td>
                <td>{{ $laporan->tanggal_upload?->locale('id')->isoFormat('D MMMM Y') }}</td>
                <td><a href="{{ $laporan->file_laporan }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary"><i class="fas fa-external-link-alt me-1"></i>Lihat Dokumen</a></td>
                <td><span class="badge {{ $laporan->status_laporan === 'diterima' ? 'text-bg-success' : ($laporan->status_laporan === 'revisi' ? 'text-bg-danger' : 'text-bg-warning') }}">{{ str($laporan->status_laporan)->replace('_', ' ')->title() }}</span></td>
                <td>{{ $laporan->catatan_revisi ?? '-' }}</td>
                <td>
                  @if ($laporan->file_surat_selesai)
                    <a href="{{ $laporan->file_surat_selesai }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success"><i class="fas fa-download me-1"></i>Unduh Surat</a>
                  @else
                    <span class="text-body-secondary">Belum tersedia</span>
                  @endif
                </td>
                <td>
                  @if ($laporan->status_laporan === 'revisi')
                    <button type="button" wire:click="revisi({{ $laporan->id }})" class="btn btn-sm btn-warning"><i class="fas fa-edit me-1"></i>Upload Ulang</button>
                  @else
                    <span class="text-body-secondary">-</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr><td colspan="9" class="text-center py-4 text-body-secondary">Belum ada laporan akhir yang dikirim.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
