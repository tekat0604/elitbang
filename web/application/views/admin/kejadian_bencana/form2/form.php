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
					<a href="<?php echo base_url('admin/kejadian_bencana/form2'); ?>" class="btn btn-link">
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

						<div class="row mb-10">
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
								<select class="form-control select2" name="id_pelapor" onchange="getForm1(this)" style="width: 300px !important;">
									<option value="">Pilih Pelapor </option>
									<?php
									foreach (@$list_pelapor as $dt_pel) {
										$selected = $dt_pel->id == @$row->id_pelapor ? ' selected="" ' : '';
										echo '<option value="' . $dt_pel->id . '" ' . $selected . '> ' . $dt_pel->nama_pelapor . ' </option>';
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
									<i class="fa fa-user"></i> KEJADIAN BENCANA
								</h3>
							</div>
						</div>

						<div class="row mb-2" hidden>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4">
										<label> GET ID </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="id" value="<?= @$row->id ?>" placeholder="ID">
									</div>
								</div>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6 col-md-12 col-sm-12 ">
								<div class="row mb-3 ">
									<div class="col-md-4">
										<label>Jenis Kejadian</label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="jenis_kejadian" value="<?= @$row->jenis_kejadian ?>" placeholder="Jenis Kejadian">
										<div id="error_jenis_kejadian" class="validasi"></div>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label>Nomor Kejadian</label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="nomor_kejadian" value="<?= @$row->nomor_kejadian ?>" placeholder="Nomor Kejadian">
										<div id="error_nomor_kejadian" class="validasi"></div>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Kecamatan </label>
									</div>
									<div class="col-md-8 ">
										<select class="form-control select2" name="id_kecamatan_kejadian" onchange="getKelurahan(this)">
											<option value="">Pilih Kecamatan </option>
											<?php
											foreach (@$list_kecamatan as $dt_kec) {
												$selected = $dt_kec->id_kecamatan == @$row->id_kecamatan_kejadian ? ' selected="" ' : '';
												echo '<option value="' . $dt_kec->id_kecamatan . '" ' . $selected . '> ' . $dt_kec->nama . ' </option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Kelurahan </label>
									</div>
									<div class="col-md-8 ">
										<select class="form-control select2" name="id_kelurahan_kejadian">
											<option value="">Pilih Kelurahan </option>
											<?php
											foreach (@$list_kelurahan as $dt_kel) {
												$selected = $dt_kel->id_kelurahan == @$row->id_kelurahan_kejadian ? ' selected="" ' : '';
												echo '<option value="' . $dt_kel->id_kelurahan . '" ' . $selected . '> ' . $dt_kel->nama . '  </option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Alamat </label>
									</div>
									<div class="col-md-8 ">
										<textarea name="alamat_kejadian" rows="5" class="form-control"><?= @$row->alamat_kejadian ?></textarea>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 ">
								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Hari </label>
									</div>
									<div class="col-md-8  ">
										<input type="text" class="form-control" name="hari_kejadian" placeholder="Hari Kejadian" value="<?= @$row->hari_kejadian ?>">
										<div id="error_hari_kejadian" class="validasi"></div>
									</div>
								</div>
								<div class="row mb-3 ">
									<div class="col-md-4">
										<label>Tanggal </label>
									</div>
									<div class="col-md-8  ">
										<input type="text" id="tanggal_kejadian" class="form-control" name="tanggal_kejadian" placeholder="Tanggal Kejadian" value="<?= @$row->tanggal_kejadian ?>">
										<div id="error_tanggal_kejadian" class="validasi"></div>
									</div>
								</div>
								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Jam Kejadian (WIB) </label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" name="jam_kejadian" placeholder="Jam Kejadian" value="<?= @$row->jam_kejadian ?>">
										<div id="error_jam_kejadian" class="validasi"></div>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Jam Laporan (WIB) </label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" name="jam_laporan" placeholder="Jam Laporan" value="<?= @$row->jam_laporan ?>">
										<div id="error_jam_laporan" class="validasi"></div>
									</div>
								</div>

								<div class="row mb-3 ">
									<div class="col-md-4">
										<label> Kronologi Kejadian </label>
									</div>
									<div class="col-md-8 ">
										<textarea name="kronologi_kejadian" rows="5" class="form-control"><?= @$row->kronologi_kejadian ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
										<i class="fa fa-user"></i> DAMPAK BENCANA
									</h3>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label> Rusak Ringan </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="rusak_ringan" placeholder="Jumlah Rusak Ringan" value="<?= @$row->jam_laporan ?>">
										<div id="error_rusak_ringan" class="validasi"></div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label> Rusak Sedang </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="rusak_sedang" placeholder="Jumlah Rusak Sedang" value="<?= @$row->jam_laporan ?>">
										<div id="error_rusak_sedang" class="validasi"></div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label> Rusak Berat </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="rusak_berat" placeholder="Jumlah Rusak Berat" value="<?= @$row->rusak_berat ?>">
										<div id="error_rusak_berat" class="validasi"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
										<i class="fa fa-user"></i> DATA KORBAN BENCANA (Orang)
									</h3>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label> Luka Ringan </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="luka_ringan" placeholder="Jumlah Luka Ringan" value="<?= @$row->luka_ringan ?>">
										<div id="error_luka_ringan" class="validasi"></div>
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-md-4">
										<label> Luka Berat </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="luka_berat" placeholder="Jumlah Luka Berat" value="<?= @$row->luka_berat ?>">
										<div id="error_luka_berat" class="validasi"></div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label> Meninggal Dunia </label>
									</div>
									<div class="col-md-8 ">
										<input type="text" class="form-control" name="meninggal_dunia" placeholder="Jumlah Meninggal Dunia" value="<?= @$row->meninggal_dunia ?>">
										<div id="error_meninggal_dunia" class="validasi"></div>
									</div>
								</div>
							</div>
						</div>
						<div> &nbsp; </div>

						<div class="mb-3">
							<h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
								<i class="fa fa-user"></i> ANALISA SWOT ASSESMENT BENCANA
							</h3>
							<div style="font-weight: 800;"> INTERNAL </div>
							<div style="font-weight: 700; color: #444;"> Strenght (Analisis Kekuatan) </div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Personil Yang Bertugas </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_personil()">
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
														<th style="width: auto;" class="text-center"> Nama </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_personil">
													<?php if (@$row->kb_has_personil) {
														foreach (@$row->kb_has_personil as $dt_item) { ?>
															<tr class="atribut_table_personil">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_personil" name="personil[]" value="<?= @$dt_item->nama ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_personil" style="cursor: pointer;">
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
							</div>
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Backup Mako </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_backup_mako()">
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
														<th style="width: auto;" class="text-center"> Nama </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_backup_mako">
													<?php if (@$row->kb_has_backup_mako) {
														foreach (@$row->kb_has_backup_mako as $dt_item) { ?>
															<tr class="atribut_table_backup_mako">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_backup_mako" name="backup_mako[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_backup_mako" style="cursor: pointer;">
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
							</div>
						</div>

						<div> &nbsp; </div>

						<div class="row">
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Peralatan yang akan digunakan </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_peralatan()">
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
														<th style="width: auto;" class="text-center"> Jenis </th>
														<th style="width: 100px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_peralatan">
													<?php if (@$row->kb_has_peralatan) {
														foreach (@$row->kb_has_peralatan as $dt_item) { ?>
															<tr class="atribut_table_peralatan">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_peralatan" name="jenis_peralatan[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_peralatan" name="jumlah_peralatan[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_peralatan" style="cursor: pointer;">
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
							</div>
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Logistik yang akan digunakan </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_logistik()">
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
														<th style="width: auto;" class="text-center"> Jenis </th>
														<th style="width: 100px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_logistik">
													<?php if (@$row->kb_has_logistik) {
														foreach (@$row->kb_has_logistik as $dt_item) { ?>
															<tr class="atribut_table_logistik">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_logistik" name="jenis_logistik[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_logistik" name="jumlah_logistik[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_logistik" style="cursor: pointer;">
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
							</div>
						</div>
						<div> &nbsp; </div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label> Keahlian yang akan digunakan </label>
								<textarea name="keahlian" rows="3" class="form-control"><?= @$row->keahlian ?></textarea>
							</div>
						</div>

						<div class="row mt-3 mb-3">
							<div class="col-md-12">
								<div style="font-weight: 700; color: #444;"> Weakness (Analisis Kelemahan) </div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Butuh Bantuan personil </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_bantuan_personil()">
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
														<th style="width: auto;" class="text-center"> Instansi Asal </th>
														<th style="width: 100px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_bantuan_personil">
													<?php if (@$row->kb_has_bantuan_personil) {
														foreach (@$row->kb_has_bantuan_personil as $dt_item) { ?>
															<tr class="atribut_table_bantuan_personil">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_personil" name="nama_bantuan_personil[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_personil" name="jumlah_bantuan_personil[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_bantuan_personil" style="cursor: pointer;">
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
							</div>
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Butuh Bantuan Peralatan</label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_bantuan_peralatan()">
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
														<th style="width: auto;" class="text-center"> Jenis Peralatan </th>
														<th style="width: 100px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_bantuan_peralatan">
													<?php if (@$row->kb_has_bantuan_peralatan) {
														foreach (@$row->kb_has_bantuan_peralatan as $dt_item) { ?>
															<tr class="atribut_table_bantuan_peralatan">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_peralatan" name="jenis_bantuan_peralatan[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_peralatan" name="jumlah_bantuan_peralatan[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_bantuan_peralatan" style="cursor: pointer;">
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
							</div>
						</div>
						<div> &nbsp; </div>

						<div class="row">
							<div class="col-md-6">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Butuh Bantuan logistik </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_bantuan_logistik()">
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
														<th style="width: auto;" class="text-center"> Nama Barang </th>
														<th style="width: 100px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_bantuan_logistik">
													<?php if (@$row->kb_has_bantuan_logistik) {
														foreach (@$row->kb_has_bantuan_logistik as $dt_item) { ?>
															<tr class="atribut_table_bantuan_logistik">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_logistik" name="jenis_bantuan_logistik[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_bantuan_logistik" name="jumlah_bantuan_logistik[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_bantuan_logistik" style="cursor: pointer;">
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
							</div>
						</div>

						<div> &nbsp; </div>

						<div class="mb-3 mt-2">
							<div style="font-weight: 800;"> EXTERNAL </div>
							<div style="font-weight: 700; color: #444;"> Opportunity (Analisis Peluang) </div>
						</div>

						<div class="row mb-3 ">
							<div class="col-md-12">
								<div>
									<label> Rencana penanganan, evakuasi atau pertolongan yang akan dilakukan </label>
								</div>
								<div>
									<textarea name="rencana_penanganan" rows="3" class="form-control"><?= @$row->rencana_penanganan ?></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="box_list_mutliple">
									<div class="row mb-3">
										<div class="col-md-8">
											<label> Aparat/Relawan yang bergabung </label>
										</div>
										<div class="col-md-4">
											<div class="text-right">
												<button class="btn btn-sm btn-link" type="button" onclick="add_row_aparat_relawan()">
													<i class="fa fa-plus"></i> Tambah
												</button>
											</div>
										</div>
									</div>

									<div class="row mb-3 ">
										<div class="col-md-12">
											<table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
												<thead>
													<tr>
														<th style="width: auto;" class="text-center"> Instansi Asal </th>
														<th style="width: 150px;" class="text-center"> Jumlah </th>
														<th style="width: 80px;" class="text-center"> Aksi </th>
													</tr>
												</thead>
												<tbody id="konten_aparat_relawan">
													<?php if (@$row->kb_has_aparat_relawan) {
														foreach (@$row->kb_has_aparat_relawan as $dt_item) { ?>
															<tr class="atribut_table_aparat_relawan">
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_aparat_relawan" name="nama_aparat_relawan[]" value="<?= $dt_item->nama ?>">
																</td>
																<td style="vertical-align: middle; padding-top: 5px;">
																	<input class="form-control atribut_aparat_relawan" name="jumlah_aparat_relawan[]" value="<?= $dt_item->jumlah ?>">
																</td>
																<td style="text-align: center; vertical-align: middle; padding-top: 5px;">
																	<span class="delete_row_aparat_relawan" style="cursor: pointer;">
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
							</div>
						</div>





						<div style="font-weight: 700; color: #444;" class="mt-2"> Threats (Analisis Ancaman) </div>
						<div class="row mb-3 ">
							<div class="col-md-12">
								<div>
									<label> Dampak Kejadiaan </label>
								</div>
								<div>
									<textarea name="dampak_kejadian" rows="3" class="form-control"><?= @$row->dampak_kejadian ?></textarea>
								</div>
							</div>
						</div>

						<div class="row mb-3 ">
							<div class="col-md-12">
								<div>
									<label> Hambatan </label>
								</div>
								<div>
									<textarea name="hambatan" rows="3" class="form-control"><?= @$row->hambatan ?></textarea>
								</div>
							</div>
						</div>

						<div class="row ">
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