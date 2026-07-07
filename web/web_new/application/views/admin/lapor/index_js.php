<script>
    var table;
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $(document).ready(function() {
        load_table('all');
    });

    function load_table(input = null) {
        table = $('#mydata').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('admin/lapor/daftar_lapor/') ?>" + input,
                "type": "POST",
            },
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
                emptyTable: 'Tidak ada data'
            },

            "columnDefs": [],

        });
    }

    function refresh_table(input) {
        $('.panel-count').css({
            'background-color': 'white'
        });
        $('#' + input).css({
            'background-color': '#8fb1c9'
        });
        table.destroy();
        load_table(input);
    }

    function reload() {
        table.ajax.reload();
    }

    function go_to(url = null) {
        if (url) {
            location.href = url;
        } else {
            alert('Url is empty');
        }
    }

    function update_value(input) {
        $('#' + input.dataset.kode).prop('disabled', true);
        if (input.checked) {
            var new_value = 1;
        } else {
            var new_value = 0;
        }

        $.ajax({
            url: '<?= base_url('processing/update_tb_lapor') ?>',
            type: 'GET',
            data: {
                kode: input.dataset.kode,
                new_value: new_value
            },
            cache: false,
            dataType: "JSON",
            success: function(response) {
                if (response.status == false) {
                    alert(response.status);
                }
                $('#' + input.dataset.kode).prop('disabled', false);
                $('#count-ditangani').html(response.count_ditangani);
            },
            error: function() {
                alert('Gagal terhubung ke server');
                $('#' + input.dataset.kode).prop('disabled', false);
            }
        });
    }
</script>
<script src="<?php echo base_url(''); ?>assets/js/plugins/howler/howler.min.js"></script>
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"></script>
<script src="<?php echo base_url(''); ?>assets/leaflet/real_time/leaflet-realtime.js"></script>
<script src="<?php echo base_url(''); ?>assets/leaflet/real_time/leaflet_awesome_number_markers.js"></script>
<script src="<?php echo base_url(''); ?>assets/leaflet/leaflet.ajax.min.js"></script>
<script>
    var base_url = "<?php echo base_url(); ?>";
    //Creation of map tiles
    var googleRoadMap = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var osmMap = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>',
    });
    var gsMap = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 18,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    var ghMap = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    var esriwsMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}');

    //Map creation
    var map = L.map('map', {
        layers: [googleRoadMap]
    }).setView([-7.558517689192, 110.82824680276], 13);
    //Base layers definition and addition
    var baseLayers = {
        "Google Road Map": googleRoadMap,
        "Google Satelit": gsMap,
        "Google Hibrid": ghMap,
        "Open Street Map": osmMap,
        "Esri World Street Map": esriwsMap
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



    //Batas Kecamatan 
    let batas_kec_json = '<?php echo base_url(''); ?>uploads/geojson/batas_kecamatan_kota_surakarta.json';
    let batas_style_kec = (f) => {
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
            fillOpacity: 0.4,
            color: color,
            opacity: 0.8,
            weight: 2,
            dashArray: '3,5',
            dahsOffset: 0
        }
    }


    $.getJSON(batas_kec_json, function(data) {
        L.geoJSON(data, {
            style: batas_style_kec
        }).addTo(map);
    });


    realtime = L.realtime({
        url: '<?php echo base_url(''); ?>admin/lapor/api_peta',
        crossOrigin: true,
        type: 'json'
    }, {
        interval: 4 * 1000,
    }).addTo(map);

    var alarm = new Howl({
        src: ['<?php echo base_url(''); ?>assets/audio/beep-06.mp3'],
        // autoplay: true
    });

    // $(function() {
    // 	alarm.play();
    // })
    realtime.on('update', function(e) {
        //alert("jion");
        // console.log(e);
        updateFeatureIcon = function(fId) {
            var feature = e.features[fId],
                mynumber = feature.properties.id;
            color = feature.properties.color;
            realtime.getLayer(fId).setIcon(new L.AwesomeNumberMarkers({
                number: '<div class="circle_marker"></div>',
                markerColor: color.toLowerCase()
            }));
        };
        Object.keys(e.update).forEach(updateFeatureIcon);

        //POP UP
        popupContent = function(fId) {
                var feature = e.features[fId];
                var img = '';
                if (feature.properties.img != '') {
                    img += `<img src="` + feature.properties.img + `" style="width: 100%; border-radius: 10px;">`;
                } else {
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
                    <span id="detail_subjek">` + feature.properties.subjek + `</span> 
                </td>
            </tr>
            <tr>
                <td> Status </td>
                <td> : </td>
                <td> 
                    <span id="detail_status" style="color: ` + feature.properties.color + `;"> 
                    ` + feature.properties.status + ` 
                    </span> 
                </td>
            </tr>
            <tr>
                <td> Tanggal </td>
                <td> : </td>
                <td> 
                    <span id="detail_tanggal"> ` + feature.properties.tanggal + ` </span> 
                </td>
            </tr>
            <tr>
                <td> Lokasi </td>
                <td> : </td>
                <td> 
                    <span id="detail_lokasi"> ` + feature.properties.lokasi + ` </span> 
                </td>
            </tr>
            <tr>
                <td> Foto </td>
                <td> : </td>
                <td> ` + img + ` </td>
            </tr>
            <tr style="height: 50px;">
                <td style="border-bottom-left-radius: 10px; "> Aksi </td>
                <td> : </td>
                <td style="border-bottom-right-radius: 10px;"> 
                    <a href="` + feature.properties.link_detail + `" class="btn_action" 
                    style="background: ` + feature.properties.color + `;"> Detail </a> 
                </td>
            </tr> 
        </table> 
        `;
                var feature = e.features[fId],
                    c = feature.geometry.coordinates;
                return '' + tabel + ' ';
            },

            bindFeaturePopup = function(fId) {


                realtime.getLayer(fId).bindPopup(popupContent(fId));
            },
            updateFeaturePopup = function(fId) {
                realtime.getLayer(fId).getPopup().setContent(popupContent(fId));
            };

        // Mengubah Object feature menjadi Array
        let featureArr = Object.keys(e.features).map(i => e.features[i].properties);

        //  Mencari index yang status nya belum terbaca
        const BELUM_DIBACA = 'belum dibaca';

        let findIndex = featureArr.find(feat => feat.status === 'belum dibaca');



        // Jika terdapat index yang belum terbaca maka alarm akan menyala
        var ctxAudio = new AudioContext();

        if (findIndex !== undefined) {
            ctxAudio.resume();

            alarm.play();
        }





        Object.keys(e.enter).forEach(bindFeaturePopup);
        Object.keys(e.update).forEach(updateFeaturePopup);

        reload();
    });
</script>