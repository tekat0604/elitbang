<main id="main-container">
        <div class="content content_padding"> 
			<div class="row"> 
				<div class="col-md-12"> 
					<!-- Bootstrap Contact -->
					<div class="block block-themed"  >
						<div class="block-header" style="background-color: #FFF; border-bottom: 1px solid #e5e5e5; ">
							<h3 class="block-title" style="color: #000!important;"> <i class="fa fa-pencil"></i> Form Ubah Profil Kami </h3>
							<div class="block-options"> 
								<button type="button" class="btn-block-option" 
								data-toggle="block-option" data-action="content_toggle" style="color: #000!important;"><i class="si si-arrow-up"></i></button>
							</div>
						</div>
						<div class="block-content" style>
							<form action="#" method="post" id="submit_form_ubah" autocomplete="off">
								<div class="row">
									<div class="col-md-12">
                                    <div class="form-group row">
											<label class="col-md-3" for="judul">Judul </label>
											<div class="col-md-9">
												<div class="input-group">
													<input type="text" class="form-control" id="ubah_judul" name="judul" placeholder="Judul">
													<div class="input-group-append">
														<span class="input-group-text">
														<i class="fa fa-user-o"></i></span>
													</div>
												</div>
											</div>
										</div> 
                                        <div class="form-group row">
											<label class="col-md-3" for="konten">Konten </label>
											<div class="col-md-9">
                                            <textarea name="konten" id="ubah_konten" class="form-control" 
                                            placeholder="Masukkan Konten"></textarea>
											</div>
										</div> 


                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="nama">Upload Gambar </label> 
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ubah_image" name="image" 
                                                    accept="image/*">
                                                    <label id="ubah_image_label" class="custom-file-label" for="ubah_image">
                                                    Silahkan pilih file...</label> 
                                                </div>
                                                <div class="text-danger text-right" style="margin-left: 110px; font-weight: normal;">
                                                Ukuran Terbaik 500 x 500 px</div> 
                                                <input type="hidden" name="kosongkan_image" id="kosongkan_ubah_image">
                                                <div id="ubah_image_preview_container" class="form-group" 
                                                style="width: 200px; height: auto; overflow:hidden;line-height: auto; 
                                                border:1px solid #dddddd; background-color:#ffffff"> 
                                                </div>
                                            </div>
                                        </div>  
										  
										<div class="form-group row">
											<label class="col-md-3" for="contact1-action"> &nbsp; </span> </label>
											<div class="col-md-9">
												<button type="submit" class="btn btn-alt-success">
												<i class="si si-check"></i> Simpan</button>
											</div>
										</div> 
									
									</div>
									 
								</div>  
							</form>
						</div>
					</div>
					<!-- END Bootstrap Contact -->
				</div>
			</div> 		 
        </div> 
    </main>