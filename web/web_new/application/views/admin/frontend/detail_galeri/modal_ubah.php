<div class="modal fade bs-example-modal-lg" id="formModalUbah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_ubah" class="form-horizontal">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Ubah Data</h3>
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
								<input type="text" class="form-control" name="judul" id="ubah_judul" 
								maxlength="100" class="form-control" placeholder="Judul"/> 
								 <span id="error_ubah_judul" class="validasi"></span> 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label for="nama">Upload Gambar <i class="text-danger" style="margin-left: 110px; font-weight: normal;">Ukuran Terbaik 1679 x 790 px</i> </label> 
								<div id="ubah_image_preview_container" class="form-group" style="width: 200px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; background-color:#ffffff"> 
								</div>
								<input type="hidden" name="kosongkan_image" id="kosongkan_ubah_image">
							</div>
							<div class="col-12">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="ubah_image" name="image" 
									accept="image/*">
									<label id="ubah_image_label" class="custom-file-label" for="ubah_image">
									Silahkan pilih file...</label>
                                </div>
							</div>
						</div> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Video Youtube</label> 
									<div class="checkbox checkbox-danger">  
										<label class="css-control css-control-sm css-control-secondary css-switch">
											<input type="checkbox" class="css-control-input" id="ubah_jenis" name="jenis" >
											<span class="css-control-indicator"></span> Masukkan link youtube
										</label> 
									</div>  
									<div> 
										<input type="hidden" id="ubah_link_youtube" name="link"  autocomplete="off"
										class="form-control m-l-10" placeholder="https://www.youtube.com/watch?v=1q2w3e4r" 
										style="width: 99%;">  
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>  
				<div class="modal-footer"> 
					<input type="hidden" id="ubah_tanggal" name="tanggal"/> 
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