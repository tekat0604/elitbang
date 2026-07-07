					<!-- .modal for delete -->
					<div class="modal fade" id="konfirmasi_hapus_modal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<form method="post" id="hapus_form">
								<div class="modal-header">
									<h4 class="modal-title"> <i class="mdi mdi-alert-outline"></i> Konfirmasi</h4> 
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name='id_hapus' id='id_hapus' />
									<p id ="valcomplete"> Apakah anda yakin akan menghapus data ini?</p>
                                </div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-danger" id="konfirmasi_hapus">Ya Hapus</button>	
								</div>
							</form>
							</div> 
						</div> 
					</div> 	