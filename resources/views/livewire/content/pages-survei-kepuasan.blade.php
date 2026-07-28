@section('title', 'Survei Kepuasan Masyarakat')

<div class="row justify-content-center">
  <div class="col-lg-9">
    <div class="card card-dash border-0">
      <div class="card-body p-4 p-md-5">
        <div class="mb-4">
          <h4 class="mb-1">Survei Kepuasan Masyarakat</h4>
          <p class="mb-0 text-body-secondary">
            Masukan Anda membantu kami meningkatkan kualitas layanan BRIDA Kota Surakarta.
          </p>
        </div>

        @if (session('success'))
          <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @if ($permohonan->isEmpty())
          <div class="alert alert-info mb-0">
            Belum ada permohonan yang dapat dipilih untuk diisi surveinya.
          </div>
        @else
          <form wire:submit="submit">
            <div class="mb-4">
              <label for="permohonanId" class="form-label fw-semibold">Permohonan</label>
              <select id="permohonanId" wire:model="permohonanId" class="form-select @error('permohonanId') is-invalid @enderror">
                <option value="">Pilih permohonan</option>
                @foreach ($permohonan as $item)
                  <option value="{{ $item->id }}">
                    {{ $item->judul }} — {{ $item->layanan?->nama_layanan ?? 'Layanan' }}
                  </option>
                @endforeach
              </select>
              @error('permohonanId') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <fieldset class="mb-4">
              <legend class="fs-6 fw-semibold mb-2">Bagaimana penilaian Anda terhadap layanan kami?</legend>
              <p class="text-body-secondary small">Pilih satu nilai yang paling sesuai.</p>
              @foreach ([4 => 'Sangat Puas', 3 => 'Puas', 2 => 'Kurang Puas', 1 => 'Tidak Puas'] as $value => $label)
                <div class="form-check mb-2">
                  <input class="form-check-input @error('nilai') is-invalid @enderror" type="radio" wire:model="nilai" value="{{ $value }}" id="nilai{{ $value }}">
                  <label class="form-check-label" for="nilai{{ $value }}">{{ $label }}</label>
                </div>
              @endforeach
              @error('nilai') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </fieldset>

            <div class="mb-4">
              <label for="ulasan" class="form-label fw-semibold">Saran atau ulasan <span class="text-body-secondary fw-normal">(opsional)</span></label>
              <textarea id="ulasan" wire:model="ulasan" rows="5" maxlength="2000" class="form-control @error('ulasan') is-invalid @enderror" placeholder="Tuliskan saran Anda untuk peningkatan layanan."></textarea>
              @error('ulasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Kirim Survei</span>
                <span wire:loading wire:target="submit">Mengirim...</span>
              </button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
