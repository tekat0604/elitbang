<div class="card card-dash border-0 shadow-sm">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold">Formulir Pengajuan {{ $nama_layanan_terpilih }}</h5>
        
        <div class="d-flex justify-content-between mt-4 position-relative">
            <div class="progress position-absolute w-100" style="height: 4px; top: 15px; z-index: 1;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($currentStep - 1) * 50 }}%;"></div>
            </div>
            
            <div class="text-center position-relative" style="z-index: 2;">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 1 ? 'bg-primary' : 'bg-secondary' }}" style="width: 35px; height: 35px; margin: 0 auto;">1</div>
                <small class="mt-2 d-block fw-semibold">Informasi Dasar</small>
            </div>
            <div class="text-center position-relative" style="z-index: 2;">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 2 ? 'bg-primary' : 'bg-secondary' }}" style="width: 35px; height: 35px; margin: 0 auto;">2</div>
                <small class="mt-2 d-block fw-semibold">Pelaksanaan & Tim</small>
            </div>
            <div class="text-center position-relative" style="z-index: 2;">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white {{ $currentStep >= 3 ? 'bg-primary' : 'bg-secondary' }}" style="width: 35px; height: 35px; margin: 0 auto;">3</div>
                <small class="mt-2 d-block fw-semibold">Dokumen</small>
            </div>
        </div>
    </div>

    <div class="card-body p-4 p-md-5">
        <form wire:submit.prevent="submitForm">
            
            @if($currentStep == 1)
            <div class="row gy-4" wire:key="step-1">
                <div class="col-12"><h6 class="fw-bold text-primary border-bottom pb-2">Informasi Kegiatan</h6></div>
                
                <div class="col-12">
                    <label class="form-label">Judul Penelitian/Kegiatan<span class="text-danger">*</span></label>
                    <textarea wire:model="judul" class="form-control" rows="2" placeholder="Masukkan judul lengkap"></textarea>
                    @error('judul') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Jenjang Pendidikan<span class="text-danger">*</span></label>
                    <select wire:model="jenjang_pendidikan" class="form-select">
                        <option value="">Pilih Jenjang...</option>
                        <option value="SMA">SMA/Sederajat</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                    @error('jenjang_pendidikan') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Bidang Penelitian/Kegiatan<span class="text-danger">*</span></label>
                    
                    <select wire:model.live="bidang_penelitian" class="form-select">
                        <option value="">Pilih Bidang...</option>
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Pemerintahan">Pemerintahan</option>
                        <option value="Kependudukan">Kependudukan</option>
                        <option value="Pembangunan">Pembangunan</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Lingkungan Hidup">Lingkungan Hidup</option>
                        <option value="Budaya">Budaya</option>
                        <option value="Politik">Politik</option>
                    </select>
                    @error('bidang_penelitian') <span class="text-danger small">{{ $message }}</span> @enderror
                    
                </div>

                <div class="col-md-6">
                    <label class="form-label">Rumpun Penelitian/Kegiatan<span class="text-danger">*</span></label>
                    <select wire:model.live="rumpun_penelitian" class="form-select">
                        <option value="">Pilih Rumpun...</option>
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Budaya">Budaya</option>
                        <option value="Hukum">Hukum</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Pemerintah dan Politik">Pemerintah dan Politik</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Lingkungan Hidup">Lingkungan Hidup</option>
                        <option value="Teknik dan Pembangunan">Teknik dan Pembangunan</option>
                        <option value="Agama">Agama</option>
                        <option value="Kependudukan">Kependudukan</option>
                        <option value="Ketenagakerjaan">Ketenagakerjaan</option>
                        <option value="Digital dan Teknologi">Digital dan Teknologi</option>
                        <option value="Transportasi dan Perhubungan">Transportasi dan Perhubungan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('rumpun_penelitian') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Instansi/Universitas Asal<span class="text-danger">*</span></label>
                    <input type="text" wire:model="nama_instansi" class="form-control" placeholder="Nama Universitas / Instansi">
                    @error('nama_instansi') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12">
                    <label class="form-label">Alamat Instansi Asal<span class="text-danger">*</span></label>
                    <textarea wire:model="alamat_instansi" class="form-control" rows="2"></textarea>
                    @error('alamat_instansi') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif

            @if($currentStep == 2)
            <div class="row gy-4" wire:key="step-2">
                <div class="col-12"><h6 class="fw-bold text-primary border-bottom pb-2">Detail Pelaksanaan</h6></div>
                
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai<span class="text-danger">*</span></label>
                    <input type="date" wire:model="tgl_mulai" class="form-control">
                    @error('tgl_mulai') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai<span class="text-danger">*</span></label>
                    <input type="date" wire:model="tgl_selesai" class="form-control">
                    @error('tgl_selesai') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12 mt-4"><h6 class="fw-bold text-primary border-bottom pb-2">Tujuan Lokasi Penelitian<span class="text-danger">*</span></h6></div>
                
                <div class="col-md-4">
                    <label class="form-label">Kategori Lokasi<span class="text-danger">*</span></label>
                    <select wire:model.live="kategori_id" class="form-select border-primary">
                        <option value="">Pilih Kategori...</option>
                        @foreach($daftar_kategori as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Instansi Induk<span class="text-danger">*</span></label>
                    <select wire:model.live="opd_id" class="form-select border-primary" {{ empty($daftar_opd) ? 'disabled' : '' }}>
                        <option value="">Pilih Instansi Induk...</option>
                        @foreach($daftar_opd as $opd)
                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                        @endforeach
                    </select>
                    @error('opd_id') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Lokasi Penelitian/Kegiatan<span class="text-danger">*</span></label>
                    <select wire:model="opd_child_id" class="form-select border-primary" {{ empty($daftar_child) ? 'disabled' : '' }}>
                        <option value="">Pilih Lokasi...</option>
                        @foreach($daftar_child as $child)
                            <option value="{{ $child->id }}">{{ $child->nama }}</option>
                        @endforeach
                    </select>
                    @error('opd_child_id') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label mb-0">Nama Pembimbing<span class="text-danger">*</span></label>
                        <button type="button" wire:click="addPembimbing" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus me-1"></i> Tambah Pembimbing</button>
                    </div>
                    @foreach($pembimbing as $index => $p)
                        <div class="input-group mb-2" wire:key="pembimbing-{{ $index }}">
                            <input type="text" wire:model="pembimbing.{{ $index }}.nama_pembimbing" class="form-control" placeholder="Nama Pembimbing {{ $index + 1 }}">
                            @if($index > 0)
                                <button type="button" wire:click="removePembimbing({{ $index }})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            @endif
                        </div>
                        @error('pembimbing.'.$index.'.nama_pembimbing') <span class="text-danger small">{{ $message }}</span> @enderror
                    @endforeach
                </div>

                <div class="col-12 mt-4"><h6 class="fw-bold text-primary border-bottom pb-2">Kategori Pengajuan</h6></div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Pengajuan<span class="text-danger">*</span></label>
                    <select wire:model.live="jenis_pengajuan" class="form-select border-primary">
                        <option value="">Pilih Jenis Pengajuan...</option>
                        <option value="personal">Personal (Individu)</option>
                        <option value="kelompok">Kelompok (Memiliki Anggota)</option>
                    </select>
                    @error('jenis_pengajuan') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                @if($jenis_pengajuan === 'kelompok')
                <div class="col-12 bg-light p-3 rounded border mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">Daftar Anggota Kelompok (Selain Anda)<span class="text-danger">*</span></span>
                        <button type="button" wire:click="addAnggota" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Tambah Anggota</button>
                    </div>
                    
                    <!-- TAMBAHAN: Pesan error muncul jika pengguna nekat menghapus semua baris -->
                    @error('anggota') 
                        <div class="alert alert-danger py-2 small mb-3">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                        </div> 
                    @enderror
                    
                    @foreach($anggota as $index => $a)
                        <div class="row g-2 mb-2 align-items-center" wire:key="anggota-{{ $index }}">
                            <div class="col-md-5">
                                <input type="text" wire:model="anggota.{{ $index }}.nama_anggota" class="form-control form-control-sm" placeholder="Nama Anggota">
                                @error('anggota.'.$index.'.nama_anggota') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-5">
                                <input type="text" wire:model="anggota.{{ $index }}.nik" class="form-control form-control-sm" placeholder="NIK">
                                @error('anggota.'.$index.'.nik') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="button" wire:click="removeAnggota({{ $index }})" class="btn btn-sm btn-danger w-100"><i class="fas fa-trash"></i> Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            @if($currentStep == 3)
            <div class="row gy-4" wire:key="step-3">
                <div class="col-12">
                    <h6 class="fw-bold text-primary border-bottom pb-2">Dokumen Persyaratan (Google Drive)<span class="text-danger">*</span></h6>
                    <div class="alert alert-info py-2 small">
                        <i class="fas fa-info-circle me-1"></i> Pastikan link Google Drive diset menjadi <b>"Anyone with the link can view"</b>.
                    </div>
                </div>
                
                <div class="col-12">
                    <label class="form-label">Link Pengantar Kampus / Instansi<span class="text-danger">*</span></label>
                    <input type="url" wire:model="link_pengantar_kampus" class="form-control" placeholder="https://drive.google.com/...">
                    @error('link_pengantar_kampus') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                @if($isPenelitian)
                <div class="col-12">
                    <label class="form-label">Link Proposal Penelitian<span class="text-danger">*</span></label>
                    <input type="url" wire:model="link_proposal" class="form-control" placeholder="https://drive.google.com/...">
                    @error('link_proposal') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
            @endif

            <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                @if($currentStep > 1)
                    <button type="button" wire:click="prevStep" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Sebelumnya
                    </button>
                @else
                    <div></div> @endif

                @if($currentStep < 3)
                    <button type="button" wire:click="nextStep" class="btn btn-primary">
                        Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                @else
                    <button type="submit" class="btn btn-success fw-bold" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="fas fa-paper-plane me-1"></i> Kirim Permohonan</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                @endif
            </div>

        </form>
    </div>
</div>