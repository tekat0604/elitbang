<div>
  <div class="mb-3">
    <a href="{{ route('verifikator.pemohon.list') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali ke Antrean
    </a>
  </div>

  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card card-dash border-0 h-100">
        <div class="card-header bg-white border-bottom p-4">
          <h5 class="mb-0 fw-bold">Detail Data Identitas Pemohon</h5>
        </div>
        <div class="card-body p-4">
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <span class="text-muted small">Nama Lengkap</span>
              <div class="fw-semibold fs-6">{{ $pemohon->nama_lengkap }}</div>
            </div>
            <div class="col-md-6 mb-3">
              <span class="text-muted small">Identitas ({{ strtoupper($pemohon->jenis_identitas) }})</span>
              <div class="fw-semibold fs-6">{{ $pemohon->nomor_identitas }}</div>
            </div>
            <div class="col-md-6 mb-3">
              <span class="text-muted small">Kontak</span>
              <div class="fw-semibold fs-6">{{ $pemohon->no_hp }} <br> <span
                  class="text-primary">{{ $pemohon->email }}</span></div>
            </div>
            <div class="col-md-6 mb-3">
              <span class="text-muted small">TTL & Kewarganegaraan</span>
              <div class="fw-semibold fs-6">{{ \Carbon\Carbon::parse($pemohon->tanggal_lahir)->format('d M Y') }}
                ({{ $pemohon->kewarganegaraan }})</div>
            </div>
            <div class="col-12 mb-3">
              <span class="text-muted small">Alamat Lengkap</span>
              <div class="fw-semibold fs-6">
                {{ $pemohon->alamat }} <br>
                Kel. {{ $pemohon->kelurahan_desa }}, Kec. {{ $pemohon->kecamatan }} <br>
                {{ $pemohon->kota_kabupaten }}, Prov. {{ $pemohon->provinsi }}
              </div>
            </div>
          </div>

          <hr>
          <h6 class="mb-3 fw-bold">Dokumen Identitas Terlampir</h6>
          <div class="border rounded p-2 text-center bg-light">
            <img src="{{ asset('storage/' . $pemohon->path_identitas) }}" class="img-fluid rounded shadow-sm"
              alt="Foto Identitas" style="max-height: 400px; object-fit: contain;">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card card-dash border-0 sticky-top" style="top: 2rem;">
        <div class="card-header bg-white border-bottom p-4">
          <h5 class="mb-0 fw-bold">Tindakan Verifikator</h5>
        </div>
        
        <div class="card-body p-4">
            @if($pemohon->status_verifikasi === 'terverifikasi')
                <div class="alert alert-success text-center mb-0">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h6 class="fw-bold mb-1">Telah Diverifikasi</h6>
                    <p class="small mb-0">Data ini sudah berstatus valid dan terkunci di dalam sistem. Tidak ada tindakan lanjutan yang diperlukan.</p>
                </div>
            @elseif($pemohon->status_verifikasi === 'revisi')
                <div class="alert alert-warning text-center mb-0 border-0 shadow-sm">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i>
                    <h6 class="fw-bold mb-1">Menunggu Perbaikan Pemohon</h6>
                    <p class="small mb-0">Keputusan terkunci. Anda baru bisa memverifikasi ulang setelah pemohon memperbaiki dan mengirim kembali datanya.</p>
                </div>
            @else
                <form wire:submit.prevent="simpanVerifikasi">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Keputusan Verifikasi</label>
                        <select wire:model.live="status_verifikasi" class="form-select border-2">
                            <option value="pending">Menunggu (Pending)</option>
                            <option value="terverifikasi" class="text-success fw-bold">Terverifikasi (Setujui)</option>
                            <option value="revisi" class="text-danger fw-bold">Kembalikan (Revisi)</option>
                        </select>
                        @error('status_verifikasi') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Catatan / Alasan
                            @if($status_verifikasi === 'revisi')
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <textarea wire:model="catatan_verifikasi" class="form-control" rows="4" placeholder="Tuliskan catatan perbaikan di sini..."></textarea>
                        <small class="text-muted d-block mt-1">Wajib diisi jika Anda meminta revisi data.</small>
                        @error('catatan_verifikasi') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="fas fa-save me-1"></i> Simpan Keputusan</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </form>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>