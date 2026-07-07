<!-- Main Scripts-->
  <script src="<?= base_url('assets_frontend/assets/')?>js/jquery.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/menu.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/jquery.parallax-1.1.3.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/jquery.simple-text-rotator.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/wow.min.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/custom.js"></script>
    
  <script src="<?= base_url('assets_frontend/assets/')?>js/jquery.isotope.min.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>js/custom-portfolio-masonry.js"></script>

  <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhEuzRypAQIK2FaN3Kbq8lp_C5nIi6SOE&callback=initialize&libraries=places"></script>
  <script type="text/javascript">
      var revapi;
      jQuery(document).ready(function() {
          
      });
      
      var map, infoWindow, geocoder, path, sidebar;
    var markers = new Array();
    var marker = null;
    var markerPengaduan = null;
    var lat = -7.5596766;
    var lng = 110.8213025;

    var tampung_lat = $('[name=lat]');
    var tampung_lng = $('[name=lng]');

    function initialize() {
        geocoder = new google.maps.Geocoder();
        var myOptions = {
            zoom: 13,
            center: new google.maps.LatLng(lat, lng),
            disableDoubleClickZoom: true,
            draggableCursor: "crosshair"
        }
        
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        
        var banjarsari = new google.maps.KmlLayer({
            url: 'https://investasi.surakarta.go.id/assets/fronts/banjarsari1.kml',
            map: map,
            preserveViewport: true
        });
        var jebres = new google.maps.KmlLayer({
            url: 'https://investasi.surakarta.go.id/assets/fronts/jebres1.kml',
            map: map,
            preserveViewport: true
        });
        var laweyan = new google.maps.KmlLayer({
            url: 'https://investasi.surakarta.go.id/assets/fronts/laweyan1.kml',
            map: map,
            preserveViewport: true
        });
        var pasar_kliwon = new google.maps.KmlLayer({
            url: 'https://investasi.surakarta.go.id/assets/fronts/pasar_kliwon1.kml',
            map: map,
            preserveViewport: true
        });
        var serengan = new google.maps.KmlLayer({
            url: 'https://investasi.surakarta.go.id/assets/fronts/serengan1.kml',
            map: map,
            preserveViewport: true
        });

        var mcOptions = {
            gridSize: 80,
            maxZoom: 15
        };
        // var markerclusterer = new MarkerClusterer(map, [], mcOptions);
        infoWindow = new google.maps.InfoWindow({
            maxWidth: 300
        });
        var pm;

        google.maps.event.addListener(map, 'click', function() {
            infoWindow.close();
        });

        google.maps.event.addListener(map, 'click', function(event) {
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];
            if (markerPengaduan) {
                markerPengaduan.setMap(null);
                markerPengaduan = null;
            }
            set_temp_lokasi(event.latLng.lat(), event.latLng.lng());
            
            path = event.latLng.lat() + "," + event.latLng.lng();
            //save();
            var temp = ({
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            });
            var hasilGeo;
            geocoder.geocode({
                'location': temp
            }, function(results, status) {
                marker = event.latLng;
                if (status === 'OK') {
                    if (results[0]) {
                        markerPengaduan = createMarker(event.latLng, "name", "<b>Location</b><br>" + results[0].formatted_address + '<br/>');
                        $("[name=lokasi]").val(results[0].formatted_address);
                    }
                } else {
                    markerPengaduan = createMarker(event.latLng, "name", "<b>Location</b><br>" + event.latlng + '<br/>');
                }
            });
            
        })
        var lat_lng = new google.maps.LatLng(lat, lng);

        
        /* ---------------------------------------------------------------------- */
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        
        searchBox.addListener('places_changed', function() {
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];
            if (markerPengaduan) {
                markerPengaduan.setMap(null);
                markerPengaduan = null;
            }
            
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            
            infoWindow = new google.maps.InfoWindow({
                maxWidth: 300
            });
            
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                map.fitBounds(bounds);
                GetLatlong(markers[0]);
            });
        });
        
        markerPengaduan = createMarker(lat_lng, name, "");
    }
      
      function GetLatlong(tanda) {
          var geocoder = new google.maps.Geocoder();
          var address = document.getElementById('pac-input').value;
          geocoder.geocode({ 'address': address }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  var latitude = results[0].geometry.location.lat();
                  var longitude = results[0].geometry.location.lng();
                  var addre = results[0].formatted_address;
                  $("[name=lat]").val(latitude);
                  $("[name=lng]").val(longitude);
                  $("[name=lokasi]").val(addre);
                  infoWindow.setContent("<b>Location</b><br>" + addre);
                  infoWindow.open(map, tanda);
              }
          });
      }

    function createMarker(latlng, name, html) {
        var contentString = html;
        var tanda = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true,
            zIndex: Math.round(latlng.lat() * -100000) << 5
        });

        google.maps.event.addListener(tanda, 'click', function() {
            infoWindow.setContent(contentString);
            infoWindow.open(map, tanda);
        });

        google.maps.event.addListener(tanda, 'dragend', function(event) {
            set_temp_lokasi(event.latLng.lat(), event.latLng.lng())
            var temp = ({
                lat: event.latLng.lat(),
                lng: event.latLng.lng()
            });
            var hasilGeo;
            geocoder.geocode({
                location: temp
            }, function(results, status) {
                marker = event.latLng;
                if (status === 'OK') {
                    if (results[0]) {
                        contentString = "<b>Location</b><br>" + results[0].formatted_address + '<br/>';
                        $("[name=lokasi]").val(results[0].formatted_address);
                    }
                } else {
                    contentString = "<b>Location</b><br>" + results[0].formatted_address + '<br/>';
                }
            });
            google.maps.event.trigger(tanda, 'click');
        });


        google.maps.event.trigger(tanda, 'click');

        return tanda;
    }

    function set_temp_lokasi(lat, lng) {
        tampung_lat.val(lat)
        tampung_lng.val(lng)
    }
      
      function save() {
        $("#path").val(JSON.stringify(path));
    }
      
      $('#laporform').on('submit', function(){
          $('#btn-submit').html('<?= '<img style="width: 20px; margin-top: 0px; margin-bottom: 0px;" src="'.base_url('assets_frontend/gif/loading.gif').'"> Mengirim...'?>');
          $('#btn-submit').prop('disabled',true);
      })
    </script>

  <!-- Royal Slider script files -->
  <script src="<?= base_url('assets_frontend/assets/')?>royalslider/jquery.easing-1.3.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>royalslider/jquery.royalslider.min.js"></script>
    