<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        load_data();
    });

    function load_data() {
        var base_url = '<?php echo base_url(); ?>';
        table = $('#agenda_pimpinan').DataTable({
            "responsive": true,
            destroy: true,
            pagingType: "full_numbers",
            pageLength: 10,
            autoWidth: false,
            ajax: base_url + 'datatables/api_agenda_pimpinan',
            columns: [{
                    'data': (d) => {
                        return d.no;
                    }
                },
                {
                    'data': 'nama_kegiatan'
                },
                {
                    'data': 'tempat_kegiatan'
                },
                {
                    'data': 'tanggal_kegiatan'
                },
                {
                    'data': 'tanggal_kegiatan'
                },
            ],
            "aoColumnDefs": [{
                "aTargets": [0],
                'bSortable': false,
                'sWidth': '30px',
                'sClass': 'text-center',
            }, {
                "aTargets": [1],
                'bSortable': true,
                'sWidth': '250px',
                'sClass': 'text-left',
            }, {
                "aTargets": [2],
                'bSortable': true,
                'sWidth': '100px',
                'sClass': 'text-left',
            }, {
                "aTargets": [3],
                'bSortable': false,
                'sWidth': '100px',
                'sClass': 'text-left',
            }, {
                "aTargets": [4],
                'bSortable': false,
                'sWidth': '100px',
                'sClass': 'text-left',
            }],
        });
    }
</script>