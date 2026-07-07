<link rel="stylesheet" href="<?= base_url() ?>/assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        load_table();
    });

    function load_table(input = null) {
        var id_kategori = '<?php echo $this->uri->segment(3); ?>';
        table = $('#table-data').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": false,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('pelayanan_publik/get_data') ?>",
                "type": "GET",
                "data": {
                    id_kategori: id_kategori
                },
            },
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
                emptyTable: 'Tidak ada data'
            },
            "columnDefs": [],
        });
    }
</script>