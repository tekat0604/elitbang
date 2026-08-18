<div>
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Diri Penandatangan masing masing Instansi</h6>
            </div>
            <div class="card-body">
                
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>Instansi</th>
                                <th>Nama Kepala Instansi</th>
                                <th>NIP</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataInstansi as $item)
                                <tr>
                                    <td>{{ strtoupper($item->instansi) }}</td>
                                    <td>{{ $item->nama_kepala_instansi }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td class="text-center">
                                        <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-primary">
                                            Edit Data
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data instansi. Jalankan Seeder terlebih dahulu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Livewire Modal Form untuk Edit Data -->
    @if($isModalOpen)
    <div class="modal fade show" tabindex="-1" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data {{ strtoupper($instansi_name) }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kepala_instansi" class="form-label">Nama Kepala Instansi</label>
                            <input type="text" class="form-control @error('nama_kepala_instansi') is-invalid @enderror" 
                                   id="nama_kepala_instansi" wire:model="nama_kepala_instansi" placeholder="Masukkan Nama">
                            @error('nama_kepala_instansi') 
                                <span class="invalid-feedback">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                   id="nip" wire:model="nip" placeholder="Masukkan NIP">
                            @error('nip') 
                                <span class="invalid-feedback">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>