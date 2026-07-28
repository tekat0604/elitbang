@section('title', 'Survei Kepuasan Masyarakat')

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
            <a href="{{ route('permohonan') }}" class="btn btn-success px-4 py-2 fw-semibold shadow-sm">
              <i class="fas fa-file-alt me-2"></i> Buka Daftar Permohonan & Unduh Surat
            </a>
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

            <fieldset class="mb-4">
              <legend class="fs-6 fw-semibold mb-2">Bagaimana penilaian Anda terhadap layanan kami? <span class="text-danger">*</span></legend>
              <p class="text-body-secondary small mb-3">Pilih satu nilai yang paling sesuai dengan pengalaman Anda selama mengurus perizinan.</p>
              
              <div class="row g-2">
                @foreach ([4 => 'Sangat Puas', 3 => 'Puas', 2 => 'Kurang Puas', 1 => 'Tidak Puas'] as $value => $label)
                  <div class="col-6 col-md-3">
                    <input class="btn-check @error('nilai') is-invalid @enderror" type="radio" wire:model="nilai" value="{{ $value }}" id="nilai{{ $value }}" autocomplete="off">
                    <label class="btn btn-outline-primary w-100 py-2 shadow-sm" for="nilai{{ $value }}">{{ $label }}</label>
                  </div>
                @endforeach
              </div>
              @error('nilai') <div class="text-danger small fw-bold mt-2">{{ $message }}</div> @enderror
            </fieldset>

            <div class="mb-4">
              <label for="ulasan" class="form-label fw-semibold">Saran atau ulasan <span class="text-body-secondary fw-normal">(opsional)</span></label>
              <textarea id="ulasan" wire:model="ulasan" rows="4" maxlength="2000" class="form-control border-2 shadow-sm @error('ulasan') is-invalid @enderror" placeholder="Tuliskan saran atau masukan Anda untuk peningkatan layanan..."></textarea>
              @error('ulasan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
              <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit"><i class="fas fa-paper-plane me-2"></i> Kirim Survei</span>
                <span wire:loading wire:target="submit"><i class="fas fa-spinner fa-spin me-2"></i> Mengirim...</span>
              </button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>