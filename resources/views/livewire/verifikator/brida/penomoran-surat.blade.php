<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-dash border-0 shadow-sm">
        <div class="card-header bg-white border-bottom p-4">
            <h5 class="mb-0 fw-bold">Daftar Penerbitan Surat</h5>
            <p class="small text-muted mb-0">Silakan memasukkan nomor surat, lalu lakukan penerbitan surat rekomendasi</p>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">Tgl ACC</th>
                            <th>Nama Pemohon</th>
                            <th>Judul Penelitian</th>
                            <th>Nomor Surat</th>
                            <th>Tgl Terbit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($antrean as $item)
                            <tr>
                                <td class="px-4">{{ $item->updated_at->format('d M Y') }}</td>
                                <td class="fw-semibold">{{ $item->pemohon->nama_lengkap ?? '-' }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $item->judul }}">
                                        {{ $item->judul }}
                                    </div>
                                </td>
                                
                                <!-- KOLOM NOMOR SURAT -->
                                <td>
                                    @if(!$item->suratIzin)
                                        <button type="button" wire:click="pilihPermohonan({{ $item->id }})" class="btn btn-sm btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalPenomoran">
                                            <i class="fas fa-edit me-1"></i> Masukkan Nomor
                                        </button>
                                    @else
                                        <span class="fw-bold text-primary">{{ $item->suratIzin->nomor_surat }}</span>
                                        
                                        @if(empty($item->suratIzin->file_path))
                                            <button type="button" wire:click="pilihPermohonan({{ $item->id }})" class="btn btn-sm btn-link text-warning p-0 ms-2" data-bs-toggle="modal" data-bs-target="#modalPenomoran" title="Edit Nomor">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        @endif
                                    @endif
                                </td>

                                <!-- KOLOM TANGGAL TERBIT -->
                                <td>
                                    @if(!empty($item->suratIzin->file_path))
                                        {{ $item->suratIzin->updated_at->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <!-- KOLOM AKSI DINAMIS -->
                                <td class="text-center">
                                    @if(!$item->suratIzin)
                                        <button class="btn btn-sm btn-secondary fw-bold" disabled>
                                            <i class="fas fa-ban me-1"></i> Terbitkan
                                        </button>
                                    @elseif(empty($item->suratIzin->file_path))
                                        <button type="button" 
                                            wire:click="terbitkanSurat({{ $item->id }})" 
                                            wire:confirm="Apakah anda telah yakin?\n\nSetelah PDF diterbitkan, nomor surat '{{ $item->suratIzin->nomor_surat }}' akan dikunci permanen dan tidak bisa diubah lagi!" 
                                            class="btn btn-sm btn-success fw-bold" 
                                            wire:loading.attr="disabled">
                                            <i class="fas fa-paper-plane me-1"></i> Terbitkan
                                        </button>
                                    @else
                                        <a href="{{ route('preview-surat', $item->suratIzin->qr_code_link) }}" target="_blank" class="btn btn-sm btn-outline-danger fw-bold">
                                            <i class="fas fa-file-pdf me-1"></i> Buka PDF
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada permohonan yang disetujui.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Penomoran -->
    <div wire:ignore.self class="modal fade" id="modalPenomoran" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Input/Edit Nomor Surat Izin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="$set('nomor_surat', '')"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="simpanNomor">
                        <div class="mb-4">
                            <label class="form-label text-muted small">Nomor Agenda Surat</label>
                            <input type="text" wire:model="nomor_surat" class="form-control form-control-lg @error('nomor_surat') is-invalid @enderror" placeholder="Contoh: 000.9.2/123.PM/VI/2026">
                            @error('nomor_surat') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold" wire:loading.attr="disabled">
                                <span wire:loading.remove>Simpan Nomor Surat</span>
                                <span wire:loading>Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('close-modal', (event) => {
                var modalElement = document.getElementById('modalPenomoran');
                var modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });
        });
    </script>
</div>