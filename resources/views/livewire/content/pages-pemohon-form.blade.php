<div class="card card-dash p-4 p-md-5">
  <div class="mb-4 text-center">
    <h4 class="mb-2">Form Data Pemohon</h4>
    <p class="text-muted mb-0">Isi data pemohon untuk kelengkapan pendaftaran.</p>
  </div>

  <form wire:submit.prevent="uploadDokumenDataDiri">
    <div class="row gy-4">
      <div class="col--md-6 form-control-validation">
        <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
        <input type="text" wire:model="nama_lengkap" class="form-control"
          placeholder="Silakan isi nama lengkap anda" />
        @error('nama_lengkap')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Nomor Identitas (NIK, NIM, No.Paspor, No.SIM)<span class="text-danger">*</span></label>
        <input type="text" wire:model="nomor_identitas" class="form-control"
          placeholder="Masukkan nomor identitas" />
        @error('nomor_identitas')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
        <input type="date" wire:model="tanggal_lahir" class="form-control" />
        @error('tanggal_lahir')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">No HP<span class="text-danger">*</span></label>
        <input type="text" wire:model="no_hp" class="form-control" placeholder="08xx xxxx xxxx" />
        @error('no_hp')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Email<span class="text-danger">*</span></label>
        <input type="email" wire:model="email" class="form-control" placeholder="Masukan email anda" readonly />
        @error('email')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Kewarganegaraan<span class="text-danger">*</span></label>
        <input type="text" wire:model="kewarganegaraan" class="form-control" placeholder="Indonesia" />
        @error('kewarganegaraan')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Provinsi<span class="text-danger">*</span></label>
        <select wire:model.live="provinsi" class="form-select">
          <option value="">Pilih provinsi</option>
          @foreach ($provinces as $code => $name)
            <option value="{{ $name }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('provinsi')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Kabupaten / Kota<span class="text-danger">*</span></label>
        <select wire:model.live="kota_kabupaten" class="form-select" @disabled(!$provinsi)>
          <option value="">Pilih kabupaten/kota</option>
          @foreach ($regencies as $code => $name)
            <option value="{{ $name }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('kota_kabupaten')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Kecamatan<span class="text-danger">*</span></label>
        <select wire:model.live="kecamatan" class="form-select" @disabled(!$kota_kabupaten)>
          <option value="">Pilih kecamatan</option>
          @foreach ($districts as $code => $name)
            <option value="{{ $name }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('kecamatan')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Kelurahan / Desa<span class="text-danger">*</span></label>
        <select wire:model="kelurahan_desa" class="form-select" @disabled(!$kecamatan)>
          <option value="">Pilih kelurahan/desa</option>
          @foreach ($villages as $code => $name)
            <option value="{{ $name }}">{{ $name }}</option>
          @endforeach
        </select>
        @error('kelurahan_desa')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col-12 form-control-validation">
        <label class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
        <textarea wire:model="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
        @error('alamat')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col--md-6 form-control-validation">
        <label class="form-label">Jenis Identitas<span class="text-danger">*</span></label>
        <select wire:model="jenis_identitas" class="form-select">
          <option value="">Pilih jenis identitas</option>
          <option value="ktp">KTP</option>
          <option value="ktm">KTM</option>
          <option value="passport">Paspor</option>
          <option value="sim">SIM</option>
        </select>
        @error('jenis_identitas')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>

      <div class="col-12 form-control-validation">
        <label class="form-label">
            Foto Identitas 
            @if($existing_path_identitas) 
                <span class="text-primary">(Opsional - Kosongkan jika tidak ingin diubah)</span> 
            @else
                <span class="text-danger">*</span>
            @endif
        </label>
        
        @if($existing_path_identitas)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $existing_path_identitas) }}" alt="Identitas Lama" class="img-thumbnail" style="max-height: 150px; border-radius: 8px;">
            </div>
        @endif
        
        <input type="file" 
          wire:model="path_identitas" 
          class="form-control" 
          accept=".jpg,.jpeg" 
          onchange="if(this.files[0] && this.files[0].size > 1048576) { 
            alert('TIDAK BISA MENGUNGGAH: Ukuran gambar melebihi 1 MB! Silakan kompres gambar Anda terlebih dahulu.'); 
            this.value = ''; 
            }"
        />

        @error('path_identitas')
          <span class="text-danger small">{{ $message }}</span>
        @enderror
      </div>
    </div>


      <div class="mt-4 d-flex flex-wrap gap-2">
      <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="uploadDokumenDataDiri">
        <span wire:loading.remove wire:target="uploadDokumenDataDiri">Simpan</span>
        <span wire:loading wire:target="uploadDokumenDataDiri">Memproses...</span>
      </button>
    </div>
    </form>
  </div>
