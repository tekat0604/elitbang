<script src="<?= base_url()?>/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        load_table();
    });

    function load_table(input = null) {
        table = $('#table-data').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": false,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('datatables/get_gempa')?>",
                "type": "GET",
            },
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
                emptyTable: 'Tidak ada data'
            },
            "columnDefs": [],
        });
    }

</script>
