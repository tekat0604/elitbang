<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$(".date_picker").datepicker();
		var base_url = "<?php echo base_url(); ?>";
		Load_Data();
		$(document).on('click', '.hapus', function() {
			var ID = $(this).data('id');
			$("#id_hapus").val(ID);
			console.log(ID)
			$('.modal-title').html('<i class="mdi mdi-alert-outline"></i> Konfirmasi');
		});
		$(document).on('click', '#konfirmasi_hapus', function(q) {
			q.preventDefault();
			var id_hapus = $("#id_hapus").val();
			$.ajax({
				url: base_url + 'operator/korban_jiwa/prosesHapus',
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
		setTimeout(function() {
			$('#tambah_konten').summernote({
				toolbar: [
					['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
					['para', ['ul', 'ol', 'paragraph']],
					['view', ['codeview']]
				],
				height: 300,
				focus: true
			});
			$('#ubah_konten').summernote({
				toolbar: [
					['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
					['para', ['ul', 'ol', 'paragraph']],
					['view', ['codeview']]
				],
				height: 300,
				focus: true
			});
		}, 500);
		$('#tambah_data').click(function() {
			$("#tambah_nik").focus();
			$('#submit_form_tambah')[0].reset();
		});

		$(document).on('click', '.update', function() {
			var get_id = $(this).attr("id");			
			$.ajax({
				url: base_url + 'operator/korban_jiwa/get_korban_jiwa',
				method: "POST",
				data: {
					id: get_id
				},
				dataType: "json",
				success: function(data) {			
					$('#formModalUbah').modal('show');
					$("#ubah_nik").val(data.nik);
					$("#ubah_nama").val(data.nama);
					$("#ubah_kategori").val(data.kategori);
					$("#ubah_jenis_kelamin").val(data.jenis_kelamin);
					$("#ubah_alamat").val(data.alamat);
					$("#ubah_tmpt_lahir").val(data.tmpt_lahir);
					$("#ubah_tgl_lahir").val(data.tgl_lahir);
					$("#ubah_id").val(get_id);
				}
			});
		});

		$(document).on('submit', '#submit_form_tambah', function(event) {
			event.preventDefault();
			var judul = $('#tambah_nik').val();
			if (judul == "") {
				$('.validasi').text('');
				$('#error_nik').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>');
				$('#tambah_nik').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'operator/korban_jiwa/prosesTambah',
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
			var judul = $('#ubah_nik').val();
			if (judul == "") {
				$('.validasi').text('');
				$('#error_ubah_nik').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>');
				$('#ubah_nik').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'operator/korban_jiwa/prosesUbah',
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
				ajax: {
				'url' :base_url + 'operator/korban_jiwa/daftar_korban_jiwa',
				'dataSrc' : 'data',
				} ,
				columns: [
					{
						'data': 'no'
					},
					{
						'data': 'nik'
					},
					{
						'data': 'nama'
					},
					{
						'data': 'jenis_kelamin'
					},
					{
						'data': 'alamat'
					},
					{
						'data': 'tgl_lahir'
					},
					{
						'data': 'tmpt_lahir'
					},
					{
						'data': 'kategori'
					},
					{
						'data': (d) => {
							var btn = '';
							btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 update" id="' + d.id_korban_jiwa + '">';
							btn += '<i class="fa fa-edit"></i> Ubah </button> ';
							btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 hapus"';
							btn += 'data-toggle="modal" data-id="' + d.id_korban_jiwa + '" data-target="#konfirmasi_hapus_modal">';
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
					'sWidth': '100px',
					'sClass': 'text-left',
				}, {
					"aTargets": [2],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-center',
				}, {
					"aTargets": [3],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-left',
				}
				, {
					"aTargets": [5],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-center',
				}, {
					"aTargets": [6],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-center',
				}, {
					"aTargets": [7],
					'bSortable': false,
					'sWidth': '100px',
					'sClass': 'text-center',
				}, {
					"aTargets": [8],
					'bSortable': false,
					'sWidth': '50px',
					'sClass': 'text-center',
				}
			],
			});
		}


		$('#tambah_image').change(function(e) {
			var label_text = $(this).val();
			if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
			$('#tambah_image_label').text(label_text);
			file_preview(this, 'tambah_image');
		});
		$('#ubah_image').change(function(e) {
			var label_text = $(this).val();
			if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
			$('#ubah_image_label').text(label_text);
			file_preview(this, 'ubah_image');
		});

		function file_preview(input, id_name) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#' + id_name + '_preview').remove();
					$('#' + id_name + '_preview_container').html(
						`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
					<img src="` + e.target.result + `" 
					style="width: 100%; height: 100%;vertical-align:middle"/>
					<div style="margin-top: 5px;">
						<button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="` + id_name + `"> 
						<i class="fa fa-remove"></i> Hapus </button>
					</div>  
				</div>			
				`);
					if (id_name == "ubah_image") {
						$('#kosongkan_ubah_image').val('');
					}
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$(document).on('click', '.hapus_image', function() {
			var id_name = $(this).attr("id_name");
			$('#' + id_name + '_preview_container').html('');
			$('#' + id_name + '_label').text('Silahkan pilih file...');
			$('#' + id_name + '').val('');
			if (id_name == "ubah_image") {
				$('#kosongkan_ubah_image').val('1');
			}
		});

	});
</script>
