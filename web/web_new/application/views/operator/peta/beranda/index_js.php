

<!-- <script src="./Leaflet-1.0.3/leaflet.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>	
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.js"></script>
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.ajax.min.js"></script>
<!-- <script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.ajax.js"></script> -->
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet-esri.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>



<script>
  var mymap = L.map('map', { zoomControl: false }).setView([-7.5519941, 110.8003075], 17);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 13,
    attribution: 'Map data   OpenStreetMap contributors.',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
}).addTo(mymap);


let batas = 'https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/uploads/geojson/batas_kecamatan_kota_surakarta.json';

let batas_style = (f) => {
    let color;
    switch (f.properties.Kecamatan) {
        case 'Kecamatan Laweyan':
            color = '#158fbf';
            break;
        case 'Kecamatan Serengan':
            color = '#f2c063';
            break;
        case 'Kecamatan Pasar Kliwon':
            color = '#06bf56';
            break;
        case 'Kecamatan Jebres':
            color = '#41d9d9';
            break;
        case 'Kecamatan Banjarsari':
            color = '#f24141';
            break;
        default:
            '';
    }
    return {
        fillColor: color,
        fillOpacity: 0.5,
        color: color,
        opacity: 0.8,
        weight: 2,
        dashArray: '3,5',
        dahsOffset: 0
    }
}

$.getJSON(batas, function(data) {
    L.geoJSON(data, {
        style: batas_style
    }).addTo(mymap);
})


</script>


<script>
     $.ajax({
            url: 'peta/get_data',
            type: "POST",
            dataType: "json",
            success: function(data){
                // for (let index = 0; index < array.length; index++) {
                //     const element = array[index];
                    
                // }
              data.forEach(element => {
                  console.log(data)
                $.each(element.result, function( index, value ) {
                const ijo = (() => {
                  if (value.status == 'Responded') {
                    return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="'+value.content+ '" class="text-success col-6 click">'+ value.status +'</span>';
                    } else if (value.status == 'Process') {
                    return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="'+value.content+'"class="text-warning col-6 click">'+ value.status +'</span>';
                    } else {
                        return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="'+value.content+'" class="text-warning col-6 click">'+ value.status +'</span>';
                    }
                })();
                $(document).on("click", ".click", function () {
                    var myBookId = $('#click').data('id');
                    $(".modal-body").val( myBookId );
                    $(".modal-body h5").text(myBookId);
                    console.log(myBookId)
                    // As pointed out in comments, 
                    // it is unnecessary to have to manually call the modal.
                    // $('#addBookDialog').modal('show');
                });
                var result;

                // Slice is JS function
                result = value.content.slice(0, 100)+'.....';
                const marker = L.marker([value.lat, value.long]).bindPopup('Judul : '+value.title+ijo+'<br><b>Unit : </b>'+value.unit_del+'<br><b>Kategori : </b>'+value.cat+'<br><b>Tanggal : </b>'+value.tgl_sug+'<br><b>Nama : </b>'+value.name+'<br><b>Email : </b>'+value.mail+'<br><b>Telepon : </b>'+value.telp+'<br><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="'+value+'"><b>Deskripsi : </b>'+result+'</span><br><a data-toggle="modal" data-target="#exampleModal" id="click" data-id="'+value+'" class="text-info col-6 click">Selengkapnya</a>').addTo(mymap);         
                    });    
              });            
            },
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        })

</script>
<!-- END Main Container -->