@extends('layouts/front_layout')

@section('title', 'Form Data Pemohon')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-profile.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
  <div class="container-xxl py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body p-4 p-md-5">
            <div class="mb-4 text-center">
              <h4 class="mb-2">Form Data Pemohon</h4>
              <p class="text-muted mb-0">Isi data pemohon untuk kelengkapan pendaftaran.</p>
            </div>

            <form id="formPemohon" action="javascript:void(0);" method="POST">
              <div class="row gy-4">
                <div class="col-md-6 form-control-validation">
                  <label for="nama_lengkap" class="form-label">Nama lengkap</label>
                  <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Silakan isi nama lengkap anda" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="jenis_identitas" class="form-label">Jenis Identitas</label>
                  <select id="jenis_identitas" name="jenis_identitas" class="form-select">
                    <option value="">Pilih jenis identitas</option>
                    <option value="ktp">KTP</option>
                    <option value="ktm">KTM</option>
                    <option value="passport">Paspor</option>
                    <option value="sim">SIM</option>
                  </select>
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
                  <input type="text" id="nomor_identitas" name="nomor_identitas" class="form-control" placeholder="Masukkan nomor identitas" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="08xx xxxx xxxx" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="email" class="form-label">email</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Masukan email anda" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                  <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="form-control" placeholder="Indonesia" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control"/>
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="province" class="form-label">Provinsi</label>
                  <input type="text" id="province" name="provinsi" class="form-control" placeholder="Masukkan provinsi" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="city" class="form-label">Kabupaten / Kota</label>
                  <input type="text" id="city" name="kota_kabupaten" class="form-control" placeholder="Masukkan kabupaten atau kota" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="district" class="form-label">Kecamatan</label>
                  <input type="text" id="district" name="kecamatan" class="form-control" placeholder="Masukkan kecamatan" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="subdistrict" class="form-label">Kelurahan / Desa</label>
                  <input type="text" id="subdistrict" name="kelurahan_desa" class="form-control" placeholder="Masukkan kelurahan atau desa" />
                </div>

                <div class="col-12 form-control-validation">
                  <label for="address" class="form-label">Alamat</label>
                  <textarea id="address" name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="col-12 form-control-validation">
                  <label for="address" class="form-label">foto identitas</label>
                  <textarea id="address" name="alamat" class="form-control" rows="3"></textarea>
                </div>
              </div>

              <div class="mt-4 d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-label-secondary">Batal</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection