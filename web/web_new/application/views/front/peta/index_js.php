<script src="<?= base_url() ?>assets_frontend/js/leaflet-ajax.js"></script>
<script src="<?= base_url() ?>assets_frontend/js/leaflet-simple-map-screenshoter.js"></script>
<script src="<?= base_url() ?>assets_frontend/js/FileSaver.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
    integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
    integrity="sha384-N2S8y7hRzXUPiepaSiUvBH1ZZ7Tc/ZfchhbPdvOE5v3aBBCIepq9l+dBJPFdo1ZJ" crossorigin="anonymous">
</script>

<script>
var map;
var basemap = {};
var active_basemap = 'osm';
var zoom = 13;
var layers = {};
var search_marker = '';
var active_icons = {};
const xconfig = [];
const xdata = [];
const xalias = [];


$(document).ready(function() {
    $('.bar_loader').hide();

    // init_map();

    map = L.map('map', {
        attributionControl: false,
        zoomControl: false
    }).setView([-7.5519941, 110.8003075], zoom);

    // L.tileLayer(
    //     'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    //         maxZoom: 13,
    //         attribution: 'Map data � OpenStreetMap contributors.',
    //         id: 'mapbox/streets-v11',
    //         tileSize: 512,
    //         zoomOffset: -1,
    //     }).addTo(map);

    let batas =
        'https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/uploads/geojson/batas_kecamatan_kota_surakarta.json';

    let batas_style = (f) => {
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
            fillOpacity: 0.5,
            color: color,
            opacity: 0.8,
            weight: 2,
            dashArray: '3,5',
            dahsOffset: 0
        }
    }

    $.getJSON(batas, function(data) {
        // console.log(data)
        L.geoJSON(data, {
            style: batas_style
        }).addTo(map);
    })

    $.ajax({
        url: 'frontend/get_data',
        type: "POST",
        dataType: "json",
        success: function(data) {
            data.forEach(element => {
                console.log(data)
                $.each(element.result, function(index, value) {
                    const ijo = (() => {
                        if (value.status == 'Responded') {
                            return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="' +
                                value.content +
                                '" class="text-success col-6 click">' +
                                value.status + '</span>';
                        } else if (value.status == 'Process') {
                            return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="' +
                                value.content +
                                '"class="text-warning col-6 click">' +
                                value.status + '</span>';
                        } else {
                            return '<br><b>Status :</b><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="' +
                                value.content +
                                '" class="text-warning col-6 click">' +
                                value.status + '</span>';
                        }
                    })();
                    $(document).on("click", ".click", function() {
                        var myBookId = $('#click').data('id');
                        $(".modal-body").val(myBookId);
                        $(".modal-body h5").text(myBookId);
                    });
                    var result;

                    // Slice is JS function
                    result = value.content.slice(0, 100) + '.....';
                    const marker = L.marker([value.lat, value.long]).bindPopup(
                            'Judul : ' +
                            value.title + ijo + '<br><b>Unit : </b>' + value
                            .unit_del +
                            '<br><b>Kategori : </b>' + value.cat +
                            '<br><b>Tanggal : </b>' +
                            value.tgl_sug + '<br><b>Nama : </b>' + value.name +
                            '<br><b>Email : </b>' + value.mail +
                            '<br><b>Telepon : </b>' + value
                            .telp +
                            '<br><span data-toggle="modal" data-target="#exampleModal" id="click" data-id="' +
                            value + '"><b>Deskripsi : </b>' + result +
                            '</span><br><a data-toggle="modal" data-target="#exampleModal" id="click" data-id="' +
                            value +
                            '" class="text-info col-6 click">Selengkapnya</a>')
                        .addTo(
                            map);
                });
            });
        },
        error: function(error) {
            console.log("Error:");
            console.log(error);
        }
    })

    basemap = {
        osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }),
        google_roadmap: L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        google_satellite: L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        google_hybrid: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        google_terrain: L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        esri_world_imagery: L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 17
            }),
        esri_world_street_map: L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'
        ),
        esri_world_topo_map: L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'
        ),
        esri_gray_map: L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 17
            }),
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

    basemap[active_basemap].addTo(map);
    L.control.scale().addTo(map);

    map.on('click', function(e) {
        $('input[name="cari_lat"]').val(e.latlng.lat);
        $('input[name="cari_lng"]').val(e.latlng.lng);
        $('input[name="m_cari_lat"]').val(e.latlng.lat);
        $('input[name="m_cari_lng"]').val(e.latlng.lng);
        search_marker != '' ? map.removeLayer(search_marker) : '';
    })

    $('#btn_map_info').click(function() {

        if ($('#side_info').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_info').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_info').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });


    $('#btn_map_layers').click(function() {

        if ($('#side_layers').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_layers').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_layers').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('#btn_map_home').click(function() {
        window.location.replace('<?= base_url() . 'login' ?>');
    })

    $('#btn_map_info').click(function() {

        if ($('#side_info').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_info').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_info').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('#btn_map_menu').click(function() {
        $('.btn_map').fadeToggle();
        $('.side_option').hide('fade');
    });

    $('#btn_map_base').click(function() {
        if ($('#side_base').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_base').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_base').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    });

    $('.side_option_content').slimScroll({
        color: '#e9a837',
        height: '60vh'
    });

    $('#side_base input[type="radio"][name="base_map"]').change(function() {
        map.removeLayer(basemap[active_basemap]);
        active_basemap = $(this).val();
        basemap[active_basemap].addTo(map);
    })

    $('#btn_map_zoom_in').click(function() {
        zoom++
        map.setZoom(zoom);

    })

    $('#btn_map_zoom_out').click(function() {
        zoom--
        map.setZoom(zoom);

    })

    $('#btn_map_search').click(function() {

        if ($('#side_search').hasClass('active_option')) {
            $('.side_option').removeClass('active_option');
            $('#side_search').hide('slide');
        } else {
            $('.side_option').removeClass('active_option');
            $('#side_search').addClass('active_option');
            $('.side_option').hide('slide');
            $('.side_option.active_option').show('slide');
        }

    })

    $('#cari_latlng').click(function() {
        if (
            $('input[name="cari_lat"]').val() != null &&
            $('input[name="cari_lat"]').val() != '' &&
            $('input[name="cari_lat"]').val() != 0 &&
            $('input[name="cari_lat"]').val() != '0' &&
            $('input[name="cari_lng"]').val() != null &&
            $('input[name="cari_lng"]').val() != '' &&
            $('input[name="cari_lng"]').val() != 0 &&
            $('input[name="cari_lng"]').val() != '0'
        ) {
            search_marker != '' ? map.removeLayer(search_marker) : '';
            var lat = $('input[name="cari_lat"]').val();
            var lng = $('input[name="cari_lng"]').val()
            map.flyTo([lat, lng], 16);
            search_marker = L.marker([lat, lng]).addTo(map);


        } else {
            alert('Harap masukkan latitude & longitude');
        }


    })

    $('#btn_map_search').click(function(e) {

    })

    $('#info-kecamatan').on('change', function() {
        var val = $(this).val();
        $('#kategori_search').html("<option value='all'>--- kategorii ---</option>");

        let data = new FormData();
        data.append('id_cat', val);

        $.ajax({
            url: 'frontend/get_filter_kategori',
            type: "POST",
            data: data,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#loader_modal').fadeIn(300);
            },
            complete: function() {
                $('#loader_modal').fadeOut(300);
            },
            success: function(data) {
                if (data.status == 'success') {

                    var data = data.data;
                    var html = "<option value='all'>--- kategori ---</option>";
                    for (var i = 0; i < data.length; i++) {
                        html += "<option value='" + data[i].id_cat + "'>" + data[i]
                            .cat_name + "</option>";
                    }
                    $("#kategori_search").html(html);

                }
            }
        });
    });


})

// function init_map() {

// }
</script>