<div class="modal fade bs-example-modal-lg" id="formModalTambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_tambah" class="form-horizontal" autocomplete="off"> 
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Tambah Grid 2</h3>
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
								<label for="nama">Judul</label> 
								<input type="text" class="form-control" name="judul" id="tambah_judul" 
								maxlength="100" class="form-control" placeholder="Judul"/> 
								 <span id="error_tambah_judul" class="validasi"></span> 
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Konten</label> 
								<textarea name="konten" id="tambah_konten" class="form-control" 
								placeholder="Masukkan Konten"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label for="nama">Upload Gambar <i class="text-danger" style="margin-left: 110px; font-weight: normal;">
								Ukuran Terbaik 150 x 150 px</i> </label> 
								<div id="tambah_image_preview_container" class="form-group" style="width: 120px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; background-color:#ffffff"> 
								</div>
							</div>
							<div class="col-12">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="tambah_image" name="image" 
									accept="image/*">
									<label id="tambah_image_label" class="custom-file-label" for="tambah_image">
									Silahkan pilih file...</label>
                                </div>
							</div>
						</div> 
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Link</label> 
								<textarea name="link" id="tambah_link" class="form-control" 
								placeholder="Masukkan Link"></textarea>
								<div class="text-right text-danger"> * without http://</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer"> 
					<button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" name="action" id="submit_tambah_data" class="btn btn-alt-success">
					<i class="fa fa-check"></i> Simpan 
					</button>
				</div> 
			</div>
		</div>
		</form>
	</div>
</div> 