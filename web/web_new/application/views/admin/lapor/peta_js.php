<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="<?= base_url('assets/L.KML.js')?>"></script>
<script>
    var locations = [];
    var marker, mymap, layerGroup;
    $(document).ready(function(){
        locations = <?= json_encode($locations)?>;
        initMap(locations);
        
        // Make basemap
        /*const map = new L.Map('map', {center: new L.LatLng(-7.5596766, 110.8213025), zoom: 13},)
        , osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')

        map.addLayer(osm)

        // Load kml file
        fetch('https://investasi.surakarta.go.id/assets/fronts/banjarsari1.kml')
              .then( res => res.text() )
              .then( kmltext => {

                    // Create new kml overlay
                    parser = new DOMParser();
                    kml = parser.parseFromString(kmltext,"text/xml");

                    console.log(kml)

                    const track = new L.KML(kml)
                    map.addLayer(track)

                    // Adjust map to show the kml
                    const bounds = track.getBounds()
                    map.fitBounds( bounds )
              })*/
    });
    
    function initMap(loc, redraw=null){
        if(redraw){
            locations=[];
            mymap.remove();
        }
        locations = loc;
        mymap = L.map('map',{scrollWheelZoom: false}).setView([-7.5596766, 110.8213025], 12);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA'
        }).addTo(mymap);
        
        add_locations(locations);
    }
    
    var greenIcon = L.icon({
        iconUrl: 'https://i.pinimg.com/originals/86/fd/17/86fd17769a3b2537d2b028601cda7b92.png',
        //shadowUrl: '',

        iconSize:     [30, 35], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    
    function add_locations(){
        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]]/*, {icon: greenIcon}*/)
                .bindPopup(locations[i][0])
                .addTo(mymap);
        }
    }
    
    function refresh_map(input){
        $('.panel-count').css({'background-color':'white'});
        $('#'+input).css({'background-color':'#8fb1c9'});
        $.ajax({
            url: '<?= base_url('admin/lapor/get_maps/')?>'+input,
            type: 'get',
            data: {},
            contentType: false,
            cache: false,
            processData:false,
            dataType: "JSON",
            success: function(response){
                initMap(response, true);
            },
            error: function(){
                alert('Gagal terhubung ke server');
            }
        });
    }

</script>