<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhEuzRypAQIK2FaN3Kbq8lp_C5nIi6SOE&callback=initMap"></script>
<script>
    $(document).ready(function(){

    });
    function initMap() {
        var myLatLng = {lat: <?= $data->lat?>, lng: <?= $data->lng?>};
        var infoWindow = new google.maps.InfoWindow();
        
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: '<?= $data->lokasi?>'
        });
        
        infoWindow.setContent('<?= $data->lokasi?>');
        infoWindow.open(map,marker);
    }
    
    function go_to(url=null){
        if(url){
            location.href = url;
        } else{
            alert('Url is empty');
        }
    }
    
    <?php if($can_reply==true){?>
    $('#form_pesan').on('submit', function(){
        $('#btn-simpan').prop('disabled',true);
        $('#btn-simpan').html('<?= '<img style="width: 20px; margin-top: 0px; margin-bottom: 0px;" src="'.base_url('assets_frontend/gif/loading.gif').'"> Mengirim...'?>');
        
        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method');
        $.ajax({
            url: url,
            type: type,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "JSON",
            success: function(response){
                if(response.status==true){
                    alert(response.message);
                } else{
                    alert(response.message);
                }
                $('#btn-simpan').html('<i class="fa fa-send mr-5"></i> Kirim Balasan');
                $('#btn-simpan').prop('disabled',false);
            },
            error: function(){
                alert('Gagal terhubung ke server');
                $('#btn-simpan').html('<i class="fa fa-send mr-5"></i> Kirim Balasan');
                $('#btn-simpan').prop('disabled',false);
            }
         });
        
        return false;
    })
    <?php } ?>
</script>