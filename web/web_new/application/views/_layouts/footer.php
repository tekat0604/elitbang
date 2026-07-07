<?php $get_profil_website = get_profil_website(); ?>
<section class="bg-black half-section">
    <div class="container">
        <div class="row row-cols-2 row-cols-lg-3 row-cols-sm-3">

            <div class="col text-center md-margin-30px-bottom xs-margin-40px-bottom last-paragraph-no-margin wow animate__fadeIn"
                data-wow-delay="0.2s">
                <i
                    class="feather icon-feather-map-pin icon-small text-neon-orange margin-25px-bottom sm-margin-10px-bottom d-block"></i>
                <div
                    class="text-white text-uppercase text-medium font-weight-500 alt-font letter-spacing-1px margin-10px-bottom">
                    Alamat</div>
                <p class="text-white opacity-4 w-70 lg-w-100 md-w-60 sm-w-80 sm-margin-10px-bottom mx-auto">l. A. Yani
                    No.350-354, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57138</p>
            </div>

            <div class="col text-center md-margin-30px-bottom xs-margin-40px-bottom last-paragraph-no-margin wow animate__fadeIn"
                data-wow-delay="0.4s">
                <i
                    class="feather icon-feather-phone-call icon-small text-neon-orange margin-25px-bottom sm-margin-10px-bottom d-block"></i>
                <div
                    class="text-white text-uppercase text-medium font-weight-500 alt-font letter-spacing-1px margin-10px-bottom">
                    Kontak Kami</div>
                <p class="text-white opacity-4 w-70 lg-w-100 sm-w-80 sm-margin-10px-bottom mx-auto">(0271) 7464455</p>
            </div>

            <div class="col text-center xs-margin-30px-bottom xs-margin-40px-bottom last-paragraph-no-margin wow animate__fadeIn"
                data-wow-delay="0.6s">
                <i
                    class="feather icon-feather-mail icon-small text-neon-orange margin-25px-bottom sm-margin-10px-bottom d-block"></i>
                <div
                    class="text-white text-uppercase text-medium font-weight-500 alt-font letter-spacing-1px margin-10px-bottom">
                    Email</div>
                <p class="sm-margin-10px-bottom mx-auto">
                    <a href="mailto:<?= $get_profil_website->email ?>"><?= $get_profil_website->email ?></a>
                </p>
            </div>
        </div>
    </div>
    <footer
        class="footer-events-conference footer-dark bg-black border-top border-color-white-transparent padding-10px-tb">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-lg-2 order-1 order-lg-2 text-center md-margin-20px-bottom">
                    <a href="index.html" class="footer-logo"><img
                            src="<?= base_url('assets_frontend/new_assets/') ?>/images/bpbd-putih.png"
                            data-at2x="<?= base_url('assets_frontend/new_assets/') ?>/images/bpbd-logo.png" alt=""></a>
                </div>
                <div class="col-12 col-lg-5 col-md-6 order-3 text-center text-md-end last-paragraph-no-margin">
                    <p>Hak Cipta &copy; BPBD Kota Surakarta 2021</p>
                </div>
            </div>
        </div>
    </footer>
</section>


<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up"></i></a>
<!-- end scroll to top -->
<!-- Resources -->

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="<?= base_url('assets_frontend/new_assets/') ?>/js/chart.js"></script>
<script src="<?= base_url('assets_frontend/new_assets/') ?>/js/custom.js"></script>
<!-- javascript -->
<script type="text/javascript" src="<?= base_url('assets_frontend/new_assets') ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/new_assets') ?>/js/theme-vendors.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/new_assets') ?>/js/main.js"></script>
<!-- <script type="text/javascript" src="<?= base_url('assets_frontend/new_assets') ?>/js/orgChart.min.js"></script> -->
<!-- <script type="text/javascript" src="<?= base_url('assets_frontend/new_assets') ?>/js/struktur-org.js"></script> -->
<?php
if (isset($extra_js)) {
    $this->load->view($extra_js);
}
?>

<script>
(function(d) {
    var s = d.createElement("script");
    s.setAttribute("data-account", "sL7Pl2DsYt");
    s.setAttribute("src", "https://cdn.userway.org/widget.js");
    (d.body || d.head).appendChild(s);
})(document)
</script><noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website
        accessibility</a></noscript>