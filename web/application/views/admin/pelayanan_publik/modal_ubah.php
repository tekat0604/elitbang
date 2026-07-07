<div class="modal fade bs-example-modal-lg" id="formModalUbah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_ubah" class="form-horizontal" autocomplete="off">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header bg-primary-dark">
						<h3 class="block-title model_title">Ubah Pelayanan Publik</h3>
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
									<textarea class="form-control" name="judul" id="ubah_judul" class="form-control" placeholder="Judul"></textarea>
									<span id="error_tambah_judul" class="validasi"></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="nama">Kategori </label>
									<select name="id_kategori" id="ubah_id_kategori" class="form-control"> </select>
								</div>
							</div>
							<div class="row" hidden>
								<div class="form-group col-md-12">
									<label for="nama">Konten</label>
									<textarea name="konten" id="ubah_konten" class="form-control" placeholder="Masukkan Konten"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label> Link </label>
								</div>
								<div class="col-md-12 form-group">
									<div class="position-relative has-icon-left">
										<textarea class="form-control" name="link" id="ubah_link" placeholder="Masukkan Link"></textarea>
										<div class="form-control-position">
											<i class="bx bx-walk"></i>
										</div>
									</div>
									<span id="error_ubah_link" class="validasi"></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="nama">Upload File <i class="text-danger" style="margin-left: 110px; font-weight: normal;"> PDF,CSV,JPG,JPEG</i> </label>
									<div id="ubah_file_preview_container" class="form-group" style="width: 500px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; background-color:#ffffff">
									</div>
									<input type="hidden" name="kosongkan_file" id="kosongkan_file">
								</div>
								<div class="col-12">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="ubah_file" name="file">
										<label id="ubah_file_label" class="custom-file-label" for="ubah_image">
											Silahkan pilih file...</label>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="ubah_id" name="id" />
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