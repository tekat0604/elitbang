<main id="main-container">
	<div class="content content_padding">
		<style>
			.table_custom_for_multiple thead tr th {
				padding: 2px 10px 2px 10px;
			}

			.box_list_mutliple {
				padding: 10px;
				border: 1px solid rgba(155, 155, 155, 0.8);
				border-style: dashed;
			}
		</style>
		<div class="row">
			<div class="col-md-12">
				<div class="mb-1 text-right">
					<a href="<?php echo $link_url; ?>" class="btn btn-link">
						<i class="fa fa-arrow-left"></i> Kembali</a>
				</div>
			</div>
		</div>
		<div class="block block-themed">
			<div class="block-header" style="background-color: #FFF; border-bottom: 1px solid #e5e5e5; ">
				<h3 class="block-title" style="color: #000!important;">
					<i class="fa fa-plus"></i> Form Tambah Data
				</h3>
				<div class="block-options">
					<button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle" style="color: #000!important;">
						<i class="si si-arrow-up"></i>
					</button>
				</div>
			</div>
			<div class="block-content">
				<form class="form form-horizontal" onsubmit="event.preventDefault();do_submit(this);">
					<div class="form-body">
						<div class="row mb-3">
							<div class="col-md-12">
								<label> ID </label>
								<div>
									<input type="text" name="id" class="form-control" value="<?= @$row->id ?>">
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
									<i class="fa fa-user"></i> FORM A1
								</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label> Pelapor </label>
							</div>
							<div class="col-md-6">
								<select class="form-control select2" name="id_form_1" onchange="getForm1(this), get_select_from2(this)" style="width: 300px !important;">
									<option value="">Pilih Pelapor </option>
									<?php
									foreach (@$list_form1 as $dt_form1) {
										$selected = $dt_form1->id == @$row->id_form_1 ? ' selected="" ' : '';
										echo '<option value="' . $dt_form1->id . '" ' . $selected . '> ' . $dt_form1->nama_pelapor . ' </option>';
									}
									?>
								</select>
								<div id="konten_form1"></div>
							</div>
						</div>
						<div> &nbsp; </div>


						<div class="row mb-10">
							<div class="col-md-12">
								<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
									<i class="fa fa-user"></i> FORM A2
								</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label> Kejadian Bencana </label>
							</div>
							<div class="col-md-6">
								<select class="form-control select2" name="id_form_2" onchange="getForm2(this)" style="width: 300px !important;">
									<option value="">Pilih Nomor Kejadian </option>
									<?php
									foreach (@$list_form2 as $dt_form2) {
										$selected = $dt_form2->id == @$row->id_form_2 ? ' selected="" ' : '';
										echo '<option value="' . $dt_form2->id . '" ' . $selected . '> ' . $dt_form2->nomor_kejadian . ' </option>';
									}
									?>
								</select>
							</div>
						</div>
						<div id="konten_form2"></div>
						<div> &nbsp; </div>
						<div class="row mt-3 mb-1">
							<div class="col-md-12">
								<div class="">
									<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
										<i class="fa fa-user"></i> DAMPAK BENCANA
									</h3>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label> Kerugian </label>
								<div>
									<textarea name="kerugian" class="form-control" rows="3"><?= @$row->kerugian ?></textarea>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>

						<div class="row mb-1">
							<div class="col-md-12">
								<div class="">
									<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
										<i class="fa fa-user"></i> DATA KORBAN BENCANA (Orang)
									</h3>
								</div>
							</div>
						</div>

						<div class="box_list_mutliple">
							<div class="row mb-3">
								<div class="col-md-10">
									<div class="text-center">
										<label> List Data Korban </label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="text-right">
										<button class="btn btn-sm btn-link" type="button" onclick="add_row_korban()">
											<i class="fa fa-plus"></i> Tambah
										</button>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-md-12">
									<table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
										<thead>
											<tr>
												<th style="width: auto;" class="text-center"> Isian </th>
												<th style="width: 80px;" class="text-center"> Aksi </th>
											</tr>
										</thead>
										<tbody id="konten_korban">
											<?php if (@$row->kb_has_korban) {
												foreach (@$row->kb_has_korban as $dt_item) { ?>
													<tr class="atribut_table_korban">
														<td style="vertical-align: middle; padding-top: 5px;">
															<div style="float: left; width: 200px;"> Rumah Sakit Rujukan </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="rs_rujukan_korban[]" value="<?= $dt_item->rs_rujukan ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>

															<div style="float: left; width: 200px;"> Alamat </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="alamat_korban[]" value="<?= $dt_item->alamat ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>

															<div style="float: left; width: 200px;"> Nama </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="nama_korban[]" value="<?= $dt_item->nama ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>

															<div style="float: left; width: 200px;"> Jenis Identitas </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="jenis_identitas_korban[]" value="<?= $dt_item->jenis_identitas ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>

															<div style="float: left; width: 200px;"> Nomor Identitas </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="nomor_identitas_korban[]" value="<?= $dt_item->nomor_identitas ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>

															<div style="float: left; width: 200px;"> Ciri-ciri </div>
															<div style="float: left; width: 600px;">
																<input class="form-control atribut_korban" name="ciri_ciri_korban[]" value="<?= $dt_item->ciri_ciri ?>">
															</div>
															<div style="clear: both; height: 10px;"></div>
															<hr style="background-color: #ff0000; color: #0000FF;">
														</td>
														<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
															<span class="delete_row_korban" style="cursor: pointer;">
																<i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
															</span>
														</td>
													</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label> KAJIAN KEBUTUHAN LOGISTIK/ PERALATAN/PEMULIHAN PASCA BENCANA</label>
								<div>
									<textarea name="kajian_kebutuhan" class="form-control" rows="3"><?= @$row->kajian_kebutuhan ?></textarea>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>
						<div class="row mb-3">
							<div class="col-md-12">
								<div> &nbsp; </div>
								<div class="text-right">
									<button type="submit" class="btn btn-primary mr-2 mb-1">
										<i class="fa fa-check-circle"></i> Simpan
									</button>
									<button type="reset" class="btn btn-light-secondary mr-1 mb-1 btn_reset">
										Reset
									</button>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>