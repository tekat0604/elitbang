<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function() {
        var map = L.map('map').setView([-7.558517689092, 110.82824680176], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);

        //Batas Kecamatan 
        let batas_kec_json = base_url + 'uploads/geojson/batas_kecamatan_kota_surakarta.json';
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

        var circles;
        var marker_top;

        function onLocationFound(e) {
            var radius = e.accuracy / 2;
            marker_top = L.marker(e.latlng);
            marker_top.addTo(map);
            circles = L.circle(e.latlng, radius);
            circles.addTo(map);
            //marker_top.bindPopup("You are within " + radius + " ==== " +e.latlng + " meters from this point").openPopup();        
            $('#latitude').val(e.latlng.lat);
            $('#longitude').val(e.latlng.lng);
            removeClassEmptyMap();
        }

        function onLocationError(e) {
            alert(e.message);
        }

        var theMarker = {};
        map.on('click', function(e) {
            if (marker_top != undefined) {
                kosongkanLokasi();
            }
            console.log(marker_top);
            if (theMarker != undefined) {
                map.removeLayer(theMarker);
                $('#latitude').val(e.latlng.lat);
                $('#longitude').val(e.latlng.lng);
                removeClassEmptyMap();
            };
            //Add a marker to show where you clicked.
            theMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
        });

        //reloadLokasi();
        $('#reload_lokasi').on('click', function(e) {
            if (theMarker != undefined) {
                //kosongkanMarker(); 
            }
            if (marker_top != undefined) {
                kosongkanLokasi();
            }
            //kosongkanLokasi();
            reloadLokasi();

        });

        function reloadLokasi() {
            kosongkanMarker();
            map.on('locationfound', onLocationFound);
            map.on('locationerror', onLocationError);
            map.locate({
                setView: true,
                maxZoom: 18
            });
        }

        function kosongkanLokasi() {
            map.removeLayer(marker_top);
            map.removeLayer(circles);
        }

        function kosongkanMarker() {
            map.removeLayer(theMarker);
        }

        function removeClassEmptyMap() {
            $("#map").removeClass("empty_map");
            $('#error_koordinat').html('');
        }
        $('#form_pengiriman_aduan').submit(function(e) {
            e.preventDefault();
            //Koordinat 
            var latitude = $("#latitude").val();
            var longitude = $("#longitude").val();
            var nama = $("#nama").val();
            var email = $("#email").val();
            var no_hp = $("#no_hp").val();
            var subjek = $("#subjek").val();
            var kategori = $("#kategori").val();
            var lokasi = $("#lokasi").val();
            var captcha = $("#captcha").val();

            if (latitude == "") {
                $('.validasi').html('');
                $("#latitude").focus();
                $("#map").addClass("empty_map");
                //$("#longitude").focus();   
                $('#error_koordinat').html(`
                <div class="text-danger">
                <i class="fa fa-exclamation-triangle"></i> Titik Lokasi belum ditentukan 
                </div>
            `);
            } else if (nama == "") {
                $('.validasi').html('');
                $("#nama").focus();
                $('#error_nama').html(`
                <div class="text-danger">
                <i class="fa fa-exclamation-triangle"></i> Nama Belum di isi
                </div>
            `);
            } else if (no_hp == "") {
                $('.validasi').html('');
                $('#error_no_hp').html(`
                <div class="text-danger"> 
                 <i class="fa fa-exclamation-triangle"></i> No HP Belum di isi
                </div>
            `);
                $("#no_hp").focus();
            } else if (subjek == "") {
                $('.validasi').html('');
                $('#error_subjek').html(`
                <div class="text-danger"> 
                 <i class="fa fa-exclamation-triangle"></i> Subjek Belum di isi
                </div>
            `);
                $("#subjek").focus();
            } else if (kategori == "") {
                $('.validasi').html('');
                $('#error_kategori').html(`
                <div class="text-danger"> 
                 <i class="fa fa-exclamation-triangle"></i> Kategori Belum dipilih
                </div>
            `);
                $("#kategori").focus();
            } else if (lokasi == "") {
                $('.validasi').html('');
                $('#error_lokasi').html(`
                <div class="text-danger"> 
                 <i class="fa fa-exclamation-triangle"></i> Lokasi belum di isi
                </div>
            `);
                $("#lokasi").focus();
            } else if (captcha == "") {
                $('.validasi').html('');
                $('#error_captcha').html(`
                <div class="text-danger"> 
                 <i class="fa fa-exclamation-triangle"></i> Kode Captcha belum di isi
                </div>
            `);
                $("#captcha").focus();
            } else {
                $('.validasi').html('');
                $.ajax({
                    url: base_url + 'lapor/proses',
                    type: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    beforeSend: function() {
                        $('#notifikasi_aduan').html(`Prosess....`);
                    },
                    success: function(res) {
                        if (res.status == "captcha_salah") {
                            $('#error_captcha').html(`
                            <div class="text-danger"> 
                             <i class="fa fa-exclamation-triangle"></i> ` + res.msg + ` 
                            </div>
                        `);
                        } else if (res.status == "success") {
                            $('#notifikasi_aduan').html(`
                            <div class="alert alert-success" role="alert">
                                <i class="fa fa-check-circle"></i> ` + res.msg + `
                            </div> 
                        `);
                            $('.hide_after_sent_form').hide();
                        } else {
                            $('#notifikasi_aduan').html(` 
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-exclamation-triangle"></i> Laporan Anda Gagal dikirim.
                            </div>
                        `);
                        }
                    },
                });
            }
        });
        $('#tambah_image').change(function(e) {
            var label_text = $(this).val();
            if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
            $('#tambah_image_label').text(label_text);
            file_preview(this, 'tambah_image');
        });

        function file_preview(input, id_name) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + id_name + '_preview').remove();
                    $('#' + id_name + '_preview_container').html(
                        `<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
                    <img src="` + e.target.result + `" 
                    style="width: 100%; height: 100%;vertical-align:middle"/>
                    <div style="margin-top: 5px;">
                        <button type="button" class="btn btn-sm btn-block btn-danger hapus_image" 
                        id_name="` + id_name + `"> Hapus <i class="fa fa-exit"></i> </button>
                    </div>  
                </div>          
                `);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '.hapus_image', function() {
            var id_name = $(this).attr("id_name");
            $('#' + id_name + '_preview_container').html('');
            $('#' + id_name + '_label').text('Silahkan pilih file...');
            $('#' + id_name + '').val('');
        });
    });


    function getKelurahan(selectObject) {
        var id_kecamatan = selectObject.value;
        loadKelurahan(id_kecamatan);
    }

    function loadKelurahan(id_kecamatan) {
        $.ajax({
            url: base_url + 'lapor/select_kelurahan_by_kec',

            type: 'POST',
            dataType: 'JSON',
            data: {
                kecamatan_id: id_kecamatan
            },
            success: function(data) {
                var html = "<option value=''>--- Silakan Pilih Kelurahan ---</option>";
                for (var i = 0; i < data.length; i++) {
                    html += "<option value='" + data[i].id_kelurahan + "'>" + data[i].nama + "</option>";
                }
                $("#id_kelurahan").html(html);
            }
        });
    }
</script>