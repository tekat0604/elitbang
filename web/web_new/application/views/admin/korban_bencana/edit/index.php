<main id="main-container">
        <div class="content content_padding"> 
			<div class="row"> 
				<div class="col-md-12"> 
					<!-- Bootstrap Contact -->
					<div class="block block-themed"  >
						<div class="block-header" style="background-color: #FFF; border-bottom: 1px solid #e5e5e5; ">
							<h3 class="block-title" style="color: #000!important;"> 
								<i class="fa fa-pencil"></i> Form Ubah Korban Bencana  
							</h3>
							<div class="block-options"> 
								<button type="button" class="btn-block-option" 
								data-toggle="block-option" data-action="content_toggle" style="color: #000!important;"><i class="si si-arrow-up"></i></button>
							</div>
						</div>
						<div class="block-content" style>
						<form class="form form-horizontal" id="submit_form_ubah"> 
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
                                        <input type="number" id="ubah_nik" class="form-control" name="nik" placeholder="NIK">
                                        <div id="error_ubah_nik" class="validasi"></div>
                                    </div>
                                </div> 

								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Nomor KK</label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <input type="number" id="ubah_nomor_kk" class="form-control" name="nomor_kk" placeholder="nomor KK">
                                        <div id="error_ubah_nomor_kk" class="validasi"></div>
                                    </div>
                                </div> 

                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <input type="text" id="ubah_nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                        <div id="error_ubah_nama_lengkap" class="validasi"></div>
                                    </div>
                                </div>

								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="ubah_tempat_lahir" class="form-control" name="tempat_lahir" 
                                        placeholder="Tempat Lahir"> 
                                        <div id="error_ubah_tempat_lahir" class="validasi"></div>
                                    </div>
                                </div>
								<div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-md-8  "> 
										<input type="text" id="ubah_tanggal_lahir" class="form-control" name="tanggal_lahir" 
										placeholder="Tanggal Lahir">   
                                        <div id="error_ubah_tanggal_lahir" class="validasi"></div>
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
                                                        <input type="radio" id="ubah_jenis_kelamin_pria" name="jenis_kelamin" value="LAKI-LAKI" checked="">
                                                        <label for="ubah_jenis_kelamin_pria"> Laki-Laki </label>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-1">
                                                <fieldset>
                                                    <div class="radio radio-primary radio-glow">
                                                        <input type="radio" id="ubah_jenis_kelamin_wanita" name="jenis_kelamin" value="PEREMPUAN">
                                                        <label for="ubah_jenis_kelamin_wanita"> Perempuan </label>
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
                                            <textarea id="ubah_alamat_lengkap" rows="3" class="form-control" 
                                            name="alamat_lengkap" placeholder="Alamat Lengkap"></textarea> 
                                        </div>
                                        <div id="error_ubah_alamat_lengkap" class="validasi"></div>
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>RT</label>
                                    </div>
                                    <div class="col-md-8 ">
										<input type="text" id="ubah_rt" class="form-control" name="rt" placeholder="RT">
                                        <div id="error_ubah_rt" class="validasi"></div>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <div class="col-md-4">
                                        <label>RW</label>
                                    </div>
                                    <div class="col-md-8 "> 
										<input type="text" id="ubah_rw" class="form-control" name="rw" placeholder="RW">
                                        <div id="error_ubah_rw" class="validasi"></div> 
                                    </div>
                                </div>
                                <div class="row mb-3 "> 
                                    <div class="col-md-4"> 
                                        <label for="firstName13">Kecamatan</label>  
                                    </div> 
                                    <div class="col-md-8"> 
                                        <select class="select2-size-lg form-control" name="id_kecamatan" id="ubah_id_kecamatan" onchange="getKelurahan(this)">
											<option value="">Pilih Kecamatan</option> 
                                        </select> 
                                        <div id="error_ubah_id_kecamatan" class="validasi"></div>
                                    </div>  
                                </div> 
                                <div class="row mb-3 "> 
                                    <div class="col-md-4"> 
                                        <label for="firstName13">Kelurahan</label>  
                                    </div> 
                                    <div class="col-md-8"> 
                                        <select class="select2-size-lg form-control" name="id_kelurahan" id="ubah_id_kelurahan">
                                            <option value="">Pilih Kelurahan <option> 
										</select> 
                                        <div id="error_ubah_id_kelurahan" class="validasi"></div>
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
                                        <select class="select2-size-lg form-control" name="id_kategori" id="ubah_id_kategori" >
											<option value="">Kategori Bencana</option> 
										</select>
                                        </div>
                                        <span id="error_ubah_id_kategori" class="validasi"></span>
                                    </div>  
                                </div>  
								<div class="row">
                                    <div class="col-md-4">
                                        <label>Keterangan </label>
                                    </div>
                                    <div class="col-md-8 "> 
                                        <textarea id="ubah_keterangan" rows="3" class="form-control" name="keterangan" placeholder="keterangan"></textarea> 
                                        <div id="error_ubah_keterangan" class="validasi"></div>
                                    </div>
                                </div>
							</div>
                            <div class="col-lg-6 col-md-12 col-sm-12 ">
							<input type="hidden" name="kosongkan_image" id="kosongkan_ubah_image">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="nama">Upload Gambar
                                            <i class="text-danger" style="margin-left: 110px; font-weight: normal;">Ukuran Terbaik 800 x 800 px</i> 
                                        </label> 
                                        <div id="ubah_image_preview_container" class="form-group" 
                                        style="width: 150px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; 
                                        background-color:#ffffff"> 
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="ubah_image" name="image" 
                                            accept="image/*">
                                            <label id="ubah_image_label" class="custom-file-label" for="ubah_image">
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
								<input type="hidden" id="ubah_id" name="id"/> 
                                <button type="submit" class="btn btn-primary mr-2 mb-1"> <i class="fa fa-check-circle"></i> Simpan</button>
                                <button type="reset" class="btn btn-light-secondary mr-1 mb-1 btn_reset">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
						</div>
					</div>
					<!-- END Bootstrap Contact -->
				</div>
			</div> 		 
        </div> 
    </main>