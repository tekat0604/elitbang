			<div class="display_form_registrasi">  
                <form class="form form-horizontal" id="form_tambah_korban">
                    <input type="hidden" id="tambah_kabupaten" name="kabupaten"> 
                    <input type="hidden" id="tambah_agama" name="agama"> 
                    <div class="form-body">  
						<div class="row mb-10">
                        	<div class="col-md-12">
								<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;"> 
									<i class="fa fa-user"></i> Data Penduduk 
								</h3>
							</div>
                        </div> 
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-12 col-sm-12 ">  
                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>NIK</label>
                                    </div>
                                    <div class="col-md-8"> 
                                        <input type="number" id="tambah_nik" class="form-control" name="nik" placeholder="NIK">
                                        <div id="error_tambah_nik" class="validasi"></div>
                                    </div>
                                </div> 

								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Nomor KK</label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <input type="number" id="tambah_nomor_kk" class="form-control" name="nomor_kk" placeholder="nomor KK">
                                        <div id="error_tambah_nomor_kk" class="validasi"></div>
                                    </div>
                                </div> 

                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <input type="text" id="tambah_nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                        <div id="error_tambah_nama_lengkap" class="validasi"></div>
                                    </div>
                                </div>

								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="tambah_tempat_lahir" class="form-control" name="tempat_lahir" 
                                        placeholder="Nama Lengkap"> 
                                        <div id="error_tambah_tempat_lahir" class="validasi"></div>
                                    </div>
                                </div>
								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-md-8  "> 
										<input type="text" id="tambah_tanggal_lahir" class="form-control" name="tanggal_lahir" 
										placeholder="Tanggal Lahir">   
                                        <div id="error_tambah_tanggal_lahir" class="validasi"></div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <label> Jenis Kelamin</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 12px;">
                                            <li class="d-inline-block mr-1">
                                                <fieldset>
                                                    <div class="radio radio-primary radio-glow">
                                                        <input type="radio" id="tambah_jenis_kelamin_pria" name="jenis_kelamin" value="LAKI-LAKI" checked="">
                                                        <label for="tambah_jenis_kelamin_pria"> Laki-Laki </label>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-1">
                                                <fieldset>
                                                    <div class="radio radio-primary radio-glow">
                                                        <input type="radio" id="tambah_jenis_kelamin_wanita" name="jenis_kelamin" value="PEREMPUAN">
                                                        <label for="tambah_jenis_kelamin_wanita"> Perempuan </label>
                                                    </div>
                                                </fieldset>
                                            </li>
                                        </ul> 
                                    </div>
                                </div>
                                 
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12 ">
                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Alamat </label>
                                    </div>
                                    <div class="col-md-8 ">
                                        <div>
                                            <textarea id="tambah_alamat_lengkap" rows="3" class="form-control" 
                                            name="alamat_lengkap" placeholder="Alamat Lengkap"></textarea> 
                                        </div>
                                        <div id="error_tambah_alamat_lengkap" class="validasi"></div>
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>RT</label>
                                    </div>
                                    <div class="col-md-8 ">
										<input type="text" id="tambah_rt" class="form-control" name="rt" placeholder="RT">
                                        <div id="error_tambah_rt" class="validasi"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>RW</label>
                                    </div>
                                    <div class="col-md-8 "> 
										<input type="text" id="tambah_rw" class="form-control" name="rw" placeholder="RW">
                                        <div id="error_tambah_rw" class="validasi"></div> 
                                    </div>
                                </div>
                                <div class="row mb-3 "> 
                                    <div class="col-md-4"> 
                                        <label for="firstName13">Kecamatan</label>  
                                    </div> 
                                    <div class="col-md-8"> 
                                        <select class="select2-size-lg form-control" name="id_kecamatan" id="tambah_id_kecamatan" onchange="getKelurahan(this)">
											<option value="">Pilih Kecamatan</option> 
                                        </select> 
                                        <div id="error_tambah_id_kecamatan" class="validasi"></div>
                                    </div>  
                                </div> 
                                <div class="row mb-3 "> 
                                    <div class="col-md-4"> 
                                        <label for="firstName13">Kelurahan</label>  
                                    </div> 
                                    <div class="col-md-8"> 
                                        <select class="select2-size-lg form-control" name="id_kelurahan" id="tambah_id_kelurahan">
                                            <option value="">Pilih Kelurahan <option> 
										</select> 
                                        <div id="error_tambah_id_kelurahan" class="validasi"></div>
                                    </div>  
                                </div>
                                
                            </div>
                        </div> 
						<div class="row">
                            <div class="col-md-12 "><hr></div>
                        </div>
						<div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 "> 
								<div class="row"> 
                                    <div class="col-md-4"> 
                                        <label for="firstName13">Kategori Bencana</label>  
                                    </div> 
                                    <div class="col-md-8">
                                        <div class="form-group"> 
                                        <select class="select2-size-lg form-control" name="id_kategori" id="tambah_id_kategori" >
											<option value="">Kategori Bencana</option> 
										</select>
                                        </div>
                                        <span id="error_tambah_id_kategori" class="validasi"></span>
                                    </div>  
                                </div>  
								<div class="row">
                                    <div class="col-md-4">
                                        <label>Keterangan </label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <textarea id="tambah_keterangan" rows="3" class="form-control" name="keterangan" placeholder="keterangan"></textarea> 
                                        <div id="error_tambah_keterangan" class="validasi"></div>
                                    </div>
                                </div>
							</div>
                            <div class="col-lg-6 col-md-12 col-sm-12 ">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="nama">Upload Gambar
                                            <i class="text-danger" style="margin-left: 110px; font-weight: normal;">Ukuran Terbaik 800 x 800 px</i> 
                                        </label> 
                                        <div id="tambah_image_preview_container" class="form-group" 
                                        style="width: 150px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; 
                                        background-color:#ffffff"> 
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="tambah_image" name="image" 
                                            accept="image/*">
                                            <label id="tambah_image_label" class="custom-file-label" for="tambah_image">
                                            Silahkan pilih file...</label>
                                        </div>
                                    </div>
                                </div> 
                            </div>
						</div>

                        <div class="row">
                            <div class="col-md-12 "><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end ">
                                <button type="submit" class="btn btn-primary mr-2 mb-1"> <i class="fa fa-check-circle"></i> Simpan</button>
                                <button type="reset" class="btn btn-light-secondary mr-1 mb-1 btn_reset">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>