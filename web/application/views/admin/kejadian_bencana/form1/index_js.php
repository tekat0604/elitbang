<script>
	let link_url = '<?= $link_url ?>';
	var title = '<?= $title ?>';
	$(document).ready(function() {
		load_table();
	});

	function load_table() {
		$('#table_data').DataTable({
			destroy: true,
			processing: true,
			serverSide: true,
			ordering: true,
			autoWidth: false,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			ajax: {
				url: link_url + 'datatable',
				type: 'GET',
				dataType: 'JSON',
			},
			order: [],
			columnDefs: [{
				targets: [0, -1],
				className: 'text-center',
				orderable: false,
			}],
		})
	}

	function tambah() {
		$.ajax({
			type: "POST",
			url: link_url + 'tambah',
			dataType: "JSON",
			data: {},
			beforeSend: function(res) {
				Swal.fire({
					title: 'Loading ...',
					html: '<i  class="fa fa-refresh fa-spin" style="font-size: 24px;"></i>',
					allowOutsideClick: false,
					showConfirmButton: false,
				});
			},
			complete: function(res) {
				Swal.close();
			},
			success: function(res) {
				if (res.status == 'success') {
					$('#myModal .modal-title').html('Tambah <?= $title ?>');
					$('#myModal').modal('show');
					$('#myModal .modal-content .block-content').html(res.html);
				}
			}
		});
	}

	function ubah(id) {
		$.ajax({
			type: "POST",
			url: link_url + 'ubah',
			dataType: "JSON",
			data: {
				id: id,
			},
			beforeSend: function(res) {
				Swal.fire({
					title: 'Loading ...',
					html: '<i  class="fa fa-refresh fa-spin" style="font-size: 24px;"></i>',
					allowOutsideClick: false,
					showConfirmButton: false,
				});
			},
			complete: function(res) {
				Swal.close();
			},
			success: function(res) {
				if (res.status == 'success') {
					$('#myModal .modal-title').html('Ubah <?= $title ?>');
					$('#myModal').modal('show');
					$('#myModal .modal-content .block-content').html(res.html);
				}
			}
		});
	}

	function hapus(id) {
		Swal.fire({
			title: 'Hapus Data  ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Batal',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: link_url + 'do_submit',
					data: {
						hapus: true,
						id: id,
					},
					dataType: "JSON",
					beforeSend: function(res) {
						Swal.fire({
							title: 'Loading ...',
							html: '<i style="font-size:25px;" class="fa fa-sync fa-spin"></i>',
							allowOutsideClick: false,
							showConfirmButton: false,
						});
					},
					complete: function(res) {
						//Swal.close();
					},
					success: function(res) {
						if (res.status == 'success') {
							Swal.fire({
									icon: 'success',
									title: 'Data Berhasil dihapus',
									showConfirmButton: true,
									html: '<i  class="fa fa-check text-success" style="font-size: 36px;"></i>',
								})
								.then(() => {
									$('#table_data').DataTable().ajax.reload();
								});
						}
					}
				});
			} else {
				return false;
			}
		})
	}

	function do_submit(dt) {
		var get_id = $("input[name=id]").val();
		var kosongkan_file = $("input[name=kosongkan_file]").val();
		var image = $("input[name=image]").val();
		if (get_id != '') {
			if (image == "" && kosongkan_file == "1") {
				toastr.warning('image Harus di isi');
				$("input[name=image]").focus();
				$(".box_image").css('border', '1px solid #ff0000', 'padding', '10px !important');
				return false;
			}
		} else {
			if (image == "") {
				toastr.warning('image Harus di isi');
				$("input[name=image]").focus();
				$(".box_image").css('border', '1px solid #ff0000', 'padding', '10px !important');
				return false;
			}
		}

		$.ajax({
			type: "POST",
			url: link_url + 'do_submit',
			data: new FormData(dt),
			dataType: "JSON",
			contentType: false,
			processData: false,
			beforeSend: function(res) {
				Swal.fire({
					title: 'Loading ...',
					html: '<i style="font-size:25px;" class="fa fa-sync fa-spin"></i>',
					allowOutsideClick: false,
					showConfirmButton: false,
				});
			},
			complete: function(res) {
				//Swal.close();
			},
			success: function(res) {
				if (res.status == 'success') {
					Swal.fire({
						icon: 'success',
						title: 'Data Berhasil disimpan',
						allowOutsideClick: false,
						showConfirmButton: false,
						html: '<i  class="fa fa-check text-success" style="font-size: 36px;"></i>',
					});
					setTimeout(function() {
						$('#myModal').modal('hide');
						Swal.close();
						//$('#table_data').DataTable().ajax.reload();
						load_table();
					}, 2000);
				}
			}
		});
	}
</script>