<html>
<head>
    <title>Leaflet Realtime</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/leaflet/real_time/leaflet_awesome_number_markers.css" />
    <style>
        
    </style>
</head>
<body>
<style type="text/css">
#map {
    position    : absolute;
    top         : 0;
    left        : 0;
    bottom      : 0;
    right       : 0;
}
/* .leaflet-popup-content-wrapper, .leaflet-popup-tip{
    background: #ffcc00;
}
.leaflet-container a.leaflet-popup-close-button{
    color: #fff;
}
.leaflet-container a.leaflet-popup-close-button:hover{
    color: #ff0000;
} */
#tabel_pesebaran{   
    border-radius: 10px;
} 
#tabel_pesebaran tr td{  
    padding: 7px 10px 7px 10px;
    box-shadow: none!important; 
} 
.leaflet-popup-content{
    width           : 350px!important;
}
.circle_marker{
    width           : 10px; 
    height          : 10px; 
    background      : #fff; 
    border-radius   : 50%; 
    margin-top      : 2px;
}
#tabel_pesebaran .btn_action{
    padding         : 7px 20px 7px 20px;
    border-radius   : 7px;
    color           : #FFF;
    background      : red;
    text-decoration : none;
    border          : 2px solid rgba(255,255,255,0.8);
}
#tabel_pesebaran tr{
    background-color: rgba(155,155,155,0.2);
}
#tabel_pesebaran tr:nth-child(odd){
    background-color: rgba(200,200,200,0.2);
}
.awesome-number-marker-icon-red{
    animation: fade 1s infinite alternate;
} 
.awesome-number-marker-icon-red:hover:before{ 
    box-shadow: 0 0 15px #000;
    filter: blur(3px);
    transform: scale(1.2);
}
.awesome-number-marker-icon-red:hover{ 
  box-shadow: 0 0 15px #000;
  text-shadow: 0 0 15px #000;
  border-radius: 50%; 
}
@keyframes fade {
    from {
        opacity: 0.5;
        top: -10px;
    }
}
</style> 
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"></script>
    <script src="<?php echo base_url('');?>assets/leaflet/real_time/leaflet-realtime.js"></script> 
    <script src="<?php echo base_url('');?>assets/leaflet/real_time/leaflet_awesome_number_markers.js"></script>
    <script src="<?php echo base_url('');?>assets/leaflet/leaflet.ajax.min.js"></script>
<script>
//
var base_url = "<?php echo base_url();?>";
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
    return d == 'KEC. BENDOSARI'    ? '#F1B1CE' :
           d == 'KEC. BULU'         ? '#A4543B' :
           d == 'KEC. GATAK'        ? '#63BECC' :
		   d == 'KEC. BAKI'         ? '#FECB00' : 
		   
           d == 'KEC. GROGOL'       ? '#E40081' :
           d == 'KEC. KARTASURA'    ? '#3AA12B' : 
		   d == 'KEC. MOJOLABAN'    ? '#969F7A' : 
		   d == 'KEC. NGUTER'       ? '#D1905A' : 
      
           d == 'KEC. POLOKARTO'    ? '#6F3A82' :
           d == 'KEC. SUKOHARJO'    ? '#EE7900' :
           d == 'KEC. TAWANGSARI'   ? '#008FD2' :
           d == 'KEC. WERU'         ? '#E60108' :  
		   
		'#F44336';
}
var geojsonLayerKel    = new L.GeoJSON.AJAX("<?php echo base_url('');?>uploads/geojson/Admin_Desa.geojson", {
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
var geojsonLayerKec = new L.GeoJSON.AJAX("<?php echo base_url('');?>uploads/geojson/Admin_Kec.geojson", {
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
    url           : 'https://appl.demoo.id/sukoharjo/bpbd/map/api',
    //url           : 'https://appl.demoo.id/sukoharjo/bpbd/uploads/geojson/get_data.json',
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
    //alert("jion");
    //console.log(e);
    updateFeatureIcon = function (fId) {  
        var feature = e.features[fId], mynumber = feature.properties.id; 
        color      = feature.properties.color;  
        realtime.getLayer(fId).setIcon(new L.AwesomeNumberMarkers({
            number        : '<div class="circle_marker"></div>', 
            markerColor   : color.toLowerCase()     
        })); 
    };
    Object.keys(e.update).forEach(updateFeatureIcon); 

    //POP UP
    popupContent = function(fId) {
        var feature = e.features[fId];
        var img     = '';
        if(feature.properties.img!=''){
            img += `<img src="`+feature.properties.img+`" style="width: 100%; border-radius: 10px;">`;
        }else{
            img += '';
        }
        var tabel = '';
        tabel += `
        <div >
        </div>
        <table id="tabel_pesebaran" style="width: 100%; " cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 50px; border-top-left-radius: 10px;" > Subjek </td>
                <td style="width: 5px;"> : </td>
                <td style="width: auto; border-top-right-radius: 10px;"> 
                    <span id="detail_subjek">`+feature.properties.subjek+`</span> 
                </td>
            </tr>
            <tr>
                <td> Status </td>
                <td> : </td>
                <td> 
                    <span id="detail_status" style="color: `+feature.properties.color+`;"> 
                    `+feature.properties.status+` 
                    </span> 
                </td>
            </tr>
            <tr>
                <td> Tanggal </td>
                <td> : </td>
                <td> 
                    <span id="detail_tanggal"> `+feature.properties.tanggal+` </span> 
                </td>
            </tr>
            <tr>
                <td> Lokasi </td>
                <td> : </td>
                <td> 
                    <span id="detail_lokasi"> `+feature.properties.lokasi+` </span> 
                </td>
            </tr>
            <tr>
                <td> Foto </td>
                <td> : </td>
                <td> `+img+` </td>
            </tr>
            <tr style="height: 50px;">
                <td style="border-bottom-left-radius: 10px; "> Aksi </td>
                <td> : </td>
                <td style="border-bottom-right-radius: 10px;"> 
                    <a href="`+base_url+`/detail/`+feature.properties.id+`" class="btn_action" 
                    style="background: `+feature.properties.color+`;"> Detail </a> 
                </td>
            </tr> 
        </table> 
        `;
        var feature = e.features[fId],
        c           = feature.geometry.coordinates;
        return ''+tabel+' ' ;
    },
    bindFeaturePopup = function(fId){
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