<div>
    <!-- Header & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Pengguna</h4>
        <button wire:click="openModal" class="btn btn-primary">
            Tambah Pengguna
        </button>
    </div>

    <!-- Alert Notifikasi -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive border rounded-3 overflow-hidden shadow-sm">
        <table class="table table-bordered table-hover mb-0">
            <thead class="bg-secondary text-white">
                <!-- Header Judul Kolom -->
                <tr>
                    <th class="text-white">Nama</th>
                    <th class="text-white">Email</th>
                    <th class="text-white">Role</th>
                    <th class="text-white">Instansi</th>
                    <th class="text-white text-center">Aksi</th>
                </tr>
                <!-- Header Form Filter -->
                <tr>
                    <th>
                        <input type="text" wire:model.live="searchNama" class="form-control form-control-sm text-black bg-white" placeholder="Cari nama...">
                    </th>
                    <th>
                        <input type="text" wire:model.live="searchEmail" class="form-control form-control-sm text-black bg-white" placeholder="Cari email...">
                    </th>
                    <th>
                        <select wire:model.live="searchRole" class="form-select form-select-sm bg-white">
                            <option value="">Semua Role</option>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="verifikator">Verifikator</option>
                            <option value="tanda_tangan">Tanda Tangan</option>
                            <option value="user">User</option>
                        </select>
                    </th>
                    <th>
                        <select wire:model.live="searchInstansi" class="form-select form-select-sm bg-white">
                            <option value="">Semua Instansi</option>
                            <option value="brida">Brida</option>
                            <option value="kesbangpol">Kesbangpol</option>
                        </select>
                    </th>
                    <th>
                        <!-- Kosong untuk kolom aksi -->
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-dark">{{ strtoupper($user->role) }}</span>
                    </td>
                    <td>{{ $user->instansi ? strtoupper($user->instansi) : '-' }}</td>
                    <td class="text-center">
                        <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-primary">Edit</button>
                        <button wire:click="delete({{ $user->id }})" wire:confirm="Apakah anda yakin ingin menghapus data pengguna ini?" class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Data pengguna tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginasi bawaan Livewire -->
    <div class="mt-3">
        {{ $users->links() }}
    </div>

    <!-- Modal Form Tambah/Edit -->
    @if($isModalOpen)
    <div class="modal fade show" tabindex="-1" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-white">
                    <h5 class="modal-title">{{ $isEditMode ? 'Edit Pengguna' : 'Tambah Pengguna' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <!-- Menentukan fungsi yang dipanggil saat submit (update atau store) -->
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role</label>
                            <select wire:model="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="">Pilih Role</option>
                                <option value="super_admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="verifikator">Verifikator</option>
                                <option value="tanda_tangan">Tanda Tangan</option>
                                <option value="user">User</option>
                            </select>
                            @error('role') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Instansi <small class="text-muted">(Opsional)</small></label>
                            <select wire:model="instansi" class="form-select @error('instansi') is-invalid @enderror">
                                <option value="">Tanpa Instansi / Pilih Instansi</option>
                                <option value="brida">Brida</option>
                                <option value="kesbangpol">Kesbangpol</option>
                            </select>
                            @error('instansi') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ $isEditMode ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password' }}">
                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>