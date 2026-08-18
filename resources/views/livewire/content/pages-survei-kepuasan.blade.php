<div class="row justify-content-center">
  <div class="col-lg-9">
    <div class="card card-dash border-0 shadow-sm">
      <div class="card-body p-4 p-md-5">
        <div class="mb-4">
          <h4 class="mb-1 fw-bold">Survei Kepuasan Masyarakat</h4>
          <p class="mb-0 text-body-secondary">
            Masukan Anda membantu kami meningkatkan kualitas layanan BRIDA Kota Surakarta.
          </p>
        </div>

        @if ($isSubmitted)
          <div class="alert alert-success border-0 bg-success-subtle p-5 text-center rounded-3">
            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
            <h4 class="fw-bold text-success">Terima Kasih Atas Masukan Anda!</h4>
            <p class="mb-4 text-dark">Survei kepuasan masyarakat berhasil dikirim. Penilaian dan ulasan Anda sangat berarti bagi peningkatan kualitas layanan kami ke depannya.</p>
          </div>

        @elseif ($permohonanList->isEmpty())
          <div class="alert alert-info border-0 shadow-sm d-flex align-items-center p-4 rounded-3 bg-info-subtle text-info-emphasis">
            <i class="fas fa-info-circle fa-2x me-3"></i>
            <div>
              <h6 class="fw-bold mb-1">Tidak ada survei tertunda</h6>
              <p class="mb-0 small">Saat ini tidak ada permohonan surat rekomendasi baru yang memerlukan ulasan survei dari Anda.</p>
            </div>
          </div>

        @else
          <form wire:submit.prevent="submit">
            <div class="mb-4">
              <label for="permohonanId" class="form-label fw-semibold">Pilih Permohonan yang Disurvei <span class="text-danger">*</span></label>
              <select id="permohonanId" wire:model="permohonanId" class="form-select border-2 @error('permohonanId') is-invalid @enderror">
                <option value="">-- Pilih permohonan --</option>
                @foreach ($permohonanList as $item)
                  <option value="{{ $item->id }}">
                    {{ $item->judul }} — {{ $item->layanan?->nama_layanan ?? 'Layanan' }}
                  </option>
                @endforeach
              </select>
              @error('permohonanId') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
            </div>

            <!-- Bagian Iframe Survei Kesbangpol -->
            <div class="mb-5">
              <h5 class="fw-bold text-primary mb-3"><i class="fas fa-clipboard-list me-2"></i>1. Survei Kesbangpol</h5>
              <div class="border rounded bg-light p-2">
                 <iframe src="https://appbagor.surakarta.go.id/sop/skm/instrumen/isi/48" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>

            <!-- Bagian Iframe Survei BRIDA -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3"><i class="fas fa-clipboard-list me-2"></i>2. Survei BRIDA</h5>
              <div class="border rounded bg-light p-2">
                 <iframe src="https://appbagor.surakarta.go.id/sop/skm/instrumen/isi/61"  width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>

            <!-- Kotak Konfirmasi (Pengganti pengecekan sistem) -->
            <div class="card bg-warning bg-opacity-10 border-warning border-2 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="form-check">
                        <input class="form-check-input @error('konfirmasiSurvei') is-invalid @enderror" type="checkbox" wire:model="konfirmasiSurvei" id="konfirmasiSurvei" style="width: 1.5em; height: 1.5em;">
                        <label class="form-check-label ms-2 pt-1 fw-bold" for="konfirmasiSurvei">
                            Saya menyatakan dengan jujur bahwa saya telah menyelesaikan dan menekan tombol kirim pada KEDUA survei di atas (Kesbangpol & BRIDA).
                        </label>
                    </div>
                    @error('konfirmasiSurvei') <div class="text-danger fw-bold mt-2"><i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
              <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit"><i class="fas fa-unlock me-2"></i> Konfirmasi</span>
                <span wire:loading wire:target="submit"><i class="fas fa-spinner fa-spin me-2"></i> Memproses...</span>
              </button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>