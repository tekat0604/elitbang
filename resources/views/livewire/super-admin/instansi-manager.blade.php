<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-dash border-0 shadow-sm">
        <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 fw-bold">Daftar Instansi & Lokasi</h5>
                <p class="mb-0 text-body-secondary small">Kelola data seluruh Organisasi Perangkat Daerah (OPD) dan UPTD.</p>
            </div>
            <button type="button" class="btn btn-primary fw-bold" wire:click="tambahBaru">
                <i class="fas fa-plus me-1"></i> Tambah Instansi
            </button>
        </div>

        <div class="card-body p-4">
            
            <!-- TOGGLE FILTER (OPD / UPTD) -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div class="btn-group" role="group">
                    <button type="button" wire:click="$set('viewMode', 'opd')" class="btn {{ $viewMode === 'opd' ? 'btn-primary' : 'btn-outline-primary' }} fw-semibold">
                        <i class="fas fa-building me-1"></i> Data OPD Induk
                    </button>
                    <button type="button" wire:click="$set('viewMode', 'uptd')" class="btn {{ $viewMode === 'uptd' ? 'btn-primary' : 'btn-outline-primary' }} fw-semibold">
                        <i class="fas fa-map-marker-alt me-1"></i> Data UPTD
                    </button>
                </div>

                <!-- FILTER KOLOM SESUAI TAMPILAN -->
                <div>
                    @if ($viewMode === 'opd')
                        <select wire:model.live="filterKategori" class="form-select border-primary shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriList as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    @else
                        <select wire:model.live="filterOpd" class="form-select border-primary shadow-sm">
                            <option value="">Semua OPD Induk</option>
                            @foreach ($opdList as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <!-- TABEL VIEW OPD -->
            @if ($viewMode === 'opd')
            <div class="table-responsive border rounded">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th>Nama OPD</th>
                            <th>Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarOpd as $opd)
                            <tr>
                                <td class="px-4">{{ $daftarOpd->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold text-primary">{{ $opd->nama_opd ?? '-' }}</td>
                                <td><span class="badge bg-secondary">{{ $opd->kategori?->kategori ?? '-' }}</span></td>
                                <td class="text-center">
                                    <button wire:click="editOpd({{ $opd->id }})" class="btn btn-sm btn-outline-info me-1"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="if(confirm('Apakah anda yakin ingin menghapus? Jika anda menghapus maka UPTD yang mempunyai OPD ini juga akan terhapus. Lakukan pengeditan jika tidak ingin terhapus.')) { @this.hapusOpd({{ $opd->id }}) }" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-body-secondary">Belum ada data OPD.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $daftarOpd->links() }}</div>

            <!-- TABEL VIEW UPTD -->
            @else
            <div class="table-responsive border rounded">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th>Nama UPTD / Cabang</th>
                            <th>Bernaung di OPD Induk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarUptd as $uptd)
                            <tr>
                                <td class="px-4">{{ $daftarUptd->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold text-primary">{{ $uptd->nama ?? '-' }}</td>
                                <td>{{ $uptd->opd?->nama_opd ?? '-' }}</td>
                                <td class="text-center">
                                    <button wire:click="editUptd({{ $uptd->id }})" class="btn btn-sm btn-outline-info me-1"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="if(confirm('Yakin ingin menghapus data UPTD ini?')) { @this.hapusUptd({{ $uptd->id }}) }" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-body-secondary">Belum ada data UPTD.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $daftarUptd->links() }}</div>
            @endif
        </div>
    </div>

    <!-- MODAL FORM (Digunakan Bersama untuk Tambah & Edit) -->
    <div wire:ignore.self class="modal fade" id="modalFormInstansi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form wire:submit="simpanInstansi">
                    <div class="modal-header bg-white border-bottom-0">
                        <h1 class="modal-title fs-5 fw-bold">{{ $is_edit ? 'Edit Data Instansi' : 'Tambah Data Instansi' }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body p-4">
                        
                        <!-- JIKA MODE TAMBAH, TAMPILKAN PILIHAN TIPE. JIKA EDIT, SEMBUNYIKAN/KUNCI -->
                        @if (!$is_edit)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tipe Instansi</label>
                                <select wire:model.live="jenis_instansi" class="form-select @error('jenis_instansi') is-invalid @enderror">
                                    <option value="opd">OPD Induk</option>
                                    <option value="uptd">UPTD / Cabang Lokasi</option>
                                </select>
                            </div>
                        @else
                            <div class="alert alert-info py-2 mb-3">
                                <i class="fas fa-info-circle me-1"></i> Mode Edit untuk <strong>{{ $jenis_instansi === 'opd' ? 'OPD Induk' : 'UPTD / Cabang' }}</strong>.
                            </div>
                        @endif

                        <!-- INPUT OPD -->
                        @if ($jenis_instansi === 'opd')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kategori OPD</label>
                                <select wire:model.live="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoriList as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endforeach
                                    <!-- Opsi Khusus Tambah Kategori (Sembunyikan saat mode edit jika mau, atau biarkan tetap ada) -->
                                    <option value="baru" class="fw-bold text-primary">+ Tambah Kategori Baru...</option>
                                </select>
                                @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            @if ($kategori_id === 'baru')
                                <div class="mb-3 p-3 bg-primary bg-opacity-10 border border-primary rounded">
                                    <label class="form-label fw-semibold text-primary">Nama Kategori Baru</label>
                                    <input type="text" wire:model="nama_kategori_baru" class="form-control border-primary @error('nama_kategori_baru') is-invalid @enderror">
                                    @error('nama_kategori_baru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            @endif
                        @endif

                        <!-- INPUT UPTD -->
                        @if ($jenis_instansi === 'uptd')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bernaung di OPD (Induk)</label>
                                <select wire:model="opd_id" class="form-select @error('opd_id') is-invalid @enderror">
                                    <option value="">Pilih OPD Induk</option>
                                    @foreach ($opdList as $opd)
                                        <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                    @endforeach
                                </select>
                                @error('opd_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        <!-- INPUT NAMA (Sama untuk keduanya) -->
                        <div class="mb-0">
                            <label class="form-label fw-semibold">Nama Instansi / Lokasi</label>
                            <input type="text" wire:model="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror">
                            @error('nama_instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-top-0 bg-white">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary fw-bold" wire:loading.attr="disabled">
                            <span wire:loading.remove><i class="fas fa-save me-1"></i> Simpan</span>
                            <span wire:loading><i class="fas fa-spinner fa-spin me-1"></i> Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $wire.on('buka-modal-instansi', () => {
        new bootstrap.Modal(document.getElementById('modalFormInstansi')).show();
    });

    $wire.on('tutup-modal-instansi', () => {
        let modalEl = document.getElementById('modalFormInstansi');
        let modal = bootstrap.Modal.getInstance(modalEl);
        if(modal) { modal.hide(); }
    });
</script>
@endscript