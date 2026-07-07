<script>
var base_map = 'osm_map';
$(document).ready(function(){
    
    init_map_osm();
    $('#btn_map_menu').click(function(){
        $('.btn_map').fadeToggle();
        $('.side_option').hide('fade');
    });

    $('#btn_map_home').click(function(){
        window.location.replace('<?=base_url()?>');
    })

    $('#btn_map_layers').click(function(){

        if($('#side_layers').hasClass('active_option'))
        {
            $('.side_option').removeClass('active_option');
            $('#side_layers').hide('slide');
        }
        else
        {
            $('.side_option').removeClass('active_option');
            $('#side_layers').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('#btn_map_base').click(function(){
        if($('#side_base').hasClass('active_option'))
        {
            $('.side_option').removeClass('active_option');
            $('#side_base').hide('slide');
        }
        else
        {
            $('.side_option').removeClass('active_option');
            $('#side_base').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }
        
    });

    $('.side_option_content').slimScroll({
        color: '#f08519',
        height: '60vh'
    });

    
    $('#side_base input[type="radio"][name="base_map"]').change(function(){
        if($(this).val() == 'google_map'){
            zoom = 11;
            console.log('google');
            base_map = $(this).val();
            osm_map.remove();
            osm_map = null;
            $('#map').html('');
            init_map();
            $('.google_child input').removeAttr('disabled');
            $('.google_child').removeClass('disabled');
            $('.google_child input[value="roadmap"]').trigger('click');
            
            
        }
        else if($(this).val() == 'osm_map'){
            zoom = 11;
            console.log('osm')
            base_map = $(this).val();
            map = null;
            $('#map').html('');
            init_map_osm();
            $('.google_child input').attr('disabled','disabled');
            $('.google_child').addClass('disabled');
        }
    })

})

var map;
var zoom = 11;
var layers = {};
var polygons = [];


// google map
function init_map()
{
    var g = google.maps;
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: {lat: -7.568517689092, lng: 110.82824680176},
        disableDefaultUI: true,
        scrollwheel: false
    });

    var cb_length = $('#side_layers input[type="checkbox"]').length;
    $($('#side_layers input[type="checkbox"]').get().reverse()).each(function(i){
            var cb = $(this);
            var zindex = i;
            // var zindex = cb_length - i + 2;
            // console.log($(this).attr('name')+': ', zindex);
            $.getJSON('<?=base_url()?>assets_front/geojson/'+$(this).attr('name')+'.json', function(data){
                layers[cb.attr('name')] =  new google.maps.Data;   
                if(cb.is(':checked')){
                    layers[cb.attr('name')].addListener('addfeature', create_features);
                } 
                layers[cb.attr('name')].addGeoJson(data);

                function create_features(e){

                    var xpaths = []
                    if(e.feature.getGeometry().getType() == 'Polygon'){
                        var path =[];
                        for(var i=0; i<e.feature.getGeometry().getArray().length; i++){
                            path.push(e.feature.getGeometry().getAt(i).getArray());
                        }
                        xpaths.push(path);
                    }else if(e.feature.getGeometry().getType() == 'GeometryCollection'){
                        for(var i=0; i<e.feature.getGeometry().getArray().length; i++){
                            var path =[];
                            if(e.feature.getGeometry().getAt(i).getType() == 'Polygon'){
                                for(var j=0; j<e.feature.getGeometry().getAt(i).getArray().length; j++){
                                    path.push(e.feature.getGeometry().getAt(i).getAt(j).getArray());
                                }
                                xpaths.push(path);
                            }
                        }
                    }


                    var description = e.feature.getProperty('description');

                    for(var i=0; i<xpaths.length; i++){
                        var polygon = new g.Polygon({
                            paths: xpaths[i],
                            // map: map,
                            clickable: false,
                            name: cb.attr('data-name'),
                            desc: description,
                            fillColor: e.feature.getProperty('fill'),
                            fillOpacity: e.feature.getProperty('fill-opacity'),
                            strokeColor: e.feature.getProperty('stroke'),
                            strokeOpacity: e.feature.getProperty('stroke-opacity'),
                            strokeWeight: e.feature.getProperty('stroke-width')
                        })
                        polygons.push(polygon);
                    }

                    }


                function set_style(zi = null, fc = null, fo = null, sc = null, so = null, sw = null){
                    layers[cb.attr('name')].setStyle(function(f){
                        // console.log('color: ',f.getProperty('fill'),f,)
                        return {
                            fillColor: fc == null ? f.getProperty('fill') : fc,
                            fillOpacity: fo == null ? f.getProperty('fill-opacity') : fo,
                            strokeColor: sc == null ? f.getProperty('stroke') : sc,
                            strokeOpacity: so == null ? f.getProperty('stroke-opacity') : so,
                            strokeWeight: sw == null? f.getProperty('stroke-width') : sw,
                            zIndex: zi == null ? zindex : zi
                        }
                    })
                }

                switch(cb.attr('name')){
                    case 'batas_kabupaten':
                        set_style(null,null,0.0);
                        break;
                    case 'batas_kecamatan':
                        set_style(null,null,0.0);
                        break;
                    case 'batas_desa':
                        set_style(null,null,0.0);
                        break;
                    default:
                        zindex = i;
                        set_style(null,null,1.0)
                }

                var info = {};
                
                layers[cb.attr('name')].forEach(function(f){
                    name = f.getProperty('name');
                    info[f.getProperty('name')] = new google.maps.InfoWindow({
                        content: f.getProperty('description')
                    });
                })
                var info_active = '';
           
                layers[cb.attr('name')].addListener('click',function(e){
                    $('input[name="cari_lat"]').val(e.latLng.lat());
                    $('input[name="cari_lng"]').val(e.latLng.lng());
                    let html = '';
                    polygons.map((v,i,a)=>{
                        if(google.maps.geometry.poly.containsLocation(new google.maps.LatLng($('input[name="cari_lat"]').val(),$('input[name="cari_lng"]').val()), polygons[i])){
                            console.log(polygons[i]);
                            if(typeof polygons[i].name != undefined){
                                html += '<h6>'+polygons[i].name+'</h6>';
                                html += polygons[i].desc;
                            }else{
                                html += '<div>Belum ada data</div>'
                            }
                        }
                    })

                    $('#side_info .side_option_content').html(html);

                    if(info_active != ''){
                        info_active.close();
                        info_active =  info[e.feature.getProperty('name')];
                    }else{
                        info_active =  info[e.feature.getProperty('name')];
                    }

                    info[e.feature.getProperty('name')].setPosition(e.latLng);
                    info[e.feature.getProperty('name')].open(map);
                })

                if(cb.is(':checked')){
                    layers[cb.attr('name')].setMap(map);
                }
            })      
    })
    
}

var osm_url,osm_map;
var osm_layers = {};
    
function init_map_osm(){
osm_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
osm_map = L.map('map',{
    attributionControl: false,
    zoomControl: false
}).setView([-7.568517689092,110.82824680176], zoom);
L.tileLayer(
osm_url,
{
    // attribution: 'Made with Love'
}
)
.addTo(osm_map);

var osm_popup = L.popup();

$($('#side_layers input[type="checkbox"]').get().reverse()).each(function(i){
    var osm_cb = $(this);
    // console.log($(this).attr('name'));

    function osm_style(f){

        var fill_color = (typeof f.properties['fill'] != 'undefined') ?  f.properties['fill'] : '#19bff0';
        var fill_opacity = (typeof f.properties['fill-opacity'] != 'undefined') ?  f.properties['fill-opacity'] : 0.3;
        var stroke_color = (typeof f.properties['stroke'] != 'undefined') ?  f.properties['stroke'] : '#19bff0';
        var stroke_opacity = (typeof f.properties['stroke-opacity'] != 'undefined') ?  f.properties['stroke-opacity'] : 0.7;
        var stroke_weight = (typeof f.properties['weight'] != 'undefined') ?  f.properties['weight'] : 2;

        switch(osm_cb.attr('name')){
            case 'batas_kabupaten':
                fill_opacity = 0;
                break;
            case 'batas_kecamatan':
                fill_opacity = 0;
                break;
            case 'batas_desa':
                fill_opacity = 0;
                break;
            default:
                
        }

        return {
            fillColor: fill_color,
            fillOpacity: fill_opacity,
            color: stroke_color,
            opacity: stroke_opacity,
            weight: stroke_weight
        }
    }

    function osm_info(e){
        console.log(e);
        // console.log('a: ',e.latlng);
        // console.log(e)
        
        osm_popup
        .setLatLng(e.latlng)
        .setContent(e.layer.feature.properties.description)
        .openOn(osm_map)
    }

    $.getJSON('<?=base_url()?>assets_front/geojson/'+$(this).attr('name')+'.json', function(data){
        osm_layers[osm_cb.attr('name')] = new L.geoJSON(data,{
            style: osm_style
        });

        osm_layers[osm_cb.attr('name')].name = osm_cb.attr('data-name');
        
        if(osm_cb.is(':checked')){
            // console.log(osm_layers[osm_cb.attr('name')])
            osm_layers[osm_cb.attr('name')].addTo(osm_map);
        }   

        osm_layers[osm_cb.attr('name')].on('click',function(e){
            $('input[name="cari_lat"]').val(e.latlng.lat);
            $('input[name="cari_lng"]').val(e.latlng.lng);
            osm_info(e);
        });

    })


})

function get_info(e){

    let results = [];
    Object.keys(osm_layers).map(v=>{

        if('_map' in osm_layers[v] && osm_layers[v]._map != null)
        {

            let result = leafletPip.pointInLayer(e.latlng, osm_layers[v]);
            if(result.length > 0)
            {
                results[v] = {};
                results[v].name = osm_layers[v].name;
                results[v].data = result;
            } 
            
        }
  
    })
    
    let html = '';
    Object.keys(results).map(v=>{
        
        html += '<h6>'+results[v].name+'</h6>';
        results[v].data.map(v=>{
            html += v.feature.properties.description;
        })
    })
    $('#side_info .side_option_content').html(html);
    // console.log('result: ',results);
}

osm_map.on('click', function(e){
    get_info(e);
});

// function get_info(e){
//     let info_content = '' ;
//     // console.log('e: ',e);
//     //saved click coordinates
//     let sc = L.latLngBounds(e.latlng,e.latlng);
//     // console.log('sc: ',sc);
//     // console.log('osm_map._layers: ',osm_map._layers);

//     //intersecting features
//     var isf = [];
//     for(l in osm_map._layers){
//         //overlay layers
//         let ol = osm_map._layers[l];
//         // console.log('ol: ',ol)
//         for(i in ol._layers){
//             //feature
//             let f = ol._layers[i];
//             //bounds
//             let b;
//             // console.log('f: ',f)
//             if(f.getBounds) 
//             {
//                 b = f.getBounds();
//             }
//             else if(f._latlng)
//             {
//                 b = L.latLngBounds(f._latlng, f._latlng);
//             }

//             if(b && sc.intersects(b))
//             {
//             //    console.log(f);
//             //    console.log(b);
//             //    console.log('latlng: ',e.latlng);
//                // console.log('f: ',f);
//                 // console.log('if: ',sc.intersects(b));
//                 console.log(e.latlng,f.getBounds());
//                 // console.log('desc: ',f.feature.properties.description );
//                 isf[f._leaflet_id] = f.feature.properties.description;
//             }

//         }
        
//     }
//     // console.log('b: ',e.latlng);
//     console.log(isf);
     
//     isf.forEach(v=>{
//         info_content += '<div>'+v+'</div><hr>';
//     })

//     // osm_popup
//     //     .setLatLng(e.latlng)
//     //     .setContent(info_content)
//     //     .openOn(osm_map)


// }

// osm_map.on('click', get_info);

}

$('#btn_map_zoom_in').click(function(){
    if(base_map == 'google_map')
    {
        zoom++
        map.setZoom(zoom);
    }
    else if(base_map == 'osm_map')
    {
        zoom++
        osm_map.setZoom(zoom);
    }
    
})

$('#btn_map_zoom_out').click(function(){
    if(base_map == 'google_map')
    {
        zoom--
        map.setZoom(zoom);
    }
    else if(base_map == 'osm_map')
    {
        zoom--
        osm_map.setZoom(zoom);
    }
    
})

$('#btn_map_info').click(function(){
    
    if($('#side_info').hasClass('active_option'))
    {
        $('.side_option').removeClass('active_option');
        $('#side_info').hide('slide');
    }
    else
    {
        $('.side_option').removeClass('active_option');
        $('#side_info').addClass('active_option');
        $('.side_option').hide('slide');
        $('.side_option.active_option').show('slide');
    }

})

// $('#btn_map_search').click(function(){
    
//     if($('#side_search').hasClass('active_option'))
//     {
//         $('.side_option').removeClass('active_option');
//         $('#side_search').hide('slide');
//     }
//     else
//     {
//         $('.side_option').removeClass('active_option');
//         $('#side_search').addClass('active_option');
//         $('.side_option').hide('slide');
//         $('.side_option.active_option').show('slide');
//     }

// })

$('input[name="google_base_map"]').change(function(){
    map.setMapTypeId($(this).val());
})

var layers = [];

$('#side_layers input[type="checkbox"]').change(function(){

    if($(this).is(':checked'))
    {
        if(base_map == 'google_map')
        {
            polygons = [];
            init_map();
            layers[$(this).attr('name')].setMap(map);
        }
        else if(base_map == 'osm_map')
        {
            osm_layers[$(this).attr('name')].addTo(osm_map);
        }
        $(this).attr('checked','checked');
    }
    else
    {
        if(base_map == 'google_map')
        {
            polygons = [];
            init_map();
            layers[$(this).attr('name')].setMap(null);
        }
        else if(base_map == 'osm_map')
        {
            osm_map.removeLayer(osm_layers[$(this).attr('name')]);
        }       
        $(this).removeAttr('checked');
    }

})

$('#cari_latlng').click(function(){
if
(
    $('input[name="cari_lat"]').val() != null &&
    $('input[name="cari_lat"]').val() != '' &&
    $('input[name="cari_lat"]').val() != 0 &&
    $('input[name="cari_lat"]').val() != '0' &&
    $('input[name="cari_lng"]').val() != null &&
    $('input[name="cari_lng"]').val() != '' &&
    $('input[name="cari_lng"]').val() != 0 &&
    $('input[name="cari_lng"]').val() != '0' 
)
{
    let lat = $('input[name="cari_lat"]').val();
    let lng = $('input[name="cari_lng"]').val();

    let e = {
        latlng: {
            lat: lat,
            lng: lng
        }
    }

    if(base_map == 'google_map')
    {
        let lat_lng = new google.maps.LatLng(lat,lng);
        map.setCenter(lat_lng);
        var search_marker = new google.maps.Marker({
            position: lat_lng,
            map: map,
            animation: google.maps.Animation.BOUNCE
        })

        setTimeout(() => {
            search_marker.setMap(null);
        }, 5000);

        let html = '';
        polygons.map((v,i,a)=>{
            if(google.maps.geometry.poly.containsLocation(new google.maps.LatLng($('input[name="cari_lat"]').val(),$('input[name="cari_lng"]').val()), polygons[i])){
                console.log(polygons[i]);
                if(typeof polygons[i].name != undefined){
                    html += '<h6>'+polygons[i].name+'</h6>';
                    html += polygons[i].desc;
                }else{
                    html += '<div>Belum ada data</div>'
                }
            }
        })

        $('#side_info .side_option_content').html(html);


    }
    else if(base_map == 'osm_map')
    {
        osm_map.setView([lat,lng]);
        var search_marker = L.marker([lat,lng]).addTo(osm_map);
        setTimeout(() => {
            osm_map.removeLayer(search_marker);
        }, 5000);
        // osm_map.fireEvent('click',{latlng:[lat,lng]});
        // osm_info(e);
    }
}
else
{
    alert('Harap masukkan latitude & longitude');
}


})

</script>