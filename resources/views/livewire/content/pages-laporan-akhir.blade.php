<div>
    <!-- Header & Action Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Laporan Akhir Penelitian</h4>
            <p class="text-body-secondary mb-0">Pantau status verifikasi dan unggah dokumen laporan akhir Anda di sini.</p>
        </div>
        <div>
            @if ($permohonanList->isNotEmpty())
                <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalLaporan" wire:click="batalRevisi">
                    <i class="fas fa-plus me-1"></i> Tambah Laporan
                </button>
            @endif
        </div>
    </div>

    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
            <i class="fas fa-check-circle fa-lg me-3"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert Blokir: Wajib Survei -->
    @if ($perluSurvei)
        <div class="alert alert-warning d-flex align-items-center shadow-sm mb-4" role="alert">
            <i class="fas fa-clipboard-list fa-2x me-3"></i>
            <div>
                <div class="fw-bold">Survei Kepuasan Belum Diisi!</div>
                <div class="small">Sistem mendeteksi ada penelitian yang telah selesai. Silakan isi survei kepuasan terlebih dahulu sebelum tombol unggah laporan diaktifkan.</div>
            </div>
            <a href="{{ route('survei-kepuasan') }}" class="btn btn-warning ms-auto text-nowrap fw-bold shadow-sm">Isi Survei</a>
        </div>
    @endif

    <!-- Alert Info: Menunggu Surat Final -->
    @if ($menungguSurat)
        <div class="alert alert-info d-flex align-items-center shadow-sm mb-4" role="alert">
            <i class="fas fa-hourglass-half fa-2x me-3"></i>
            <div>
                <div class="fw-bold">Menunggu Penerbitan Surat</div>
                <div class="small">Permohonan Anda telah disetujui, namun dokumen Surat Izin masih dalam proses penandatanganan elektronik oleh Pejabat berwenang.</div>
            </div>
        </div>
    @endif

    <!-- Tabel Daftar Laporan -->
    <div class="card card-dash border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No.</th>
                            <th>Judul Pengajuan</th>
                            <th>Tanggal Upload</th>
                            <th>Link Laporan</th>
                            <th>Status BRIDA</th>
                            <th>Surat Ket. Selesai</th>
                            <th class="text-center px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanList as $laporan)
                            <tr>
                                <td class="px-4">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 250px;" title="{{ $laporan->permohonan->judul }}">
                                        {{ $laporan->permohonan->judul }}
                                    </div>
                                    <small class="text-muted">{{ $laporan->permohonan->layanan?->nama_layanan ?? '-' }}</small>
                                </td>
                                <td>{{ $laporan->tanggal_upload?->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td>
                                    <a href="{{ $laporan->file_laporan }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-1"></i> Buka Drive
                                    </a>
                                </td>
                                <td>
                                    <span class="badge {{ $laporan->status_laporan === 'disetujui' ? 'bg-success' : ($laporan->status_laporan === 'revisi' ? 'bg-danger' : 'bg-warning text-dark') }} px-2 py-1">
                                      {{ str($laporan->status_laporan)->title() }}
                                    </span>
                                    @if($laporan->catatan_revisi)
                                        <div class="small text-danger mt-1 fst-italic">"{{ $laporan->catatan_revisi }}"</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($laporan->file_surat_selesai)
                                        <a href="{{ $laporan->file_surat_selesai }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success fw-bold">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    @else
                                        <span class="text-body-secondary small">-</span>
                                    @endif
                                </td>
                                <td class="text-center px-4">
                                    @if ($laporan->status_laporan === 'revisi')
                                        <button type="button" wire:click="revisi({{ $laporan->id }})" class="btn btn-sm btn-warning fw-bold shadow-sm">
                                            <i class="fas fa-edit me-1"></i> Revisi
                                        </button>
                                    @else
                                        <span class="text-body-secondary">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-body-secondary">Belum ada laporan akhir yang diunggah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Laporan Akhir -->
    <div wire:ignore.self class="modal fade" id="modalLaporan" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-bottom-0 pb-3">
                    <h5 class="modal-title fw-bold">{{ $laporanId ? 'Revisi Laporan Akhir' : 'Unggah Laporan Akhir' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="batalRevisi"></button>
                </div>
                <form wire:submit.prevent="submit">
                    <div class="modal-body pt-3">
                        @if ($laporanId)
                            <div class="alert alert-warning d-flex align-items-center p-3 mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                <div>Anda sedang mengunggah ulang dokumen laporan yang sebelumnya diminta untuk direvisi oleh pihak BRIDA.</div>
                            </div>
                        @else
                            <div class="alert alert-info d-flex align-items-center p-3 mb-4" role="alert">
                                <i class="fas fa-info-circle fa-2x me-3"></i>
                                <div>Pastikan dokumen pada Google Drive Anda telah disetting <strong>"Anyone with the link / Siapa saja yang memiliki tautan"</strong> dapat melihat.</div>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="permohonanId" class="form-label fw-semibold">Pilih Permohonan Penelitian</label>
                            <select wire:model="permohonanId" id="permohonanId" class="form-select form-select-lg @error('permohonanId') is-invalid @enderror" @disabled($laporanId)>
                                <option value="">-- Silakan pilih penelitian --</option>
                                @foreach ($permohonanList as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                                @if ($laporanId)
                                    @php($laporanRevisi = $laporanList->firstWhere('id', $laporanId))
                                    @if ($laporanRevisi)
                                        <option value="{{ $laporanRevisi->permohonan_id }}">{{ $laporanRevisi->permohonan->judul }}</option>
                                    @endif
                                @endif
                            </select>
                            @error('permohonanId') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="linkDokumen" class="form-label fw-semibold">Link Dokumen (G-Drive)</label>
                            <input wire:model="linkDokumen" type="url" id="linkDokumen" class="form-control form-control-lg @error('linkDokumen') is-invalid @enderror" placeholder="https://drive.google.com/file/d/...">
                            @error('linkDokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="batalRevisi">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold" wire:loading.attr="disabled">
                            <span wire:loading.remove><i class="fas fa-paper-plane me-1"></i> {{ $laporanId ? 'Kirim Revisi' : 'Kirim Laporan' }}</span>
                            <span wire:loading><i class="fas fa-spinner fa-spin me-1"></i> Mengirim...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Listener untuk Membuka/Menutup Modal dari Livewire -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('close-modal-laporan', () => {
                let modalInstance = bootstrap.Modal.getInstance(document.getElementById('modalLaporan'));
                if (modalInstance) modalInstance.hide();
            });

            @this.on('open-modal-laporan', () => {
                let modalElement = document.getElementById('modalLaporan');
                let modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                modalInstance.show();
            });
        });
    </script>
</div>