<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<link rel='stylesheet' href='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css'>
<link rel='stylesheet' href="<?= base_url('assets_frontend/leaflet-custom-searchbox-master/dist/searchbox.min.css') ?>">

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js'></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js'></script>
<script src="<?= base_url('assets_frontend/leaflet-custom-searchbox-master/dist/leaflet.customsearchbox.min.js') ?>"></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var isi_map = <?= json_encode([[$row->subjek, $row->lat, $row->lng]]) ?>;
    var revapi, rsi, marker, mymap, layerGroup, searchboxControl, control;
    var locations = [];

    console.log(isi_map);

    $(document).ready(function() {
        locations = <?= json_encode([[$row->subjek, $row->lat, $row->lng]]) ?>;
        initMap(locations);
    });

    function initMap(loc) {
        mymap = L.map('map', {
            scrollWheelZoom: false
        }).setView([-7.558517689092, 110.82824680176], 15);

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

        let lat = <?= json_encode($row->lat) ?>;
        let lng = <?= json_encode($row->lng) ?>;
        let latlng = [lat, lng];
        mymap.flyTo(latlng);

        //Batas Kecamatan dan Desa
        let batas_kec_json = base_url + 'uploads/geojson/batas_kecamatan_kota_surakarta.json';
        let batas_style_kec = (f) => {
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
                fillOpacity: 0.3,
                color: color,
                opacity: 0.6,
                weight: 2,
                dashArray: '3,5',
                dahsOffset: 0
            }
        }


        $.getJSON(batas_kec_json, function(data) {
            L.geoJSON(data, {
                style: batas_style_kec
            }).addTo(mymap);
        });


    }

    function add_locations() {

        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]] /*, {icon: greenIcon}*/ )
                .bindPopup(locations[i][0])
                .addTo(mymap);
        }
    }
</script>