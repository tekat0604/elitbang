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

    });

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
        color: '#ff0000',
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
            console.log('apakah ini?')
            init_map_osm();
            $('.google_child input').attr('disabled','disabled');
            $('.google_child').addClass('disabled');
        }
    })

})

var map;
var zoom = 11;
var layers = {};

// google map
function init_map()
{
    
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: {lat: -7.568517689092, lng: 110.82824680176},
        disableDefaultUI: true,
        scrollwheel: true
    });

    var cb_length = $('#side_layers.large_screen input[type="checkbox"]').length;
    // $($('#side_layers.large_screen input[type="checkbox"]').get().reverse()).each(function(i){
        $('#side_layers.large_screen input[type="checkbox"]').each(function(i){
            var cb = $(this);
            var zindex = i;
            // var zindex = cb_length - i + 2;
            // console.log($(this).attr('name')+': ', zindex);

            var geojson_url = '';

            console.log($(this).hasClass('default_layers'));

            if($(this).hasClass('default_layers'))
            {
                // console.log('default layers');
                geojson_url = '<?=base_url()?>assets_front/geojson/'+$(this).attr('name')+'.json';
            }
            else if($(this).hasClass('dynamic_layers'))
            {
                // console.log('dynamic layers')
                geojson_url = '<?=base_url()?>peta/get_geojson/'+$(this).attr('id_layer');
            }

            $.getJSON(geojson_url, function(data){
                layers[cb.attr('name')] =  new google.maps.Data;   
                layers[cb.attr('name')].addGeoJson(data);

                if(cb.hasClass('default_layers'))
                {    
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
                }
                else if(cb.hasClass('dynamic_layers'))
                {
                    function set_style(zi = null, fc = null, fo = null, sc = null, so = null, sw = null){
                        layers[cb.attr('name')].setStyle(function(f){
                            // console.log('color: ',f.getProperty('fill'),f,)
                            return {
                                fillColor: '#19bff0',
                                fillOpacity: 0.3,
                                strokeColor: '#008acd',
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                zIndex: zi == null ? zindex : zi
                            }
                        })
                    }
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
                var info_content = {};
                layers[cb.attr('name')].forEach(function(f){
                    
                    name = f.getProperty('id_collection');

                    if(cb.hasClass('default_layers'))
                    {    
                        info[f.getProperty('id_collection')] = new google.maps.InfoWindow({
                            content: f.getProperty('description')
                        });
                        info_content[f.getProperty('id_collection')] = f.getProperty('description');
                    }
                    else if(cb.hasClass('dynamic_layers'))
                    {
                        var content = '';
                        let o = f.h;
                            
                        Object.keys(o).map((v,i,a)=>{
                            if(!['id_layer','id_opd','id_collection','stroke','stroke_opacity','stroke_width','fill','fill_opacity','icon_name','page_detail'].includes(v)){

                                if(v == 'nama_layer')
                                {
                                    content += '<div style="font-size:larger; font-weight:bold;margin-bottom:5px;">'+o[v]+'</div>';
                                }
                                else
                                {
                                    content += '<div>'+v+': '+o[v]+'</div>';
                                }
                            }
                        })

                        info[f.getProperty('id_collection')] = new google.maps.InfoWindow({
                            content: content
                        });
                        info_content[f.getProperty('id_collection')] = content;
                    }

                })
                var info_active = '';
           
                layers[cb.attr('name')].addListener('click',function(e){
                    if(info_active != ''){
                        info_active.close();
                        info_active =  info[e.feature.getProperty('id_collection')];
                    }else{
                        info_active =  info[e.feature.getProperty('id_collection')];
                    }

                    info[e.feature.getProperty('id_collection')].setPosition({
                        lat: e.latLng.lat() + 0.00002,
                        lng: e.latLng.lng()
                    });
                    // info[e.feature.getProperty('id_collection')].open(map);
                    $('#info_content').html(info_content[e.feature.getProperty('id_collection')]);
                    $('#mobile_info #info_content').html(info_content[e.feature.getProperty('id_collection')]);
                    if(!$('#side_info').hasClass('active_option'))
                    {
                        $('#btn_map_info').trigger('click');
                    }
                    $('#mobile_tabs a[href="#mobile_info"]').trigger('click');
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
// $($('#side_layers.large_screen input[type="checkbox"]').get().reverse()).each(function(i){
$('#side_layers.large_screen input[type="checkbox"]').each(function(i){
    var osm_cb = $(this);
    // console.log($(this).attr('name'));

    var geojson_url = '';

    if($(this).hasClass('default_layers'))
    {
        // console.log('default layers');
        geojson_url = '<?=base_url()?>assets_front/geojson/'+$(this).attr('name')+'.json';
    }
    else if($(this).hasClass('dynamic_layers'))
    {
        // console.log('dynamic layers')
        geojson_url = '<?=base_url()?>peta/get_geojson/'+$(this).attr('id_layer');
    }

    function osm_style(f){

        var fill_color = (typeof f.properties['fill'] != 'undefined') ?  f.properties['fill'] : '#19bff0';
        var fill_opacity = (typeof f.properties['fill_opacity'] != 'undefined') ?  f.properties['fill_opacity'] : 0.3;
        var stroke_color = (typeof f.properties['stroke'] != 'undefined') ?  f.properties['stroke'] : '#19bff0';
        var stroke_opacity = (typeof f.properties['stroke_opacity'] != 'undefined') ?  f.properties['stroke_opacity'] : 0.7;
        var stroke_weight = (typeof f.properties['stroke_width'] != 'undefined') ?  f.properties['stroke_width'] : 2;

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
        // console.log(e)
        osm_popup
        // .setLatLng(e.latlng)
        .setLatLng({
            lat: e.latlng.lat + 0.0002,
            lng: e.latlng.lng
        })
        // .openOn(osm_map);

        if(osm_cb.hasClass('default_layers'))
        {    
            osm_popup.setContent(e.layer.feature.properties.description);
            $('#info_content').html(e.layer.feature.properties.description);
            $('#mobile_info #info_content').html(e.layer.feature.properties.description);
        }
        else if(osm_cb.hasClass('dynamic_layers'))
        {
            let o = e.layer.feature.properties;
            let content = '';
            console.log('o',o);
            Object.keys(o).map((v,i,a)=>{
                if(!['id_layer','id_opd','id_collection','stroke','stroke_opacity','stroke_width','fill','fill_opacity','icon_name','page_detail'].includes(v))
                {
                    if(v == 'nama_layer')
                    {
                        content += '<div style="font-size:larger; font-weight:bold;margin-bottom:5px;">'+o[v]+'</div>';
                    }
                    else
                    {
                        content += '<div>'+v+': '+o[v]+'</div>';
                    }
                    
                }
                
            })
            console.log('halaman: ',o)
            if(o.page_detail == 1)
            {
                content += '<div style="margin: 10px; text-align:center;"><a href="<?=base_url()?>peta/informasi-detail/'+o.id_collection+'" class="btn btn-sm btn-rounded btn-outline-danger" target="_blank">Lihat Selengkapnya</a></div>';
            }
            // osm_popup.setContent(content);
            $('#info_content').html(content);
            $('#mobile_info #info_content').html(content);

        }

        if(!$('#side_info').hasClass('active_option'))
        {
            $('#btn_map_info').trigger('click');
        }

        $('#mobile_tabs a[href="#mobile_info"]').trigger('click');
    }
    

    $.getJSON(geojson_url , function(data){
        // console.log(data);
        if(data.features.length > 0){
            // console.log(geojson_url)
            // console.log(osm_cb.attr('name'));
            osm_layers[osm_cb.attr('name')] = new L.geoJSON(data,{
                style: osm_style
            });
            
            if(osm_cb.is(':checked')){
                // console.log(osm_layers[osm_cb.attr('name')])
                osm_layers[osm_cb.attr('name')].addTo(osm_map);
            }   

            osm_layers[osm_cb.attr('name')].on('click',osm_info);
            console.log(osm_cb.attr('name'),': ', osm_layers[osm_cb.attr('name')])

        }

    })


})

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

$('#btn_map_search').click(function(){
    
    if($('#side_search').hasClass('active_option'))
    {
        $('.side_option').removeClass('active_option');
        $('#side_search').hide('slide');
    }
    else
    {
        $('.side_option').removeClass('active_option');
        $('#side_search').addClass('active_option');
        $('.side_option').hide('slide');
        $('.side_option.active_option').show('slide');
    }

})

$('input[name="google_base_map"]').change(function(){
    map.setMapTypeId($(this).val());
})

var layers = [];

$('#side_layers input[type="checkbox"]').change(function(){

    if($(this).is(':checked'))
    {
        if(base_map == 'google_map')
        {
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
        }
        else if(base_map == 'osm_map')
        {
            osm_map.setView([lat,lng]);
            var search_marker = L.marker([lat,lng]).addTo(osm_map);
            setTimeout(() => {
                osm_map.removeLayer(search_marker);
            }, 5000);
        }
    }
    else
    {
        alert('Harap masukkan latitude & longitude');
    }

    
})

</script>