<script src="<?= base_url() ?>assets/js/leaflet/leaflet.js"></script>
<script src="<?= base_url() ?>assets/js/leaflet/leaflet-esri.js"></script>
<script src="<?= base_url() ?>assets/js/leaflet/leaflet.ajax.js"></script>
<script>
    var lat = '<?= @$data->latitude ?>';
    var lng = '<?= @$data->longitude ?>';
    let map, base_map;

    function init_map() {
        map = L.map('map', {
            attributionControl: false,
            zoomControl: true
        }).setView([-7.558517689092, 110.82824680176], 17);

        basemap = {
            osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            google_roadmap: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map),
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
    }

    function load_peta(latitude, longitude) {
        if (map != undefined) {
            map.remove();
        }
        init_map();
        let latlng = [latitude, longitude];
        L.marker(latlng).addTo(map);
        map.flyTo(latlng);

        map.on('click', function(e) {
            //alert("clik map"); 
            window.open('http://maps.google.com/?q=' + latitude + ',' + longitude + '&sensor=false', '_blank');
        });
        map.invalidateSize();
    }
    load_peta(lat, lng);
</script>