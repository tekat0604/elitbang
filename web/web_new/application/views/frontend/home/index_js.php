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
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Royal Slider script files -->
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.easing-1.3.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.royalslider.min.js"></script>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js'></script>
<script src='https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js'></script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var revapi, rsi, layerGroup, searchboxControl, control;

    $(document).ready(function() {
        revapi = $('.tp-banner').revolution({
            delay: 9000,
            startwidth: 1170,
            startheight: 500,
            hideThumbs: 10,
            fullWidth: "on",
            forceFullWidth: "on"
        });

        rsi = $('#slider-in-laptop').royalSlider({
            autoHeight: false,
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

    });
</script>