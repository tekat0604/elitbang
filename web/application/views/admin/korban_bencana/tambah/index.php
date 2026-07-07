<main id="main-container">
	<div class="content content_padding">
		<div class="row">
			<div class="col-md-12">
				<!-- Bootstrap Contact -->
				<div class="block block-themed">
					<div class="block-header" style="background-color: #FFF; border-bottom: 1px solid #e5e5e5; ">
						<h3 class="block-title" style="color: #000!important;">
							<i class="fa fa-plus"></i> Form Tambah Data
						</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" style="color: #000!important;">
								<i class="si si-arrow-up"></i></button>
						</div>
					</div>
					<div class="block-content">
						<div class="row">
							<div class="col-md-12">
								<div class="mb-5 text-right">
									<a href="<?php echo base_url('admin/korban_bencana/'); ?>" class="btn btn-link">
										<i class="fa fa-arrow-left"></i> Kembali</a>
								</div>
								<div>
									<?php include "form_resgister.php"; ?>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- END Bootstrap Contact -->
			</div>
		</div>
	</div>
</main>