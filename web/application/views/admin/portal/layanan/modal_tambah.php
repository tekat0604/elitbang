<div class="modal fade bs-example-modal-lg" id="formModalTambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_tambah" class="form-horizontal" autocomplete="off">
			<div class="modal-content">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header bg-primary-dark">
						<h3 class="block-title model_title">Tambah Layanan</h3>
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
									<input type="text" class="form-control" name="judul" id="tambah_judul" maxlength="100" class="form-control" placeholder="Judul" />
									<span id="error_tambah_judul" class="validasi"></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="nama">Upload File/Dokumen </label>
									<div id="tambah_file_preview_container" class="form-group" style="width: 300px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; background-color:#ffffff; padding: 5px; ">
									</div>
								</div>
								<div class="col-md-12">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="tambah_file" name="file">
										<label id="tambah_file_label" class="custom-file-label" for="tambah_file">
											Silahkan pilih file...</label>
									</div>
									<div class="text-right"> File Yang dizinkan dengan format :
										<span class="text-danger">'gif','png','jpg','jpeg','pdf' </span>
									</div>
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