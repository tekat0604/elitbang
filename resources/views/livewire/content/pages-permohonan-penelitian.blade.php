@extends('layouts.sidebar_layout')

@section('title', 'Pengajuan Izin Penelitian')

@section('main-content')
  <div class="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center mb-4">
    <div>
      <h4 class="mb-1">Pengajuan Izin Penelitian</h4>
      <p class="text-body-secondary mb-0">Lengkapi data penelitian dan anggota peneliti.</p>
    </div>
    <a href="{{ route('permohonan.pilih-jenis') }}" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali ke Pilihan Izin
    </a>
  </div>

  <form id="formPermohonanPenelitian" action="{{ route('permohonan.perizinan') }}" method="GET">
    <div class="card card-dash border-0 mb-4">
      <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Data Penelitian</h5>

        <div class="mb-0">
          <label for="judul" class="form-label fw-semibold">Judul Penelitian <span class="text-danger">*</span></label>
          <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul penelitian" required>
        </div>
      </div>
    </div>

    <div class="card card-dash border-0">
      <div class="card-body p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
          <div>
            <h5 class="fw-bold mb-1">Jumlah Peneliti</h5>
            <p class="text-body-secondary mb-0">Pilih pengajuan personal atau tambahkan anggota untuk pengajuan kelompok.</p>
          </div>
          <span id="jumlahAnggota" class="badge text-bg-primary px-3 py-2">1 Peneliti</span>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <input class="btn-check" type="radio" name="jenis_pengajuan" id="personal" value="personal" checked>
            <label class="btn btn-outline-primary w-100 text-start p-3" for="personal">
              <span class="fw-semibold d-block">Personal</span>
              <small> Saya mengajukan penelitian sendiri.</small>
            </label>
          </div>
          <div class="col-md-6">
            <input class="btn-check" type="radio" name="jenis_pengajuan" id="kelompok" value="kelompok">
            <label class="btn btn-outline-primary w-100 text-start p-3" for="kelompok">
              <span class="fw-semibold d-block">Kelompok</span>
              <small> Saya mengajukan penelitian bersama anggota lain.</small>
            </label>
          </div>
        </div>

        <div id="bagianAnggota" class="d-none">
          <div class="d-flex justify-content-between align-items-center border-top pt-4 mb-3">
            <div>
              <h6 class="fw-bold mb-1">Daftar Anggota Peneliti</h6>
              <small class="text-body-secondary">Tambahkan nama dan NIK/NIM setiap anggota kelompok.</small>
            </div>
            <button type="button" id="tambahAnggota" class="btn btn-primary btn-sm">
              <i class="fas fa-plus me-1"></i> Tambah Anggota
            </button>
          </div>

          <div id="daftarAnggota"></div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
          <a href="{{ route('permohonan.pilih-jenis') }}" class="btn btn-outline-secondary">Batal</a>
          <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan</button>
        </div>
      </div>
    </div>
  </form>

  <template id="templateAnggota">
    <div class="anggota-item border rounded-3 p-3 mb-3">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="anggota-judul mb-0">Anggota</h6>
        <button type="button" class="btn btn-sm btn-outline-danger hapus-anggota">
          <i class="fas fa-trash me-1"></i> Hapus
        </button>
      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Nama Anggota <span class="text-danger">*</span></label>
          <input type="text" name="anggota[][nama]" class="form-control" placeholder="Nama lengkap anggota" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">NIK/NIM <span class="text-danger">*</span></label>
          <input type="text" name="anggota[][nik_nim]" class="form-control" placeholder="Masukkan NIK atau NIM" required>
        </div>
      </div>
    </div>
  </template>

  <script>
    const personal = document.getElementById('personal');
    const kelompok = document.getElementById('kelompok');
    const bagianAnggota = document.getElementById('bagianAnggota');
    const daftarAnggota = document.getElementById('daftarAnggota');
    const templateAnggota = document.getElementById('templateAnggota');
    const jumlahAnggota = document.getElementById('jumlahAnggota');

    function perbaruiJumlah() {
      const total = kelompok.checked ? daftarAnggota.children.length + 1 : 1;
      jumlahAnggota.textContent = `${total} Peneliti`;

      [...daftarAnggota.children].forEach((item, index) => {
        item.querySelector('.anggota-judul').textContent = `Anggota ${index + 1}`;
        item.querySelectorAll('input').forEach(input => {
          input.disabled = !kelompok.checked;
        });
      });
    }

    function tambahAnggota() {
      daftarAnggota.append(templateAnggota.content.cloneNode(true));
      perbaruiJumlah();
    }

    personal.addEventListener('change', () => {
      bagianAnggota.classList.add('d-none');
      perbaruiJumlah();
    });

    kelompok.addEventListener('change', () => {
      bagianAnggota.classList.remove('d-none');
      if (!daftarAnggota.children.length) tambahAnggota();
      perbaruiJumlah();
    });

    document.getElementById('tambahAnggota').addEventListener('click', tambahAnggota);
    daftarAnggota.addEventListener('click', event => {
      const tombolHapus = event.target.closest('.hapus-anggota');
      if (tombolHapus) {
        tombolHapus.closest('.anggota-item').remove();
        perbaruiJumlah();
      }
    });

  </script>
@endsection
