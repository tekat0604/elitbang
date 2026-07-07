<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
$(document).ready(function(){
    
});
setTimeout(function(){ 
        garfik_laporan_aduan();
        garfik_berita();
        garfik_korban();
        garfik_pengunjung();
}, 1);
function garfik_laporan_aduan(){
    $.ajax({
        type        : 'ajax', 
        url         : '<?= base_url() ?>admin/grafik/api',
        async       : false,
        dataType    : 'json',
        success     : function(response){
            //console.log(response);
            var $kategori = []; 
            if(response.data_laporan.length > 0){
                for (var i = 0; i < response.data_laporan.length; i++) {  
                    $kategori[i] = response.data_laporan[i].kategori;
                }
            }
            var $total_laporan = []; 
            if(response.data_laporan.length > 0){
                for (var i = 0; i < response.data_laporan.length; i++) {  
                    $total_laporan[i] = response.data_laporan[i].total_laporan;
                }
            }  
            var ctx = document.getElementById("grafikBatangAduan").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: $kategori,
                    datasets: [{
                        label: '# Jumlah Laporan/Aduan',
                        data: $total_laporan,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',

                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            }); 
        }
    });
}

function garfik_berita(){
    $.ajax({
        type        : 'ajax', 
        url         : '<?= base_url() ?>admin/grafik/api',
        async       : false,
        dataType    : 'json',
        success     : function(response){
            //console.log(response);
            var $kategori = []; 
            if(response.data_berita.length > 0){
                for (var i = 0; i < response.data_berita.length; i++) {  
                    $kategori[i] = response.data_berita[i].kategori;
                }
            }
            var $total_berita = []; 
            if(response.data_berita.length > 0){
                for (var i = 0; i < response.data_berita.length; i++) {  
                    $total_berita[i] = response.data_berita[i].total_berita;
                }
            }  
            var ctx = document.getElementById("grafikBatangBerita").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: $kategori,
                    datasets: [{
                        label: '# Jumlah Berita',
                        data: $total_berita,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',

                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            }); 
        }
    });

}

function garfik_korban(){
    $.ajax({
        type        : 'ajax', 
        url         : '<?= base_url() ?>admin/grafik/api',
        async       : false,
        dataType    : 'json',
        success     : function(response){
            var $kategori = []; 
            if(response.data_korban.length > 0){
                for (var i = 0; i < response.data_korban.length; i++) {  
                    $kategori[i] = response.data_korban[i].kategori;
                }
            }
            var $total_korban = []; 
            if(response.data_korban.length > 0){
                for (var i = 0; i < response.data_korban.length; i++) {  
                    $total_korban[i] = response.data_korban[i].total_korban;
                }
            }
            var ctx = document.getElementById("grafikBatangKorbanBencana").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: $kategori,
                    datasets: [{
                        label: '# Jumlah Laporan/Aduan',
                        data: $total_korban,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',

                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            }); 
        }
    });
}
function garfik_pengunjung(){
    $.ajax({
        type        : 'ajax', 
        url         : '<?= base_url() ?>admin/grafik/statistik',
        async       : false,
        dataType    : 'json',
        success     : function(response){            
            var ctx = document.getElementById("grafikPengunjung").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['pengunjung hari ini','pengunjung online', 'total pengunjung'],
                    datasets: [{
                        label: '# Statistik Pengunjung',
                        data: [response.pengunjunghariini, response.pengunjungonline, response.totalpengunjung],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',

                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            }); 
        }
    });
}
</script>