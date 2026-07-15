<div class="card card-dash p-4 p-md-5">
    <div class="mb-4 text-center">
      <h4 class="mb-2">Form Data Pemohon</h4>
      <p class="text-muted mb-0">Isi data pemohon untuk kelengkapan pendaftaran.</p>
    </div>

    <form wire:submit.prevent="uploadDokumenDataDiri">
      <div class="row gy-4">
        <div class="col--md-6 form-control-validation">
          <label class="form-label">Nama lengkap</label>
          <input type="text" wire:model="nama_lengkap" class="form-control" placeholder="Silakan isi nama lengkap anda" />
          @error('nama_lengkap') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Nomor Identitas</label>
          <input type="text" wire:model="nomor_identitas" class="form-control" placeholder="Masukkan nomor identitas" />
          @error('nomor_identitas') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" wire:model="tanggal_lahir" class="form-control" />
          @error('tanggal_lahir') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">No HP</label>
          <input type="text" wire:model="no_hp" class="form-control" placeholder="08xx xxxx xxxx" />
          @error('no_hp') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Email</label>
          <input type="email" wire:model="email" class="form-control" placeholder="Masukan email anda" readonly />
          @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Kewarganegaraan</label>
          <input type="text" wire:model="kewarganegaraan" class="form-control" placeholder="Indonesia" />
          @error('kewarganegaraan') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Provinsi</label>
          <input type="text" wire:model="provinsi" class="form-control" placeholder="Masukkan provinsi" />
          @error('provinsi') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Kabupaten / Kota</label>
          <input type="text" wire:model="kota_kabupaten" class="form-control" placeholder="Masukkan kabupaten atau kota" />
          @error('kota_kabupaten') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Kecamatan</label>
          <input type="text" wire:model="kecamatan" class="form-control" placeholder="Masukkan kecamatan" />
          @error('kecamatan') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Kelurahan / Desa</label>
          <input type="text" wire:model="kelurahan_desa" class="form-control" placeholder="Masukkan kelurahan atau desa" />
          @error('kelurahan_desa') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col-12 form-control-validation">
          <label class="form-label">Alamat Lengkap</label>
          <textarea wire:model="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
          @error('alamat') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col--md-6 form-control-validation">
          <label class="form-label">Jenis Identitas</label>
          <select wire:model="jenis_identitas" class="form-select">
            <option value="">Pilih jenis identitas</option>
            <option value="ktp">KTP</option>
            <option value="ktm">KTM</option>
            <option value="passport">Paspor</option>
            <option value="sim">SIM</option>
          </select>
          @error('jenis_identitas') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col-12 form-control-validation">
          <label class="form-label">Foto Identitas (KTP/KTM)</label>
          <input type="file" wire:model="path_identitas" class="form-control" accept="image/*" />

          @if ($path_identitas)
            <img src="{{ $path_identitas->temporaryUrl() }}" class="mt-2 rounded" style="max-height: 150px;">
          @endif

          @error('path_identitas') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="mt-4 d-flex flex-wrap gap-2">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
          <span wire:loading.remove>Simpan</span>
          <span wire:loading>Memproses...</span>
        </button>
      </div>
    </form>
  </div>