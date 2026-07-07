footer lama

<!-- Footer -->
    <footer class="site-footer style1" style="background-image: url(<?= base_url('assets_frontend/images/background/bg5.png') ?>); background-position: bottom center; background-repeat: no-repeat; background-size: 100%;">
        <div class="footer-top">
            <div class="container">
                <div style="padding-top: 30px;"class="row">
                    <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
                        <div class="widget widget_ftabout">
                            <div class="footer-logo">
                                <a href="index.html"><img src="<?= base_url().'assets_frontend/assets/images/'.get_website()->logo_footer ?>" alt="" style="width:300px"></a>
                                <!-- Histats.com  (div with counter) -->
                                <div id="histats_counter"></div>
                                <!-- Histats.com  START  (aync)-->
                                <script type="text/javascript">var _Hasync= _Hasync|| [];
                                _Hasync.push(['Histats.start', '1,4377358,4,602,110,40,00011001']);
                                _Hasync.push(['Histats.fasi', '1']);
                                _Hasync.push(['Histats.track_hits', '']);
                                _Hasync.push(['Histats.framed_page', '']);
                                (function() {
                                var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                                hs.src = ('//s10.histats.com/js15_as.js');
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                                })();</script>
                                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4377358&101" alt="hit counter script" border="0"></a></noscript>
                                <!-- Histats.com  END  -->
                            </div>
                            <button class="scroltop fa fa-chevron-up" ></button>
    
                            <div class="footer-social m-t30">
                                <ul>
                                    <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                            <div class="footer-logo">
                                <!-- Histats.com  (div with counter) -->
                                <div id="histats_counter"></div>
                                <!-- Histats.com  START  (aync)-->
                                <script type="text/javascript">var _Hasync= _Hasync|| [];
                                _Hasync.push(['Histats.start', '1,4377358,4,602,110,40,00011001']);
                                _Hasync.push(['Histats.fasi', '1']);
                                _Hasync.push(['Histats.track_hits', '']);
                                (function() {
                                var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                                hs.src = ('//s10.histats.com/js15_as.js');
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                                })();</script>
                                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4377358&101" alt="frontpage hit counter" border="0"></a></noscript>
                                <!-- Histats.com  END  -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="1.0s">
                        <div class="widget widget_getintuch style1">
                            <ul>
                                <h5 class="footer-title">Alamat</h5>
                                <li><?= get_website()->alamat ?></li>
                                <h5 class="footer-title">No Telepon</h5>
                                <li><?= get_website()->nomor_telpon ?></li>
                                <h5 class="footer-title">Email</h5>
                                <li><?= get_website()->email ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">
                        <div class="widget border-0">
                            <h5 class="footer-title">Lokasi</h5>
                            <?= get_website()->lokasi ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom Part -->
        <div class="footer-bottom wow fadeIn" data-wow-duration="2s" data-wow-delay="1.2s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center"> 
                        <span>Copyright © 2020 <?= get_website()->text_footer ?></span> 
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="<?= base_url() ?>assets_frontend/assets/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/wow/wow.js"></script><!-- WOW JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/lightgallery/js/lightgallery-all.min.js"></script><!-- LIGHTGALLERY JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/magnific-popup/magnific-popup.js"></script><!-- LIGHTGALLERY JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/scroll/scrollbar.min.js"></script><!-- OWL SLIDER -->
<script src="<?= base_url() ?>assets_frontend/assets/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="<?= base_url() ?>assets_frontend/assets/js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS -->
<script src="<?= base_url() ?>assets_frontend/assets/js/dz.ajax.js"></script><!-- CONTACT JS  -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/loading/anime.js"></script><!-- LOADING JS -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/loading/anime-app.js"></script><!-- LOADING JS -->
<!-- REVOLUTION JS FILES -->
<script src="<?= base_url() ?>assets_frontend/assets/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url() ?>assets_frontend/assets/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>
<?php if(isset($extra_js)){echo $extra_js;}?>
</html>