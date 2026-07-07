<html>
<head>
    <title>Leaflet Realtime</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <link rel="stylesheet" href="../src/leaflet_awesome_number_markers.css" />
    <style>
        #map {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"></script>
    <script src="../dist/leaflet-realtime.js"></script> 
    <script src="../src/leaflet_awesome_number_markers.js"></script>
    <script src="https://app.demoo.id/psu_sukoharjo/assets/leaflet/leaflet.ajax.min.js"></script>
<script>
//Creation of map tiles
var googleRoadMap  = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom         : 20,
    subdomains      : ['mt0', 'mt1', 'mt2', 'mt3']
});

var osmMap          = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution     : '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>',
});
var gsMap           = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom         : 18,
    subdomains      : ['mt0','mt1','mt2','mt3']
});  
var ghMap           = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom         : 20,
    subdomains      : ['mt0','mt1','mt2','mt3']
});
var esriwsMap       = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}');

//Map creation
var map             = L.map('map',{
    layers          : [googleRoadMap]
}).setView([-7.68256070237871, 110.84268828061613], 11); 
//Base layers definition and addition
var baseLayers = {
    "Google Road Map"       : googleRoadMap,
    "Google Satelit"        : gsMap,
    "Google Hibrid"         : ghMap,
    "Open Street Map"       : osmMap,
    "Esri World Street Map" : esriwsMap
};
//Add baseLayers to map as control layers
L.control.layers(baseLayers).addTo(map);	
function getColorKec(d) {
    return d == 'KEC. BENDOSARI' ? '#F1B1CE' :
           d == 'KEC. BULU' ? '#A4543B' :
           d == 'KEC. GATAK' ? '#63BECC' :
		   d == 'KEC. BAKI' ? '#FECB00' : 
		   
           d == 'KEC. GROGOL' ? '#E40081' :
           d == 'KEC. KARTASURA' ? '#3AA12B' : 
		   d == 'KEC. MOJOLABAN' ? '#969F7A' : 
		   d == 'KEC. NGUTER' ? '#D1905A' : 
      
           d == 'KEC. POLOKARTO' ? '#6F3A82' :
           d == 'KEC. SUKOHARJO' ? '#EE7900' :
           d == 'KEC. TAWANGSARI' ? '#008FD2' :
           d == 'KEC. WERU' ? '#E60108' :  
		   
		'#F44336';
}
var geojsonLayerKel    = new L.GeoJSON.AJAX("http://localhost/LEAFLET/leaflet-realtime-master/examples/Admin_Desa.geojson", {
	style : function (feature){
        desa = feature.properties.Admin;  
		return {
            fillColor       : "white",
			fillOpacity     : 0,
			color           : "black",
			dashArray       : '3',
			weight          : 1,
			opacity         : 0.5
		}
	}
});
//untuk kecamatan
var geojsonLayerKec = new L.GeoJSON.AJAX("http://localhost/LEAFLET/leaflet-realtime-master/examples/Admin_Kec.geojson", {
	style : function (feature){ 
	//console.log(feature.properties.KEC);
        kecamatan = feature.properties.KEC;  
		return { 
			fillColor       : getColorKec(kecamatan),
			fillOpacity     : 0.4,
			color           : "black",
			dashArray       : '3',
			weight          : 1,
			opacity         : 0.5
		}
	}
});
// 
geojsonLayerKel.addTo(map); 
geojsonLayerKec.addTo(map); 

realtime = L.realtime({
    url           : 'get_data.json',
    crossOrigin   : true,
    type          : 'json'
}, {
    interval      : 1000, 
    // pointToLayer  : function (feature, latlng) {
    //   return L.marker(latlng, {
    //     'icon'    : new L.AwesomeNumberMarkers({
    //               number      : feature.properties.mynumber, 
    //               markerColor : feature.properties.status.toLowerCase()
    //           })
    //   });
    // }
}).addTo(map);

realtime.on('update', function(e) {
    //console.log(e);
    updateFeatureIcon = function (fId) { 
        //console.log(fId);
        var feature = e.features[fId], mynumber = feature.properties.mynumber; 
        status      = feature.properties.status; 
        realtime.getLayer(fId).setIcon(new L.AwesomeNumberMarkers({
            number        : mynumber, 
            markerColor   : status.toLowerCase()     
        })); 
    };
    Object.keys(e.update).forEach(updateFeatureIcon); 

    //POP UP
    popupContent = function(fId) {
        var feature = e.features[fId],
        c           = feature.geometry.coordinates;
        return 'status brow '+feature.properties.status+' ' ;
    },
    bindFeaturePopup = function(fId) {
        realtime.getLayer(fId).bindPopup(popupContent(fId));
    },
    updateFeaturePopup = function(fId) {
        realtime.getLayer(fId).getPopup().setContent(popupContent(fId));
    };
    Object.keys(e.enter).forEach(bindFeaturePopup);
    Object.keys(e.update).forEach(updateFeaturePopup);
});
</script>
</body>
</html>