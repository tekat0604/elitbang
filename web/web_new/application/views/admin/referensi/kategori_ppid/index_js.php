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
				url: base_url + 'admin/kategori_ppid/prosesHapus',
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
			$("#tambah_kategori").focus();
			$('#submit_form_tambah')[0].reset();
		});

		$(document).on('click', '.update', function() {
			var get_id = $(this).attr("id");
			$.ajax({
				url: base_url + 'admin/kategori_ppid/get_id',
				method: "POST",
				data: {
					id: get_id
				},
				dataType: "json",
				success: function(data) {
					$('#formModalUbah').modal('show');
					$("#ubah_kategori").val(data.nama_kategori);
					$("#ubah_id").val(get_id);
				}
			});
		});

		$(document).on('submit', '#submit_form_tambah', function(event) {
			event.preventDefault();
			var kategori = $('#tambah_kategori').val();
			if (kategori == "") {
				$('.validasi').text('');
				$('#error_tambah_kategori').html('<p class="text-danger"> <i class="fa fa-warning"></i> Nama Kategori tidak boleh kosong</p>');
				$('#tambah_kategori').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'admin/kategori_ppid/prosesTambah',
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
			var kategori = $('#ubah_kategori').val();
			if (kategori == "") {
				$('.validasi').text('');
				$('#error_ubah_kategori').html('<p class="text-danger"> <i class="fa fa-warning"></i> Nama kategori tidak boleh kosong</p>');
				$('#ubah_kategori').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'admin/kategori_ppid/prosesUbah',
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
				pageLength: 10,
				autoWidth: false,
				ajax: base_url + 'admin/kategori_ppid/get_data',
				columns: [{
						'data': (d) => {
							return d.no;
						}
					},
					{
						'data': 'nama_kategori'
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
					'sWidth': '400px',
					'sClass': 'text-left',
				}, {
					"aTargets": [2],
					'bSortable': false,
					'sWidth': '200px',
					'sClass': 'text-center',
				}],
			});
		}

	});
</script>