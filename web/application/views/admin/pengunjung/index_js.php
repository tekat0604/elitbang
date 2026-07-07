<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$(".date_picker").datepicker();
		var base_url = "<?php echo base_url(); ?>";
		Load_Data();
		$("tanggal_mulai").keyup(function() {
			Load_Data();
		});

		function Load_Data() {
			var tanggal_mulai = $('#tanggal_mulai').val();
			var tanggal_selesai = $('#tanggal_selesai').val();
			$('#table_data').DataTable({
				destroy: true,
				processing: true,
				serverSide: true,
				ordering: true,
				autoWidth: false,
				sScrollX: false,
				lengthMenu: [
					[10, 25, 50, 100, -1],
					[10, 25, 50, 100, "All"]
				],
				ajax: {
					url: '<?= base_url('admin/pengunjung/') ?>datatable',
					type: 'GET',
					dataType: 'JSON',
					data: {
						tanggal_mulai: tanggal_mulai,
						tanggal_selesai: tanggal_selesai,
					},
				},
				order: [],
				columnDefs: [{
						targets: [0, -1],
						className: 'text-center',
						orderable: false,
						width: '50px',
					},
					{
						targets: [1],
						className: 'text-left',
						orderable: true,
						width: '300px',
					},
					{
						targets: [2],
						className: 'text-center',
						orderable: false,
						width: '300px',
					}
				],
			})
		}
	});
</script>