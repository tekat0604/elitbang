<div>
  <!-- Alert Notifikasi -->
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

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
                <td class="text-center">
                    <!-- Ubah tombol ini agar memanggil fungsi openModal Livewire -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiTandaTangan" wire:click="openModal({{ $item->id }})">
                        Tanda Tangan <i class="fas fa-pen-nib ms-1"></i>
                    </button>
                </td>
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

  <div wire:ignore.self class="modal fade" id="modalKonfirmasiTandaTangan" tabindex="-1" aria-labelledby="modalKonfirmasiTandaTanganLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalKonfirmasiTandaTanganLabel"><i class="fas fa-shield-alt me-2"></i>Konfirmasi Tanda Tangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p class="mb-3">Masukkan password akun Anda untuk melanjutkan proses tanda tangan elektronik.</p>
          <label for="password-tanda-tangan" class="form-label fw-semibold">Password</label>
          <!-- Tambahkan wire:model di sini -->
          <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password-tanda-tangan" placeholder="Masukkan password" autocomplete="current-password">
          @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
          <div class="form-text">Password akan diverifikasi saat proses tanda tangan diaktifkan.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
          <!-- Tambahkan wire:click dan efek loading -->
          <button type="button" class="btn btn-primary" wire:click="prosesTandaTangan" wire:loading.attr="disabled">
              <span wire:loading.remove><i class="fas fa-pen-nib me-1"></i>Lanjutkan Tanda Tangan</span>
              <span wire:loading>Memproses PDF...</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script untuk menutup modal secara otomatis jika berhasil -->
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('close-modal-tanda-tangan', (event) => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalKonfirmasiTandaTangan'));
            if(modal) {
                modal.hide();
            }
        });
    });
</script>