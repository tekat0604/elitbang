@extends('layouts.sidebar_layout')

@section('title', 'Detail Perizinan Penelitian')

@section('main-content')
  @php
    $bidangPenelitian = [
        'Ekonomi',
        'Sosial',
        'Pemerintahan',
        'Kependudukan',
        'Pembangunan',
        'Kesehatan',
        'Lingkungan Hidup',
        'Budaya',
        'Politik',
    ];
    $rumpunPenelitian = [
        'Ekonomi',
        'Sosial',
        'Budaya',
        'Hukum',
        'Kesehatan',
        'Pemerintahan',
        'Politik',
        'Pendidikan',
        'Lingkungan Hidup',
        'Teknik dan Pembangunan',
        'Agama',
        'Kependudukan',
        'Ketenagakerjaan',
        'Digital dan Teknologi',
        'Transportasi dan Perhubungan',
        'Lainnya',
    ];
  @endphp

  <div class="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center mb-4">
    <div>
      <h4 class="mb-1">Detail Perizinan Penelitian</h4>
      <p class="text-body-secondary mb-0">Lengkapi informasi lokasi, penanggung jawab, dan data penelitian.</p>
    </div>
    <a href="{{ route('permohonan.penelitian') }}" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
  </div>

  <form id="formDetailPerizinan">
    <div class="card card-dash border-0 mb-4">
      <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Lokasi Penelitian</h5>

        <div class="row g-3">
          <div class="col-md-4">
            <label for="level_opd" class="form-label">Level Instansi/OPD <span class="text-danger">*</span></label>
            <select id="level_opd" name="level_opd" class="form-select" required>
              <option value="">Pilih level OPD</option>
              <option value="kota">Kota Surakarta</option>
              <option value="kecamatan">Kecamatan</option>
              <option value="kelurahan">Kelurahan</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>
          <div class="col-md-8">
            <label for="lokasi" class="form-label">Lokasi Penelitian <span class="text-danger">*</span></label>
            <input type="text" id="lokasi" name="lokasi" class="form-control"
              placeholder="Contoh: Dinas/OPD atau wilayah lokasi penelitian" required>
          </div>
          <div class="col-12">
            <label for="tembusan" class="form-label">Tembusan OPD</label>
            <input type="text" id="tembusan" name="tembusan" class="form-control"
              placeholder="Masukkan OPD yang perlu menerima tembusan (jika ada)">
            <small class="text-body-secondary">Data daftar OPD dan pengiriman tembusan akan disambungkan pada tahap
              berikutnya.</small>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-dash border-0 mb-4">
      <div class="card-body p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
          <div>
            <h5 class="fw-bold mb-1">Pembimbing / Penanggung Jawab</h5>
            <p class="text-body-secondary mb-0">Tambahkan satu atau lebih pihak yang bertanggung jawab atas penelitian.
            </p>
          </div>
          <button type="button" id="tambahPenanggungJawab" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah
          </button>
        </div>

        <div id="daftarPenanggungJawab"></div>
      </div>
    </div>

    <div class="card card-dash border-0">
      <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Informasi Penelitian</h5>

        <div class="row g-3">
          <div class="col-md-6">
            <label for="tgl_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
            <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="tgl_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
            <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="jenjang_pendidikan" class="form-label">Jenjang Pendidikan <span
                class="text-danger">*</span></label>
            <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="form-select" required>
              <option value="">Pilih jenjang pendidikan</option>
              @foreach (['S1', 'S2', 'S3', 'D3', 'D4', 'SMA', 'SMP'] as $jenjang)
                <option value="{{ $jenjang }}">{{ $jenjang }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="bidang_penelitian" class="form-label">Bidang Penelitian <span class="text-danger">*</span></label>
            <select id="bidang_penelitian" name="bidang_penelitian" class="form-select" required>
              <option value="">Pilih bidang penelitian</option>
              @foreach ($bidangPenelitian as $bidang)
                <option value="{{ $bidang }}">{{ $bidang }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-12">
            <label for="rumpun_penelitian" class="form-label">Rumpun Penelitian <span class="text-danger">*</span></label>
            <select id="rumpun_penelitian" name="rumpun_penelitian" class="form-select" required>
              <option value="">Pilih rumpun penelitian</option>
              @foreach ($rumpunPenelitian as $rumpun)
                <option value="{{ $rumpun }}">{{ $rumpun }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="nama_instansi_tujuan" class="form-label">Nama Instansi <span
                class="text-danger">*</span></label>
            <input type="text" id="nama_instansi_tujuan" name="nama_instansi_tujuan" class="form-control"
              placeholder="Masukkan nama instansi" required>
          </div>
          <div class="col-md-6">
            <label for="alamat_instansi_tujuan" class="form-label">Alamat Instansi <span
                class="text-danger">*</span></label>
            <textarea id="alamat_instansi_tujuan" name="alamat_instansi_tujuan" class="form-control" rows="2"
              placeholder="Masukkan alamat lengkap instansi" required></textarea>
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
          <a href="{{ route('permohonan.penelitian') }}" class="btn btn-outline-secondary">Sebelumnya</a>
          <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan</button>
        </div>
      </div>
    </div>
  </form>

  <template id="templatePenanggungJawab">
    <div class="penanggung-jawab-item border rounded-3 p-3 mb-3">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="penanggung-jawab-judul mb-0">Penanggung Jawab</h6>
        <button type="button" class="btn btn-sm btn-outline-danger hapus-penanggung-jawab">
          <i class="fas fa-trash me-1"></i> Hapus
        </button>
      </div>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Peran <span class="text-danger">*</span></label>
          <select name="penanggung_jawab[][peran]" class="form-select" required>
            <option value="pembimbing">Pembimbing</option>
            <option value="penanggung_jawab">Penanggung Jawab</option>
          </select>
        </div>
        <div class="col-md-8">
          <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" name="penanggung_jawab[][nama]" class="form-control"
            placeholder="Masukkan nama lengkap" required>
        </div>
      </div>
    </div>
  </template>

  <script>
    const daftarPenanggungJawab = document.getElementById('daftarPenanggungJawab');
    const templatePenanggungJawab = document.getElementById('templatePenanggungJawab');

    function perbaruiNomorPenanggungJawab() {
      [...daftarPenanggungJawab.children].forEach((item, index) => {
        item.querySelector('.penanggung-jawab-judul').textContent = `Penanggung Jawab ${index + 1}`;
      });
    }

    function tambahPenanggungJawab() {
      daftarPenanggungJawab.append(templatePenanggungJawab.content.cloneNode(true));
      perbaruiNomorPenanggungJawab();
    }

    document.getElementById('tambahPenanggungJawab').addEventListener('click', tambahPenanggungJawab);
    daftarPenanggungJawab.addEventListener('click', event => {
      const tombolHapus = event.target.closest('.hapus-penanggung-jawab');
      if (tombolHapus && daftarPenanggungJawab.children.length > 1) {
        tombolHapus.closest('.penanggung-jawab-item').remove();
        perbaruiNomorPenanggungJawab();
      }
    });

    tambahPenanggungJawab();

    document.getElementById('formDetailPerizinan').addEventListener('submit', event => {
      event.preventDefault();
    });
  </script>
@endsection
