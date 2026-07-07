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
					url: link_url + 'do_delete',
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
</script>