<main id="main-container">
        <div class="content content_padding"> 
			<div class="row"> 
				<div class="col-md-12"> 
					<!-- Bootstrap Contact -->
					<div class="block block-themed"  >
						<div class="block-header" style="background-color: #FFF; border-bottom: 1px solid #e5e5e5; ">
							<h3 class="block-title" style="color: #000!important;"> 
							<i class="fa fa-plus"></i> Form Tambah Data </h3>
							<div class="block-options"> 
								<button type="button" class="btn-block-option" 
								data-toggle="block-option" data-action="content_toggle" style="color: #000!important;">
								<i class="si si-arrow-up"></i></button>
							</div>
						</div>
						<div class="block-content" style> 
							<div class="row">
								<div class="col-md-12">
									<div class="mb-5 text-right"> 
										<a href="<?php echo base_url('admin/korban_bencana/');?>" class="btn btn-link">
										<i class="fa fa-arrow-left"></i> Kembali</a>
									</div>
									<div class="notifikasi_berhasil_nik">
										<?php include"form_resgister.php"; ?> 
									</div>
								</div>
							</div>
							<div class="row hide_form_nik">
								<div class="col-md-6">
									<fieldset> 
									<div class="mb-2">Masukkan <span class="text-danger">NIK</span> untuk mengecek data</div>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="sizing-addon1"> 
													<i class="fa fa-user"></i>
												</span>
											</div> 
											<input type="number" class="form-control" placeholder="Masukkan NIK" aria-label="Amount" 
											name="nik" id="nik">
											<div class="input-group-append">
												<button class="btn btn-primary glow position-relative cari_data" type="button"> Cari </button>
											</div>  
										</div>
										<div id='error_nik' class="validasi mt-1"></div>
										<div class="notifikasi_tidak_ditemukan_nik">
											<div class="alert alert-danger alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span></button>
												<div class="d-flex align-items-center">
													<i class="bx bx-error"></i><span>Data tidak ditemukan</span>
                                            	</div>
                                        	</div> 
                                        </div> 
										<div class="notifikasi_duplikasi_nik">
											<div class="alert alert-warning alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<div class="d-flex align-items-center">
													<i class="bx bx-error-circle"></i>
													<span>Maaf, NIK sudah terdaftar</span>
												</div>
											</div> 
										</div> 
									</fieldset> 
									
								</div>
							</div>
							<p> &nbsp; </p>
							
						</div>
					</div>
					<!-- END Bootstrap Contact -->
				</div>
			</div> 		 
        </div> 
    </main>