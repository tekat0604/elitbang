<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<link rel='stylesheet' href='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css'>
<link rel='stylesheet' href="<?= base_url('assets_frontend/leaflet-custom-searchbox-master/dist/searchbox.min.css') ?>">

<!-- Main Scripts-->
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/menu.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.parallax-1.1.3.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.simple-text-rotator.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/wow.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/custom.js"></script>

<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.isotope.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/custom-portfolio-masonry.js"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Royal Slider script files -->
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.easing-1.3.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.royalslider.min.js"></script>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js'></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js'></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var revapi, rsi, marker, mymap, layerGroup, searchboxControl, control;
    var locations = [];

    $(document).ready(function() {
        revapi = $('.tp-banner').revolution({
            delay: 9000,
            startwidth: 1170,
            startheight: 600,
            hideThumbs: 10,
            fullWidth: "on",
            // forceFullWidth: "on"
        });

        rsi = $('#slider-in-laptop').royalSlider({
            autoHeight: true,
            arrowsNav: false,
            fadeinLoadedSlide: false,
            controlNavigationSpacing: 0,
            controlNavigation: 'bullets',
            imageScaleMode: 'fill',
            imageAlignCenter: true,
            loop: false,
            loopRewind: false,
            numImagesToPreload: 6,
            keyboardNavEnabled: true,
            autoScaleSlider: true,
            autoScaleSliderWidth: 486,
            autoScaleSliderHeight: 315,
            imgWidth: 792,
            imgHeight: 479

        }).data('royalSlider');
        $('#slider-next').click(function() {
            rsi.next();
        });
        $('#slider-prev').click(function() {
            rsi.prev();
        });

        locations = <?= json_encode($locations) ?>;
        //initMap(locations);
    });

    function initMap(loc, redraw = null) {
        if (redraw) {
            locations = [];
            mymap.remove();
        }

        //mymap = L.map('map',{scrollWheelZoom: false}).setView([-7.5596766, 110.8213025], 12);
        mymap = L.map('map', {
            scrollWheelZoom: false
        }).setView([-7.558517689092, 110.82824680176], 13);

        /* show filter */
        searchboxControl = createSearchboxControl();
        control = new searchboxControl({
            sidebarTitleText: '',
        });
        control._searchfunctionCallBack = function(searchkeywords) {
            if (!searchkeywords) {
                searchkeywords = "The search call back is clicked !!"
            }
            refresh_map('search', searchkeywords);
        }

        /* show maps */
        locations = loc;
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            //maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'sk.eyJ1IjoidGVsdXItbWF0YW5nIiwiYSI6ImNrOHM3MWhxejBkY2kzZnA5OXd3ODZnaWEifQ.EtJ7ADpJy6a9hBXfGphMvA'
        }).addTo(mymap);

        add_locations(locations);
        mymap.addControl(control);



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
            }).addTo(mymap);
        });
    }

    function add_locations() {
        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]] /*, {icon: greenIcon}*/ )
                .bindPopup(locations[i][0])
                .addTo(mymap);
        }
    }

    function refresh_map(type, input) {
        $.ajax({
            url: '<?= base_url('load_maps/get_maps?type=') ?>' + type + '&param=' + input,
            type: 'get',
            data: {},
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function(response) {
                initMap(response, true);
            },
            error: function() {
                alert('Gagal terhubung ke server');
            }
        });
    }
</script>
<script>
    (function() {
        var s = document.createElement("script");
        s.setAttribute("data-account", "GmB3uqn0Ax");
        s.setAttribute("src", "https://cdn.userway.org/widget.js");
        document.body.appendChild(s);
    })();
</script><noscript>Enable JavaScript to ensure <a href="https://userway.org">website accessibility</a></noscript>