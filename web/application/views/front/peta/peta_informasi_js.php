<script>
var base_map = 'osm_map';
$(document).ready(function(){
    $('.bar_loader').hide();
    if('caches' in window)
    {
        // init_map_osm_c();
        init_map_osm();
    }
    else
    {
        init_map_osm();
    }
    
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
        $('#side_layers input[type="checkbox"]').prop('checked',false);
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

    $('#btn_map_search').click(function(e){
        if($('#side_layers.large_screen input[type="checkbox"]:checked').length > 0)
        {
            $('#layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
            $('#feature_search').attr('placeholder','Cari semua...');
        }
        else
        {
            $('#layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
            $('#feature_search').attr('placeholder','Tidak ada data untuk dicari...');
        }
        $('#feature_name').html('');

        $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
            $('#layer_search').append('<option value="'+$(this).attr('name')+'">'+$(this).attr('data-name')+'</option>');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
            $('#feature_name').append(nl);
            osm_layers[$(this).attr('name')].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#feature_name').append(fn)
            })
        })  
    })

    $('#layer_search').change(function(e){
        $('#feature_name').html('');
        $('#feature_search').val('');
        if($(this).val() == 'all_layer')
        {
            $('#feature_search').attr('placeholder','Cari semua...');
            $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#feature_name').append(nl);
                osm_layers[$(this).attr('name')].eachLayer(l=>{
                    let fn  = '';
                        fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                    $('#feature_name').append(fn)
                })
            })  
        }
        else
        {
            $('#feature_search').attr('placeholder','Cari '+$('#layer_search option[value="'+$(this).val()+'"]')[0].text+'...');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#layer_search option[value="'+$(this).val()+'"]')[0].text+'</div>';
            $('#feature_name').append(nl);
            osm_layers[$(this).val()].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).val()+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#feature_name').append(fn)
            })
        }
    })

    $('#feature_search').keyup(function(){
        $('#feature_name').html('');
        let cari = new RegExp($(this).val(), 'i');
        if($('#layer_search').val() == 'all_layer')
        {
            $('#side_layers.large_screen input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#feature_name').append(nl);
                osm_layers[$(this).attr('name')].eachLayer(l=>{
                    
                    if(l.feature.properties.name !== null)
                    {
                        if(l.feature.properties.name.match(cari))
                        {
                            let fn  = '';
                                fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                            $('#feature_name').append(fn);
                        }
                    }
                })
            })  
        }
        else
        {
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#layer_search option[value="'+$('#layer_search').val()+'"]')[0].text+'</div>';
            $('#feature_name').append(nl);
            osm_layers[$('#layer_search').val()].eachLayer(l=>{
                
                if(l.feature.properties.name !== null)
                {
                    if(l.feature.properties.name.match(cari))
                    {
                        let fn  = '';
                            fn += '<div class="feature_name" data-name="'+$('#layer_search').val()+'" data-id="'+l._leaflet_id+'">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                        $('#feature_name').append(fn);
                    }
                }
                
            })
        }
    })
    
    $('#feature_name').on('click','.feature_name',function(e){
        console.log('clicked: ',
            osm_layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
        )
        
        let l = osm_layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];
        
        // osm_map.flyTo()
        
        if(l.feature.geometry.type == 'Point')
        {
            // console.log(l.feature.geometry.type)
            // console.log('latlng: ',l._latlng.toBounds());
            // let bounds = l._latlng.toBounds();
            // let center = bounds.getCenter();
            // console.log('center: ',center);
            let center = l._latlng;

            osm_map.flyTo(center,18);
        }
        else if(l.feature.geometry.type == 'LineString')
        {
            // console.log(l.feature.geometry.type)
            // let bounds = osm_layers[$(this).attr('data-name')].getBounds();
            // let center = bounds.getCenter();
            let center = l._latlngs[(l._latlngs.length/2)];
            osm_map.flyTo(center,15);
        }
        else if(l.feature.geometry.type == 'Polygon')
        {
            let center = l._latlngs[0][0];
            osm_map.flyTo(center,15);
        }

    })

    $('#layer_search').select2();
    $('.search_layer').select2();
    $('.box_search').hide();
    $('.btn_search').click(function(e){
        console.log($(this));
        $('#box_search_'+$(this).attr('data-slug')).slideToggle();
    });

    // Mobile version

    $('#mobile_tabs[href="#mobile_search"]').click(function(e){
        if($('#side_layers input[type="checkbox"]:checked').length > 0)
        {
            $('#m_layer_search').html('<option value="all_layer" selected>-- Tampilkan Semua Layer --</option>');
            $('#m_feature_search').attr('placeholder','Cari semua...');
        }
        else
        {
            $('#m_layer_search').html('<option value="all_layer" selected>-- Tidak Ada Layer Aktif --</option>');
            $('#m_feature_search').attr('placeholder','Tidak ada data untuk dicari...');
        }
        $('#m_feature_name').html('');

        $('#side_layers input[type="checkbox"]:checked').each(function(i){
            $('#m_layer_search').append('<option value="'+$(this).attr('name')+'">'+$(this).attr('data-name')+'</option>');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
            $('#m_feature_name').append(nl);
            osm_layers[$(this).attr('name')].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#m_feature_name').append(fn)
            })
        })  
    })

    $('#m_layer_search').change(function(e){
        $('#m_feature_name').html('');
        $('#m_feature_search').val('');
        if($(this).val() == 'all_layer')
        {
            $('#m_feature_search').attr('placeholder','Cari semua...');
            $('#side_layers input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#m_feature_name').append(nl);
                osm_layers[$(this).attr('name')].eachLayer(l=>{
                    let fn  = '';
                        fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                        fn += '<i class="si si-pointer"></i> ';
                        fn += l.feature.properties.name;
                        fn += '</div>';
                    $('#m_feature_name').append(fn)
                })
            })  
        }
        else
        {
            $('#m_feature_search').attr('placeholder','Cari '+$('#m_layer_search option[value="'+$(this).val()+'"]')[0].text+'...');
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#m_layer_search option[value="'+$(this).val()+'"]')[0].text+'</div>';
            $('#m_feature_name').append(nl);
            osm_layers[$(this).val()].eachLayer(l=>{
                let fn  = '';
                    fn += '<div class="feature_name" data-name="'+$(this).val()+'" data-id="'+l._leaflet_id+'">';
                    fn += '<i class="si si-pointer"></i> ';
                    fn += l.feature.properties.name;
                    fn += '</div>';
                $('#m_feature_name').append(fn)
            })
        }
    })

    $('#m_feature_search').keyup(function(){
        $('#m_feature_name').html('');
        let cari = new RegExp($(this).val(), 'i');
        if($('#m_layer_search').val() == 'all_layer')
        {
            $('#side_layers input[type="checkbox"]:checked').each(function(i){
                let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$(this).attr('data-name')+'</div>';
                $('#m_feature_name').append(nl);
                osm_layers[$(this).attr('name')].eachLayer(l=>{
                    
                    if(l.feature.properties.name !== null)
                    {
                        if(l.feature.properties.name.match(cari))
                        {
                            let fn  = '';
                                fn += '<div class="feature_name" data-name="'+$(this).attr('name')+'" data-id="'+l._leaflet_id+'">';
                                fn += '<i class="si si-pointer"></i> ';
                                fn += l.feature.properties.name;
                                fn += '</div>';
                            $('#m_feature_name').append(fn);
                        }
                    }
                })
            })  
        }
        else
        {
            let nl = '<div style="font-size:larger;font-weight:bolder; margin-top: 20px; margin-bottom:10px">'+$('#m_layer_search option[value="'+$('#m_layer_search').val()+'"]')[0].text+'</div>';
            $('#m_feature_name').append(nl);
            osm_layers[$('#m_layer_search').val()].eachLayer(l=>{
                
                if(l.feature.properties.name !== null)
                {
                    if(l.feature.properties.name.match(cari))
                    {
                        let fn  = '';
                            fn += '<div class="feature_name" data-name="'+$('#m_layer_search').val()+'" data-id="'+l._leaflet_id+'">';
                            fn += '<i class="si si-pointer"></i> ';
                            fn += l.feature.properties.name;
                            fn += '</div>';
                        $('#m_feature_name').append(fn);
                    }
                }
                
            })
        }
    })
    
    $('#m_feature_name').on('click','.feature_name',function(e){
        console.log('clicked: ',
            osm_layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')]
        )
        
        let l = osm_layers[$(this).attr('data-name')]._layers[$(this).attr('data-id')];
        
        // osm_map.flyTo()
        
        if(l.feature.geometry.type == 'Point')
        {
            // console.log(l.feature.geometry.type)
            // console.log('latlng: ',l._latlng.toBounds());
            // let bounds = l._latlng.toBounds();
            // let center = bounds.getCenter();
            // console.log('center: ',center);
            let center = l._latlng;

            osm_map.flyTo(center,19);
        }
        else if(l.feature.geometry.type == 'LineString')
        {
            // console.log(l.feature.geometry.type)
            // let bounds = osm_layers[$(this).attr('data-name')].getBounds();
            // let center = bounds.getCenter();
            let center = l._latlngs[(l._latlngs.length/2)];
            osm_map.flyTo(center,15);
        }
        else if(l.feature.geometry.type == 'Polygon')
        {
            let center = l._latlngs[0][0];
            osm_map.flyTo(center,15);
        }

    })

    $('#m_layer_search').select2();
    $('.search_layer').select2();
    $('.box_search').hide();
    $('.btn_search').click(function(e){
        console.log($(this));
        $('#m_box_search_'+$(this).attr('data-slug')).slideToggle();
    });
    

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

 
        // get_osm_map(osm_cb,geojson_url);
    
    

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
            $('span[data-name="'+$(this).attr('name')+'"]').show()
            let geojson_url = '<?=base_url()?>peta/get_geojson/'+$(this).attr('id_layer');
            if(typeof osm_layers[$(this).attr('name')] == 'undefined')
            {
                get_osm_map($(this),geojson_url);
            }
            else
            {
                osm_layers[$(this).attr('name')].addTo(osm_map);
                $('.bar_loader').hide();
            }
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
            console.log('lat: ',lat,'lng: ',lng);
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

function init_map_osm_c(){
    caches.open('mymap')
    .then(r=>{
        // console.log('a',r);
    })
    .catch(r=>{
        console.log('b',r);
    })
}

function get_osm_map(osm_cb,geojson_url){
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
    let osm_popup = L.popup();
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
            $('.bar_loader').hide();
        }

    })
}

</script>