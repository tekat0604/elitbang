<div class="modal fade bs-example" id="formModalTambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin" role="document">
		<form method="post" id="submit_form_tambah" class="form-horizontal" autocomplete="off"> 
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Tambah Kategori Berita</h3>
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
								<label for="nama">Nama Kategori</label> 
								<input type="text" class="form-control" name="nama_kategori_menu" id="tambah_nama_kategori_menu" 
								maxlength="100" class="form-control" placeholder="Nama Kategori"/> 
								 <span id="error_tambah_nama_kategori_menu" class="validasi"></span> 
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