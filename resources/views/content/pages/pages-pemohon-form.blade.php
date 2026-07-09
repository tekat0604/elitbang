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
                <div class="col-12 form-control-validation">
                  <label for="fullName" class="form-label">Nama Lengkap</label>
                  <input type="text" id="fullName" name="fullName" class="form-control"
                    placeholder="Masukkan nama lengkap" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="birthdate" class="form-label">Tanggal Lahir</label>
                  <input type="date" id="birthdate" name="birthdate" class="form-control" />
                </div>

                <div class="col-12 form-control-validation">
                  <label for="address" class="form-label">Alamat</label>
                  <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="identityType" class="form-label">Jenis Identitas</label>
                  <select id="identityType" name="identityType" class="form-select">
                    <option value="">Pilih jenis identitas</option>
                    <option value="ktp">KTP</option>
                    <option value="ktm">KTM</option>
                    <option value="passport">Passport</option>
                    <option value="sim">SIM</option>
                  </select>
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="identityNumber" class="form-label">Nomor Identitas</label>
                  <input type="text" id="identityNumber" name="identityNumber" class="form-control"
                    placeholder="Masukkan nomor identitas" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="phone" class="form-label">No Telp</label>
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="08xx xxxx xxxx" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="nationality" class="form-label">Kewarganegaraan</label>
                  <input type="text" id="nationality" name="nationality" class="form-control"
                    placeholder="Indonesia" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="province" class="form-label">Provinsi</label>
                  <input type="text" id="province" name="province" class="form-control"
                    placeholder="Masukkan provinsi" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="city" class="form-label">Kabupaten / Kota</label>
                  <input type="text" id="city" name="city" class="form-control"
                    placeholder="Masukkan kabupaten atau kota" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="district" class="form-label">Kecamatan</label>
                  <input type="text" id="district" name="district" class="form-control"
                    placeholder="Masukkan kecamatan" />
                </div>

                <div class="col-md-6 form-control-validation">
                  <label for="subdistrict" class="form-label">Kelurahan</label>
                  <input type="text" id="subdistrict" name="subdistrict" class="form-control"
                    placeholder="Masukkan kelurahan" />
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
