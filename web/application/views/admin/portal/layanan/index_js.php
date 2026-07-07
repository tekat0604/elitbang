<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		var base_url = "<?php echo base_url(); ?>";
		Load_Data();
		$(document).on('click', '.hapus', function() {
			var ID = $(this).data('id');
			$("#id_hapus").val(ID);
			$('.modal-title').html('<i class="mdi mdi-alert-outline"></i> Konfirmasi');
		});
		$(document).on('click', '#konfirmasi_hapus', function(q) {
			q.preventDefault();
			var id_hapus = $("#id_hapus").val();
			$.ajax({
				url: base_url + 'admin/portal/layanan/prosesHapus',
				method: "POST",
				dataType: 'JSON',
				data: {
					id: id_hapus
				},
				success: function(res) {
					if (res == "ok") {
						Swal.fire({
							title: 'Sukses!',
							text: 'Data berhasil di hapus.',
							type: 'success',
							timer: 1500
						});
						$('#hapus_form')[0].reset();
						$('#konfirmasi_hapus_modal').modal('hide');
						Load_Data();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Gagal',
							text: 'Data gagal di hapus.',
							type: 'error',
						});
					}
				}
			});
		});

		$('#tambah_data').click(function() {
			$("#tambah_judul").focus();
			setTimeout(function() {
				$('#tambah_file_preview_container').html("");
				$('#tambah_file_label').text("");
			}, 500);
			$('#submit_form_tambah')[0].reset();
		});

		$(document).on('click', '.fileinput-exists', function() {
			setTimeout(function() {
				$('#tambah_file_preview_container').html("");
				$('#tambah_file_label').text("");
				$('#ubah_file_preview_container').html("");
				$('#ubah_file_label').text("");
			}, 100);
		});

		$(document).on('click', '.update', function() {
			$('#ubah_file_label').text("");
			var get_id = $(this).attr("id");
			$.ajax({
				url: base_url + 'admin/portal/layanan/get_id',
				method: "POST",
				data: {
					id: get_id
				},
				dataType: "json",
				success: function(data) {
					var src_file = base_url + 'uploads/layanan/' + data.file;
					$('#formModalUbah').modal('show');
					$("#ubah_judul").val(data.judul);
					$("#ubah_id").val(get_id);
					setTimeout(function() {
						if (data.file != '') {
							$('#ubah_file_preview_container').html(
								`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
								<img src="` + base_url + `assets/img/icon_document.png"
								style="width: 50px; margin-right: 5px; "/><br>` + data.file + `
							</div>
							<div>
							<a href="` + src_file + `" target="_blank"> ` + data.file + ` </a>
							</div>
							<div style="margin-top: 5px;" align="left">
								<button type="button" class="btn btn-sm  btn-danger hapus_file" id_name="ubah_file"> 
								<i class="fa fa-remove"></i> Hapus </button>
							</div>
						`);
						} else {
							$('#isi_file_unduhan').html("tidak");
							$('#ubah_file_preview_container').html('');
						}
						$('#kosongkan_ubah_file').val('');
					}, 500);
				}
			});
		});

		$(document).on('submit', '#submit_form_tambah', function(event) {
			event.preventDefault();
			var judul = $('#tambah_judul').val();
			var extension = $('#tambah_file').val().split('.').pop().toLowerCase();
			if (extension != '') {
				$('.validasi').text('');
				if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
					Swal.fire({
						icon: 'warning',
						title: 'Warning!',
						text: 'File Gambar/Dokumen tidak sesuai! ',
						type: 'warning'
					});
					$('#tambah_file_preview_container').html('');
					$('#tambah_file_label').text('Silahkan pilih file...');
					$('#tambah_file').val('');
					return false;
				}
			}
			if (judul == "") {
				$('.validasi').text('');
				$('#error_tambah_judul').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>');
				$('#tambah_judul').focus();
			} else {
				alert("masuk");
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'admin/portal/layanan/prosesTambah',
					method: "POST",
					data: new FormData(this),
					dataType: 'JSON',
					contentType: false,
					processData: false,
					success: function(res) {
						if (res == "ok") {
							Swal.fire({
								title: 'Sukses!',
								text: 'Data berhasil disimpan!',
								type: 'success',
								timer: 1500
							});
							$('#submit_form_tambah')[0].reset();
							$('#formModalTambah').modal('hide');
							Load_Data();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: 'Data gagal di simpan.',
								type: 'error',
							});
						}
					}
				});

			}



		});
		//Edit Kegiatan
		$(document).on('submit', '#submit_form_ubah', function(event) {
			event.preventDefault();
			var judul = $('#ubah_judul').val();
			var extension = $('#ubah_file').val().split('.').pop().toLowerCase();

			if (extension != '') {
				$('.validasi').text('');
				if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'txt']) == -1) {
					Swal.fire({
						icon: 'warning',
						title: 'Warning!',
						text: 'File Gambar tidak sesuai!',
						type: 'warning'
					});
					$('#ubah_file_preview_container').html('');
					$('#ubah_file_label').text('Silahkan pilih file...');
					$('#ubah_file').val('');
					return false;
				}
			}
			if (judul == "") {
				$('.validasi').text('');
				$('#error_ubah_judul').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>');
				$('#ubah_judul').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'admin/portal/layanan/prosesUbah',
					method: "POST",
					data: new FormData(this),
					dataType: 'JSON',
					contentType: false,
					processData: false,
					success: function(res) {
						if (res == "ok") {
							Swal.fire({
								icon: 'success',
								title: 'Sukses!',
								text: 'Data berhasil disimpan!',
								type: 'success',
								timer: 1500
							});
							$('#submit_form_ubah')[0].reset();
							$('#formModalUbah').modal('hide');
							Load_Data();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: 'Data Gagal disimpan!',
								type: 'error',
							});
						}
					}
				});
			}
		});

		function Load_Data() {
			table = $('#myTable').DataTable({
				destroy: true,
				pagingType: "full_numbers",
				//columnDefs	: [ { orderable: true, targets: [ 4 ] } ],
				pageLength: 10,
				autoWidth: false,
				ajax: base_url + 'admin/portal/layanan/get_data',
				columns: [{
						'data': (d) => {
							return d.no;
						}
					},
					{
						'data': 'judul'
					},

					{
						'data': (d) => {
							var unduhan = '';
							if (d.file == null || d.file == "") {
								unduhan += "";
							} else {
								unduhan += '<a href="' + base_url + 'uploads/layanan/' + d.file + '" target="_blank"> <i class="fa fa-download"></i> Download </a>';
							}
							return unduhan;
						}
					},
					{
						'data': (d) => {
							var btn = '';
							btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 update" id="' + d.id + '">';
							btn += '<i class="fa fa-edit"></i> Ubah </button> ';
							btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 hapus"';
							btn += 'data-toggle="modal" data-id="' + d.id + '" data-target="#konfirmasi_hapus_modal">';
							btn += '<i class="fa fa-trash"></i> Hapus </button>';
							return btn;
						}
					},
				],
				"aoColumnDefs": [{
					"aTargets": [0],
					'bSortable': false,
					'sWidth': '50px',
					'sClass': 'text-center',
				}, {
					"aTargets": [1],
					'bSortable': false,
					'sWidth': '150px',
					'sClass': 'text-left',
				}, {
					"aTargets": [2],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-center',
				}, {
					"aTargets": [3],
					'bSortable': false,
					'sWidth': '150px',
					'sClass': 'text-center',
				}],
			});
		}


		$('#tambah_file').change(function(e) {
			var label_text = $(this).val();
			if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
			$('#tambah_file_label').text(label_text);
			file_preview_img_pdf(this, 'tambah_file');
		});

		$('#ubah_file').change(function(e) {
			var label_text = $(this).val();
			if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
			$('#ubah_file_label').text(label_text);
			file_preview_img_pdf(this, 'ubah_file');
		});

		function file_preview_img_pdf(input, id_name) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#' + id_name + '_preview').remove();
					var myStr = input.files[0].type;
					var strArray = myStr.split("/");
					if (strArray[0] != "image") {
						$('#' + id_name + '_preview_container').html(
							`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
						<img src="` + base_url + `/assets/img/icon_document.png"
						style="width: 50px; margin-right: 5px; "/><br>` + input.files[0].name + `</div>
						<div style="margin-top: 5px;" align="left">
							<button type="button" class="btn btn-sm btn-danger hapus_file" id_name="` + id_name + `"> 
							<i class="fa fa-remove"></i> Hapus </button>
						</div>
					`);
						if (id_name == "ubah_file") {
							$('#kosongkan_ubah_file').val('');
						}
					} else {
						$('#' + id_name + '_preview_container').html(`
					<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
						<img src="` + e.target.result + `" 
						style="width: 100%; height: 100%;vertical-align:middle"/>
						<div style="margin-top: 5px;" align="left">
							<button type="button" class="btn btn-sm btn-danger hapus_file" id_name="` + id_name + `"> 
							<i class="fa fa-remove"></i> Hapus </button>
						</div>  
					</div>			
					`);
						if (id_name == "ubah_file") {
							$('#kosongkan_ubah_file').val('');
						}
					}
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$(document).on('click', '.hapus_file', function() {
			var id_name = $(this).attr("id_name");
			$('#' + id_name + '_preview_container').html('');
			$('#' + id_name + '_label').text('Silahkan pilih file...');
			$('#' + id_name + '').val('');
			if (id_name == "ubah_file") {
				$('#kosongkan_ubah_file').val('1');
			}
		});

	});
</script>