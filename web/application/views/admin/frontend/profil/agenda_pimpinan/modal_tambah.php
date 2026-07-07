<div class="modal fade bs-example-modal-lg" id="formModalTambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-popin modal-lg" role="document">
		<form method="post" id="submit_form_tambah" class="form-horizontal" autocomplete="off"> 
		<div class="modal-content">
			<div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title model_title">Tambah Agenda Pimpinan</h3>
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
								<label for="nama">Nama Kegiatan</label> 
								<input type="text" class="form-control" name="nama_kegiatan" id="tambah_nama_kegiatan" 
								maxlength="200" class="form-control" placeholder="Nama Kegiatan"/> 
								 <span id="error_tambah_nama_kegiatan" class="validasi"></span> 
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Tempat Kegiatan</label> 
								<input type="text" class="form-control" name="tempat_kegiatan" id="tambah_tempat_kegiatan"  
								placeholder="Masukkan Tempat Kegiatan"/> 
								 <span id="error_tambah_tempat_kegiatan" class="validasi"></span> 
							</div>
						</div> 
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nama">Tanggal Kegiatan</label> 
								<input type="text" class="date_picker form-control" id="tambah_tanggal_kegiatan" name="tanggal_kegiatan" 
								data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"> 
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