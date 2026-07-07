<div class="modal fade bs-example-modal-lg" id="formModalUbah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_ubah" class="form-horizontal" autocomplete="off">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Ubah Profil Pegawai</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i> 
                        </button>
                    </div>
                </div>
				<div class="block-content"> 
					<div class="row">
						<div class="col-md-6">  
							<div class="form-group col-md-12">
								<label for="NIP">NIP</label> 
								<input type="text" class="form-control" name="nip" id="ubah_nip" 
								maxlength="100" placeholder="nip"/> 
								 <span id="error_ubah_nip" class="validasi"></span> 
							</div> 
							<div class="form-group col-md-12">
								<label for="Nama">Nama</label> 
								<input type="text" class="form-control" name="nama" id="ubah_nama" 
								maxlength="100" placeholder="nama"/> 
								<span id="error_ubah_nama" class="validasi"></span> 
							</div> 
							<div class="form-group col-md-12">
								<label for="Tempat Lahir">Tempat Lahir</label> 
								<input type="text" class="form-control" name="tempat_lahir" id="ubah_tempat_lahir" 
								maxlength="60" placeholder="Masukkan Tempat Lahir"/> 
								<span id="error_ubah_tempat_lahir" class="validasi"></span> 
							</div>
							<div class="form-group col-md-12">
								<label for="nama">Tanggal Lahir</label> 
								<input type="text" class="form-control" name="tanggal_lahir" id="ubah_tanggal_lahir" 
								placeholder="Masukkan Tanggal"> 
							</div> 
							<div class="form-group col-md-12">
								<label for="Nama">Pangkat (Golru)</label> 
								<input type="text" class="form-control" name="pangkat_golru" id="ubah_pangkat_golru" 
								maxlength="100" placeholder="Pangkat (Golru)"/> 
								<span id="error_ubah_pangkat_golru" class="validasi"></span> 
							</div> 
							<div class="form-group col-md-12">
								<label for="TMT Pangkat">TMT Pangkat</label>   
								<input type="text" class="form-control" name="tmt_pangkat" id="ubah_tmt_pangkat" placeholder="Masukkan Tanggal"> 
								<span id="error_ubah_tmt_pangkat" class="validasi"></span> 
							</div>
							<div class="form-group col-md-12">
								<label for="Jabatan">Jabatan</label> 
								<input type="text" class="form-control" name="jabatan" id="ubah_jabatan" 
								maxlength="100" placeholder="Masukkan Jabatan"/> 
								<span id="error_ubah_jabatan" class="validasi"></span> 
							</div>
							
						</div> 
						<div class="col-md-6">     
							<div class="form-group col-md-12">
								<label for="TMT Jabatan">TMT Jabatan</label>  
								<input type="text" class="form-control" name="tmt_jabatan" id="ubah_tmt_jabatan" placeholder="Masukkan Tanggal" > 
								<span id="error_ubah_tmt_jabatan" class="validasi"></span> 
							</div>
							<div class="form-group col-md-12">
								<label for="formasi">Formasi</label> 
								<input type="text" class="form-control" name="formasi" id="ubah_formasi" 
								maxlength="100" placeholder="Masukkan Formasi"/> 
								<span id="error_ubah_formasi" class="validasi"></span> 
							</div>  
							<div class="form-group col-md-12">
								<label for="Unit Kerja">Unit Kerja</label> 
								<input type="text" class="form-control" name="unit_kerja" id="ubah_unit_kerja" 
								maxlength="100" placeholder="Masukkan Unit Kerja"/> 
								<span id="error_ubah_unit_kerja" class="validasi"></span> 
							</div>
							<div class="form-group col-md-12">
								<label for="Pendidikan">Pendidikan</label> 
								<input type="text" class="form-control" name="pendidikan" id="ubah_pendidikan" 
								maxlength="100" placeholder="Masukkan Pendidikan"/> 
									<span id="error_ubah_pendidikan" class="validasi"></span> 
							</div> 
							<div class="form-group col-md-12">
								<label for="nama">Alamat</label> 
								<textarea name="alamat" id="ubah_alamat" class="form-control" 
								placeholder="Masukkan Alamat"></textarea>
							</div>   
							<div class="form-group col-md-12">
								<label for="nama">Link</label> 
								<textarea name="link" id="ubah_link" class="form-control" 
								placeholder="Masukkan Link" style="height: 85px;"></textarea>
								<div class="text-right text-danger"> * without http://</div>
							</div>  
						</div> 
					</div> 


					<div class="row"> 
						<div class="col-md-12"> 
							<div class="form-group col-md-12">
								<label for="image">Upload Gambar</label>  
							</div>
							<div class="form-group col-md-12">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="ubah_image" name="image" 
									accept="image/*">
									<label id="ubah_image_label" class="custom-file-label" for="ubah_image">
									Silahkan pilih file...</label>
	                            </div> 
								<div class="text-danger text-right" style="float: left; width: 50%;">
									<div id="ubah_image_preview_container" class="form-group" 
		                                style="margin-top: 5px; width: 140px; height: auto; overflow:hidden; 
		                                line-height: auto;border:1px solid #dddddd; 
		                                background-color:#ffffff"> 
									</div>
								</div>
								<div class="text-danger text-right" style="float: left; width: 50%;">
									Ukuran Terbaik 472 x 709 px</div>
								<div style="clear: both;"> &nbsp; </div> 
							</div>  
						</div> 
					</div>  
				</div>  
				<div class="modal-footer">  
					<input type="hidden" id="ubah_id" name="id"/> 
					<button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" name="action" id="submit_ubah_data" class="btn btn-alt-success">
					<i class="fa fa-check"></i> Simpan 
					</button>
				</div> 
			</div>
		</div>
		</form>
	</div>
</div> 