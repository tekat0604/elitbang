<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<link rel='stylesheet' href='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css'>
<link rel='stylesheet' href="<?= base_url('assets_frontend/leaflet-custom-searchbox-master/dist/searchbox.min.css')?>">

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js'></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js'></script>
<script src="<?= base_url('assets_frontend/leaflet-custom-searchbox-master/dist/leaflet.customsearchbox.min.js')?>"></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
    var revapi,rsi, marker, mymap, layerGroup, searchboxControl, control;
    var locations = [];
    
    $(document).ready(function() {        
        locations = <?= json_encode([[$row->subjek,$row->lat,$row->lng]])?>;
        initMap(locations);
    });
    
    function initMap(loc){ 
        mymap = L.map('map',{scrollWheelZoom: false}).setView([-7.68256070237871, 110.84268828061613], 11); 
        
        /* show maps */
        locations = loc;
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA'
        }).addTo(mymap);
        
        add_locations(locations);

        //Batas Kecamatan dan Desa
        let batas_kec_json  = base_url+'uploads/geojson/Admin_Kec.geojson'; 
        let batas_kel_json  = base_url+'uploads/geojson/Admin_Desa.geojson';
        let batas_style_kec = (f)=>{
            //console.log(f.properties.KEC);
            let color;
            switch(f.properties.KEC){
                case 'KEC. BENDOSARI'   : color = '#F1B1CE'; break;
                case 'KEC. BULU'        : color = '#A4543B'; break;
                case 'KEC. GATAK'       : color = '#63BECC'; break;
                case 'KEC. BAKI'        : color = '#FECB00'; break; 
                case 'KEC. GROGOL'      : color = '#E40081'; break;
                case 'KEC. KARTASURA'   : color = '#3AA12B'; break;
                case 'KEC. MOJOLABAN'   : color = '#969F7A'; break;
                case 'KEC. NGUTER'      : color = '#D1905A'; break;

                case 'KEC. POLOKARTO'   : color = '#6F3A82'; break;
                case 'KEC. SUKOHARJO'   : color = '#EE7900'; break;
                case 'KEC. TAWANGSARI'  : color = '#008FD2'; break;
                case 'KEC. WERU'        : color = '#E60108'; break;
                default: '';
            }
            return {
                fillColor   : color,
                fillOpacity : 0.3,
                color       : color,
                opacity     : 0.6,
                weight      : 2,
                dashArray   : '3,5',
                dahsOffset  : 0
            }
        }

        let batas_style_kel = (f)=>{ 
            console.log(f);
            return {
                fillColor   : "white",
                fillOpacity : 0,
                color       : "black",
                dashArray   : '3',
                weight      : 1,
                opacity     : 0.5
            }
        }
        $.getJSON(batas_kec_json, function(data) { 
            L.geoJSON(data, {
                style: batas_style_kec
            }).addTo(mymap);
        });

        $.getJSON(batas_kel_json, function(data) { 
            L.geoJSON(data, {
                style: batas_style_kel
            }).addTo(mymap);
        });
    }
    
    function add_locations(){
        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]]/*, {icon: greenIcon}*/)
                .bindPopup(locations[i][0])
                .addTo(mymap);
        }
    }

</script>
