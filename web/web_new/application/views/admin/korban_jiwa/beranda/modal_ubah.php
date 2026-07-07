<div class="modal fade bs-example-modal-lg" id="formModalUbah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_ubah" class="form-horizontal" autocomplete="off">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Ubah Korban Jiwa</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i> 
                        </button>
                    </div>
                </div>
				<div class="block-content">
				<div class="p-20">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">NIK</label> 
								<input type="text" class="form-control" name="nik" id="ubah_nik" 
								maxlength="20" class="form-control" placeholder="NIK"/> 
								 <span id="error_ubah_nik" class="validasi"></span> 
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Nama</label> 
								<input type="text" class="form-control" name="nama" id="ubah_nama" 
								maxlength="20" class="form-control" placeholder="Nama"/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Kategori</label> 
								<select class="form-control" id="tambah_kategori" name="kategori">
                                                    <option value="0">Please select</option>
                                                    <option value="Anak anak">Anak anak</option>
                                                    <option value="Dewasa">Dewasa</option>
                                                    <option value="Lansia">Lansia</option>
							</select>
						</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12" id="jk">
								<label for="nama">Jenis Kelamin</label> 
								<select class="form-control" id="ubah_jenis_kelamin" name="jenis_kelamin">
									<option value="" selected disabled>Please select</option>
									<option value="L">Laki Laki</option>
									<option value="P">Perempuan</option>
							</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Alamat</label> 
								<input type="text" class="form-control" name="alamat" id="ubah_alamat" 
								maxlength="100" class="form-control" placeholder="Alamat"/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Tempat Lahir</label> 
								<input type="text" class="form-control" name="tmpt_lahir" id="ubah_tmpt_lahir" 
								maxlength="100" class="form-control" placeholder="Tempat Lahir"/>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Tanggal Lahir</label> 
								<input type="date" class="form-control" name="tgl_lahir" id="ubah_tgl_lahir" 
								maxlength="100" class="form-control" placeholder="Tanggal Lahir"/>
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
