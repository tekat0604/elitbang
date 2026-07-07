<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> 
<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        Load_mobile();
    });
    function Load_mobile(){
        var base_url = '<?php echo base_url(); ?>';
        table = $('#table-data').DataTable({
            "responsive"    : true,
            destroy         : true,
            pagingType      : "full_numbers",
            pageLength      : 10, 
            autoWidth       : false, 
            ajax            : base_url+'datatables/api_gempa', 
            columns         : [
                {'data': (d)=>{
                    return d.no;
                }},
                {'data': 'waktu'},
                {'data': 'wilayah'},    
                {'data': 'magnitude'},  
                {'data': 'kedalaman'},  
                {'data': 'posisi'},
                {'data': 'keterangan'},
            ],
            "aoColumnDefs"  : [{
                "aTargets"  : [0],
                'bSortable' : false,
                'sWidth'    : '30px',
                'sClass'    : 'text-left',
            },{
                "aTargets"  : [1],
                'bSortable' : true,
                'sWidth'    : '150px',
                'sClass'    : 'text-left',
            },{
                "aTargets"  : [2],
                'bSortable' : true,
                'sWidth'    : '200px',
                'sClass'    : 'text-left',
            },{
                "aTargets"  : [3],
                'bSortable' : false,
                'sWidth'    : '50px',
                'sClass'    : 'text-right',
            },{
                "aTargets"  : [4],
                'bSortable' : true,
                'sWidth'    : '70px',
                'sClass'    : 'text-right',
            },{
                "aTargets"  : [5],
                'bSortable' : false,
                'sWidth'    : '120px',
                'sClass'    : 'text-left',
            },{
                "aTargets"  : [6],
                'bSortable' : false,
                'sWidth'    : '200px',
                'sClass'    : 'text-left',
            }],
        }); 
    } 

</script>
