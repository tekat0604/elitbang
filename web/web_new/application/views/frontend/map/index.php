<html class="no-js" lang="en">

<style>
    .container-fluid{
        padding:0px 0px 10px 0px;
    }
    #map{
        width: 100%;
        height: 500px;
    }
    .leaflet-control-container .leaflet-control #controlbox{ 
        top: -4px;
    } 
    .leaflet-control-container .leaflet-control #controlbox #boxcontainer div:nth-child(2){ 
        margin-top: 3px!important;
    } 
    .leaflet-control-container .leaflet-control .panel{  
        background: rgba(255,255,255,0.95)!important;  
        margin-top: 10px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-header{  
        border-bottom: 2px solid rgba(255,235,200,0.9)!important;
        border-right: 2px solid rgba(255,235,200,0.9)!important;
    }
    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container{ 
        background: #e87a37!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container .panel-header-title{ 
        color           : #FFF!important;
        font-size       : 18px!important;
        line-height     : 24px!important;
        padding-top     : 13px!important;
        padding-bottom  : 13px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item{ 
        padding: 0px!important;
    } 
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button{ 
        color: #444!important;
    }  
    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button:hover{ 
        color: #e87a37!important;
    } 
    #tabel_pesebaran tr td{  
         padding: 5px 5px 5px 5px;
         box-shadow: none!important;
    } 
</style> 


<body data-mobile-nav-style="classic">
    
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>/images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
        <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                    <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                        <ul class="xs-text-center">
                            <li>Dashboard</li>
                            <li><a href="#" class="text-white-hover">Profil</a></li>
                        </ul>
                    </div>
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Peta</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <section class="white-wrapper" style="padding: 10px 0 0 0;">
        <div class="container">
            <div class="general-title">
                <h2>Peta Persebaran Titik Bencana</h2>
                <hr>
            </div><!-- end general title -->
        </div><!-- end container -->
        <div id="map" style="margin-top: 20px;"></div>
        <div class="clearfix"></div>  
    </section>

    <section class="half-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">

                    <div id="map" style="width:100%;height:440px"></div>

                </div>
            </div>
        </div>
    </section>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->
    <!-- javascript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <!-- <script type="text/javascript" src="assets/js/orgChart.min.js"></script>
    <script type="text/javascript" src="assets/js/struktur-org.js"></script> -->

    <script src="assets/js/leaflet/leaflet.js"></script>
    <script src="assets/js/leaflet/leaflet-esri.js"></script>

    <script type="text/javascript"> 
        let map;
        let point_layers = [];
        let polygon_layers = [];
        let markers = [];
        let point_geojson;
        let point_umkm;
        let point_umkm_list = '';
        let marker;

        $(document).ready(() => {

            init_map(); 

        });

        function init_map() {
            map = L.map('map', {
                attributionControl: false,
                zoomControl: true
            }).setView([-7.5514, 110.8493], 15);
            basemap = {
                osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map),
                google_roadmap: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                google_satellite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                google_hybrid: L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                google_terrain: L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                esri_world_imagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    maxZoom: 17
                }),
                esri_world_street_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'),
                esri_world_topo_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'),
                citra_satelit: L.esri.imageMapLayer({
                    url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer',
                    attribution: 'Badan Informasi Geospasial'
                }),
                peta_rbi: L.esri.dynamicMapLayer({
                    url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/IGD/RupabumiIndonesia/MapServer',
                    attribution: 'Badan Informasi Geospasial'
                }),
                peta_rbi_opensource: L.tileLayer.wms('http://palapa.big.go.id:8080/geoserver/gwc/service/wms', {
                    maxZoom: 20,
                    layers: "basemap_rbi:basemap",
                    format: "image/png",
                    attribution: 'Badan Informasi Geospasial'
                })

            }
            L.control.layers(basemap).addTo(map);
    
            let batas = '<?= base_url() ?>uploads/geojson/batas_provinsi_indonesia.json';

            let batas_style = (f)=>{
                let color;
                switch(f.properties.Kecamatan){
                    // case 'Kecamatan Laweyan': color = '#158fbf'; break;
                    // case 'Kecamatan Serengan': color = '#f2c063'; break;
                    // case 'Kecamatan Pasar Kliwon': color = '#06bf56'; break;
                    case 'Kecamatan Jebres': color = '#41d9d9'; break;
                    // case 'Kecamatan Banjarsari': color = '#f24141'; break;
                    default: '';
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
                }).addTo(map);
            });

            var theMarker = {};

            map.on('click',function(e){
                lat = e.latlng.lat;
                lon = e.latlng.lng;

                $('#tambah_langitude').val(lat);
                $('#tambah_longitude').val(lon); 
                    //Clear existing marker, 

                    if (theMarker != undefined) {
                        map.removeLayer(theMarker);
                    };

                //Add a marker to show where you clicked.
                theMarker = L.marker([lat,lon]).addTo(map);  
            });
        } 
    </script>
</body>
</html>