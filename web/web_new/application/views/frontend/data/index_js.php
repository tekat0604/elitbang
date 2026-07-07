<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
    <?php foreach ($data as $value_data): ?>
        
	grafik('<?= $value_data->id ?>');  //pemanggilan fungsi tampil barang. 
    <?php endforeach ?> 
    
});

function grafik(id) {
    $.ajax({
        type  : 'ajax', 
        url:'<?php echo base_url();?>admin/frontend/data/data_detail_grafik/'+id,
        async : false,
        dataType : 'json',
        success: function(response){
            console.log(response[0].res);
            Highcharts.chart('container-'+id, {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Detail Data'
                }, 
                xAxis: {
                    categories: response[0].kategori
                },
                yAxis: {
                    title: {
                        text: 'Nilai'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: response[0].res
                //  series: [{
                //     name: 'Tokyo',
                //     data: ["7.0", "6.9", "9.5"]
                // }, {
                //     name: 'London',
                //     data: ["3.9", "4.2", "5.75"]
                // }]
            }); 
        }
    });
    return false;
    
}
</script>