var base_url ="http://sip-super.sukoharjokab.go.id/";
var layer_psu 	= [];
var marker_psu 	= [];

/*
google_satellite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
maxZoom: 20,
	subdomains:['mt0','mt1','mt2','mt3']
}),

var map = L.map('mapid').setView([-7.68256070237871, 110.84268828061613], 11);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
		maxZoom: 18,
		boxZoom: true,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	}).addTo(map); */

var map = L.map('mapid').setView([-7.68256070237871, 110.84268828061613], 11);
	L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 18,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
	
     
	
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

var geojsonLayer = new L.GeoJSON.AJAX(""+base_url+"assets/geojson/Admin_Desa.geojson", {
	style : function (feature){
        desa = feature.properties.Admin;  
		return {
            fillColor:"white",
			fillOpacity: 0,
			color: "black",
			dashArray: '3',
			weight: 1,
			opacity: 0.5
		}
	}
});

//untuk kecamatan
var geojsonLayerKec = new L.GeoJSON.AJAX(base_url+"assets/geojson/Admin_Kec.geojson", {
	style : function (feature){ 
	console.log(feature.properties.KEC);
        kecamatan = feature.properties.KEC;  
		return { 
			fillColor: getColorKec(kecamatan),
			fillOpacity: 0.2,
			color: "black",
			dashArray: '3',
			weight: 1,
			opacity: 0.5
		}
	}
});
//untuk kabupaten
var geojsonLayerKab = new L.GeoJSON.AJAX(base_url+"assets/geojson/Admin_Kab.geojson", {
	style : function (feature){ 
        kabupaten = feature.properties.KAB;  
		return {
            fillColor:"red",
			fillOpacity: 0,
			color: "#000d33",
			dashArray: '3',
			weight: 3,
			opacity: 0.5
		}
	}
});

//POP UP
geojsonLayer.bindPopup(function (e) { 
    var desa = e.feature.properties.Admin;
	//return '<div style="color: blue;">'+desa+'</div>';  
});
geojsonLayerKec.bindPopup(function (e) { 
    var kecamatan = e.feature.properties.KEC;
    return '<div style="color: blue;">'+kecamatan+'</div>'; 
});
geojsonLayerKab.bindPopup(function (e) { 
    var kabupaten = e.feature.properties.KAB;
    //return '<div style="color: blue;">'+kabupaten+'</div>'; 
});

// start generate map
geojsonLayer.addTo(map); 
geojsonLayerKec.addTo(map); 
geojsonLayerKab.addTo(map);  
var maphomeIcon = L.icon({
	iconUrl: 'https://cdn0.iconfinder.com/data/icons/construction-22/32/navigation_pin_location_find_mark_home-512.png',
	iconSize: [40, 40],
	iconAnchor: [16, 37],
	popupAnchor: [0, -28]
});



function generate_map(kecamatan_id = null, psu_nama_perumahan = null, pilih_perumahan = null){ 
	$(".leaflet-marker-icon").remove(); 
	$.ajax({
		type 		: "POST",
		url 		: base_url+"api/psu/get_data_psu/data_psu/"+kecamatan_id+"/"+psu_nama_perumahan, 
		dataType 	: "JSON",   
		success 	: function(res){
			L.geoJSON(res, {
				style: function (feature) {
					return feature.properties; 
				},
				onEachFeature: function onEachFeature(feature, layer) {
					var popupContent =`
						<div style=" width: 400px; height: auto;"> 
							<table class="table">
								<tr>
									<td style="width: 32%; font-weight: 600;"> Nama Perusahaan </td>
									<td style="width: 5%;"> : </td>
									<td style="width: 60%;"> `+feature.properties.nama_perumahan+` </td>
								</tr>
								<tr>
									<td style="font-weight: 600;"> Nama Pemohon </td>
									<td> : </td>
									<td> `+feature.properties.nama_pemohon+` </td>
								</tr>
								<tr>
									<td style="font-weight: 600;"> Nama Perencana </td>
									<td> : </td>
									<td> `+feature.properties.nama_perencana+` </td>
								</tr>
								<tr>
									<td style="font-weight: 600;"> Kecamatan </td>
									<td> : </td>
									<td> `+feature.properties.kecamatan+` </td>
								</tr> 
								<tr>
									<td style="font-weight: 600;"> Kelurahan </td>
									<td> : </td>
									<td> `+feature.properties.kelurahan+` </td>
								</tr>
								<tr>
									<td style="font-weight: 600;"> Surveyor </td>
									<td> : </td>
									<td> `+feature.properties.surveyor+` </td>
								</tr>
								<tr>
									<td style="font-weight: 600;"> Tanggal Survei </td>
									<td> : </td>
									<td> `+feature.properties.tanggal_survei+` </td>
								</tr>				 
								<tr>
									<td style="font-weight: 600;"> Action </td>
									<td> : </td>
									<td> <a href="`+base_url+`data/detail/`+feature.properties.psu_id+`" class="btn btn-sm btn-success" 
									style="color: #FFF; width: 150px; ">
									<i class="fa fa-eye"></i> Detail </a> </td>
								</tr> 
							</table>
						</div>`;
						var customOptions = {
						'maxWidth': '500',
						'className' : 'custom'
						}
					layer.bindPopup(popupContent,customOptions); 
					if(feature.properties.psu_id==pilih_perumahan){ 
						//alert("open popup"+feature.properties.nama_perumahan);
						setTimeout(function(){
							layer.bindPopup(popupContent,customOptions).openPopup();
						},300); 
					}
				},
				pointToLayer: function (feature, latlng) {
					$("#pilih_perumahan").append('<option value="'+feature.properties.psu_id+'">'+feature.properties.nama_perumahan+'</option>');
					$("#pilih_perumahan option").attr("selected", false); 
					if(feature.properties.psu_id==pilih_perumahan){  
						setTimeout(function(){
							$("#pilih_perumahan option[value='"+pilih_perumahan+"']").attr("selected", true); 
						},200);  
					}
					// return L.marker(latlng, {icon: maphomeIcon});
					layer_psu[feature.properties.psu_id]	=	feature;
					marker_psu[feature.properties.psu_id]	= 	new L.marker(latlng, {icon: maphomeIcon}); 
					return marker_psu[feature.properties.psu_id].addTo(map);  
					//console.log(feature); 
				}
			});
		}
	});
}


$('#kecamatan').change(function(){
	var kecamatan_id = $(this).val();
	var psu_nama_perumahan = $('#nama_perumahan').val();
	if(kecamatan_id==""){
		kecamatan_id = "null";
	}
	$("#pilih_perumahan").html('');
	generate_map(kecamatan_id, psu_nama_perumahan); 
});

$('#nama_perumahan').keyup(function(){
	var kecamatan_id = $('#kecamatan').val();
	var psu_nama_perumahan = $(this).val();
	if(kecamatan_id==""){
		kecamatan_id = "null";
	}
	$("#pilih_perumahan").html('');
	generate_map(kecamatan_id, psu_nama_perumahan); 
});

$('#pilih_perumahan').change(function(){
	var kecamatan_id = $('#kecamatan').val();
	var psu_nama_perumahan = $('#nama_perumahan').val();
	var pilih_perumahan = $(this).val(); 
	if(kecamatan_id==""){
		kecamatan_id = "null";
	}
	if(pilih_perumahan==""){
		pilih_perumahan = "null";
	}
	$("#pilih_perumahan").html('');
	generate_map(kecamatan_id, psu_nama_perumahan, pilih_perumahan);
});

generate_map(); 

setTimeout(function(){
	console.log(layer_psu);
},1000); 