<div class="modal fade bs-example-modal-lg" id="formModalUbah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_ubah" class="form-horizontal" autocomplete="off">
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Ubah Pesan Singkat</h3>
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
								<label for="nama">Konten</label> 
								<textarea name="konten" id="ubah_konten" class="form-control" 
								placeholder="Masukkan Konten"></textarea>
								<span id="error_ubah_konten" class="validasi"></span>
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