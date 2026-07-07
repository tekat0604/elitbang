<style>
    .container-fluid{
        padding:0px 0px 10px 0px;
    }
    #map{
        width: 100%;
        height: 500px;
    }
</style>
<div class="slider-wrapper">
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <ul>
					<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" data-delay="5000">
						<!-- MAIN IMAGE -->
                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/slider/slider1.jpg"  alt="video_business"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-fade fadeout fullscreenvideo"
                            data-x="0"
                            data-y="0"
                            data-speed="1000"
                            data-start="800"
                            data-easing="Power4.easeOut"
                            data-endspeed="1500"
                            data-endeasing="Power4.easeIn"
                            data-autoplay="true"
                            data-autoplayonlyfirsttime="false"
                            data-nextslideatend="true"
                            data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on"
                            style="z-index: 2">
                            <!--<video id="revvideo" class="video-js vjs-default-skin" preload="none"
                            poster='<?= base_url('assets_frontend/assets/')?>demos/video_bg.jpg' data-setup="{}">
                            </video>-->
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption big_title_onepage skewfromleft customout"
                            data-x="center" data-hoffset="0"
                            data-y="top" data-voffset="130"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="800"
                            data-start="1300"
                            data-easing="Power4.easeOut"
                            data-endspeed="300"
                            data-endeasing="Power1.easeIn"
                            data-captionhidden="on"
                            style="z-index: 6">BPBD KOTA SURAKARTA
                        </div>
					</li>
					<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/slider/slider2.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <div class="tp-caption big_title_slider customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="170"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1000"
                            data-start="500"
                            data-easing="Back.easeInOut"
                            data-endspeed="300">PERFECT THEME TO GROW YOUR BUSINESS
                        </div>
                        <div class="tp-caption small_title customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="246"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1300"
                            data-start="800"
                            data-easing="Back.easeInOut"
                            data-endspeed="300">Jollyany is a  creative awesome design for super easy to build with<br>
							our Shortcodes & Page Builder. The one and only HTML template<br>
							you'll ever have to buy. 
                        </div>
                        <div class="tp-caption small_title customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="360"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1600"
                            data-start="1100"
                            data-easing="Back.easeInOut"
                            data-endspeed="300"><a href="#" class="btn btn-primary btn-lg">Build now</a>
                        </div>
                    </li>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/slider/slider3.jpg"  alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                    </li>
                </ul>
                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <div class="calloutbox bgprimary" style="margin: 0;padding: 20px 20px 10px 20px;">
            <div class="container">
            <div class="col-lg-2 marque-judul">
                INFORMASI TERKINI:
            </div>
            <div class="col-lg-10">
                <marquee behavior="scroll" direction="left" scrollamount="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dui ligula, porta ut dolor sed, consectetur dictum eros. Duis luctus turpis at blandit volutpat. Integer non sem euismod, luctus quam id, fringilla tortor. Mauris varius iaculis lobortis. Cras placerat, sapien fringilla cursus suscipit, sapien lectus bibendum magna,</marquee>
            </div>
            </div>
        </div><!-- end messagebox -->
    </div><!-- end slider-wrapper -->

	<div class="white-wrapper" style="padding-bottom:0">
    	<div class="container">
        	<div class="messagebox">
            	<h2>BPBD Kota Surakarta memiliki prinsip <mark class="rotate">Cepat, Tangkas, Tanggap, Profesional</mark></h2>
                  
            </div><!-- end messagebox -->
		</div><!-- end container -->
    </div><!-- end white-wrapper -->


    <div class="white-wrapper" style="padding:0">
        <div class="container">
            <div class="services_vertical">
                <div class="col-lg-3 first">
                    <a href="#" style="text-decoration: none;">
                    <div class="service_vertical_box">
                        <div class="service-icon">
                            <!-- <i class="fa fa-map-marker-alt fa-4x"></i> -->
                            <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/alamat.png" alt="" style="width: 100%;">
                        </div>
                        <h3>Alamat</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                        <!-- <a href="#" class="readmore">Read More...</a> -->
                    </div><!-- end service_vertical_box -->
                    </a>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-3">
                    <a href="#" style="text-decoration: none;">
                    <div class="service_vertical_box">
                        <div class="service-icon">
                            <!-- <i class="fa fa-phone fa-4x"></i> --> 
                            <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/telepon.png" alt="" style="width: 100%;">
                        </div>
                        <h3>Telepon</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                        <!-- <a href="#" class="readmore">Read More...</a> -->
                    </div><!-- end service_vertical_box -->
                    </a>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-3">
                    <a href="#" style="text-decoration: none;">
                    <div class="service_vertical_box">
                        <div class="service-icon">
                            <!-- <i class="fab fa-whatsapp fa-4x"></i> --> 
                            <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/wa.png" alt="" style="width: 100%;">
                        </div>
                        <h3>WhatsApp</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                        <!-- <a href="#" class="readmore">Read More...</a> -->
                    </div><!-- end service_vertical_box -->
                    </a>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-3 last">
                    <a href="#" style="text-decoration: none;">
                    <div class="service_vertical_box">
                        <div class="service-icon">
                            <!-- <i class="fa fa-envelope fa-4x"></i> --> 
                            <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/apk.png" alt="" style="width: 100%;">
                        </div>
                        <h3>Android Apps</h3>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                        <!-- <a href="#" class="readmore">Read More...</a> -->
                    </div><!-- end service_vertical_box -->
                    </a>
                </div><!-- end col-lg-4 -->
            </div><!-- end services_vertical -->
            <div class="clearfix"></div>
        </div><!-- end container -->
    </div><!-- end transparent-bg --> 


    <section id="one-parallax" class="parallax" style="background-image: url('<?= base_url('assets_frontend/assets/')?>custom/images/slider/slider1.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
		<div class="overlay">
        	<div class="container">
                <div class="general-title">
                    <h2 style="margin-top: 0;">Layanan</h2>
                    <hr>
                    <p class="lead">Berikut ini adalah layanan yang kami sediakan di laman web ini</p>
                </div><!-- end general title -->

                <div class="custom-services">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 first"> 
                        <div class="ch-item cursor-pointer" onclick="go_to('<?= base_url('cuaca')?>')">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                        <!-- <i class="fa fa-cloud fa-4x"></i> -->
                                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/cuaca.png" alt="" style="height: 50%;">
                                        <h3>INFO CUACA</h3>
                                    </div>
									<div class="ch-info-back">
                                        <h3>INFO CUACA</h3>
                                        <p>Lorem ipsum dolor sit ameconsectetur adipisicing elit.</p>
                                        <span class="icon-more">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item --> 
                    </div><!-- end col-sm-3 -->

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="ch-item cursor-pointer" onclick="go_to('<?= base_url('gempa')?>')">    
                            <div class="ch-info-wrap">
                                <div class="ch-info">
                                    <div class="ch-info-front">
                                        <!-- <i class="fa fa-download fa-4x"></i> -->
                                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/gempa.png" alt="" style="height: 50%;">
                                        <h3>INFO GEMPA</h3>
                                    </div>
                                    <div class="ch-info-back">
                                        <h3>INFO GEMPA</h3>
                                        <p>Lorem ipsum dolor sit ameconsectetur adipisicing elit.</p>
                                        <span class="icon-more">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </div>
                                </div><!-- end ch-info -->
                            </div><!-- end ch-info-wrap -->
                        </div><!-- end ch-item -->
                    </div><!-- end col-sm-3 -->

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="ch-item cursor-pointer" onclick="go_to('<?= base_url('frontend/lapor')?>')">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                        <!-- <i class="fa fa-newspaper fa-4x"></i> -->
                                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/berita.png" alt="" style="height: 50%;">
                                        <h3>LAPOR</h3>
                                    </div>
									<div class="ch-info-back">
                                        <h3>LAPOR</h3>
                                        <p>Lorem ipsum dolor sit ameconsectetur adipisicing elit.</p>
                                        <span class="icon-more">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div><!-- end col-sm-3 -->
                    
                    
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 last">
						<div class="ch-item cursor-pointer" onclick="go_to('<?= base_url('daftar_laporan')?>')">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                        <!-- <i class="fa fa-photo-video fa-4x"></i> -->
                                        <img src="<?= base_url('assets_frontend/assets/')?>custom/images/icon/daftar-lapor.png" alt="" style="height: 50%;">
                                        <h3>DAFTAR LAPORAN</h3>
                                    </div>
									<div class="ch-info-back">
                                        <h3>DAFTAR LAPORAN</h3>
                                        <p>Lorem ipsum dolor sit ameconsectetur adipisicing elit.</p>
                                        <span class="icon-more">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div><!-- end col-sm-3 -->
                </div><!-- end row -->

            </div><!-- end container -->
    	</div><!-- end overlay -->
	</section>


    <section class="blog-wrapper">
    	<div class="container">
        	<div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding-bottom:0">
            <div class="title">
                <h2>Berita Terbaru</h2>
            </div><!-- end title -->                
            	<div class="widget">
                    <div class="row reviews_widget">
                        <div class="col-sm-6">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('assets_frontend/assets/')?>demos/lifestyle_06.jpg" alt="" class="img-responsive">
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                                        </div><!-- end buttons -->
                                    </div><!-- end magnifier -->
                                    <div class="post-type">
                                        <i class="fa fa-picture-o"></i>
                                    </div><!-- end pull-right -->
                                </div><!-- end entry -->
                                <div class="blog-carousel-header">
                                    <h3><a title="" href="blog-single-sidebar.html">New Graphic Designer on the block</a></h3>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                    </div><!-- end blog-carousel-meta -->
                                </div><!-- end blog-carousel-header -->
                                <div class="blog-carousel-desc">
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra. Aenean vel faucibus nunc, et venenatis magna. In hac habitasse platea dictumst. </p>
                                </div><!-- end blog-carousel-desc -->
                            </div><!-- end blog-carousel -->
                        </div><!-- end col-sm-6 -->
                    	<div class="col-sm-6">
                        	<div class="widget">
                                <ul class="recent_posts_widget">
                                    <li>
                                    <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/tabbed_widget_01.jpg" alt="">Android Toy Restyled...</a>
                                    <p>Aenean vel faucibus nunc, et venenatis magna... </p>
                                    <div class="meta_widget">
                                    	<div class="pull-left">
                                            <a class="readmore" href="#">Feburay 16, 2013</a>
                                        </div>
                                    	<div class="pull-right">
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div><!-- rating -->
                                        </div>
                                    	</div><!-- end meta_widget -->
                                    </li>
                                    <li>
                                    <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/tabbed_widget_02.jpg" alt="">Android Toy Restyled...</a>
                                    <p>Aenean vel faucibus nunc, et venenatis magna... </p>
                                    <div class="meta_widget">
                                    	<div class="pull-left">
                                            <a class="readmore" href="#">Feburay 16, 2013</a>
                                        </div>
                                    	<div class="pull-right">
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div><!-- rating -->
                                        </div>
                                    	</div><!-- end meta_widget -->
                                    </li>
                                    <li>
                                    <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/tabbed_widget_03.jpg" alt="">Android Toy Restyled...</a>
                                    <p>Aenean vel faucibus nunc, et venenatis magna... </p>
                                    <div class="meta_widget">
                                    	<div class="pull-left">
                                            <a class="readmore" href="#">Feburay 16, 2013</a>
                                        </div>
                                    	<div class="pull-right">
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div><!-- rating -->
                                        </div>
                                    	</div><!-- end meta_widget -->
                                    </li>
                                </ul><!-- recent posts -->  
                            </div><!-- end widget -->
                    	</div><!-- end col-sm-6 -->
                    </div><!-- end row -->
                    
                    
                </div><!-- end widget -->
                <div class="clearfix"></div>

                <div class="buttons text-center">
                    <a style="width: 100%;" href="berita.html" class="btn btn-primary btn-lg" title="">Selengkapnya</a>
                </div>
                <div class="clearfix"></div>
                
                <div class="title">
                    <h2>Pengumuman</h2>
                </div><!-- end title -->
            	<div class="widget">
                        <div id="owl_blog_two_line" class="owl-carousel">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('assets_frontend/assets/')?>demos/blog_01.png" alt="" class="img-responsive">
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="post-type">
                                        <i class="fa fa-images"></i>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <h4><a title="" href="blog-single-sidebar.html">New Graphic Designer on the block</a></h4>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                    </div>
                                </div>
                                <div class="blog-carousel-desc">
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean vel faucibus nunc, et venenatis magna. In hac habitasse platea dictumst. </p>
                                </div>
                            </div>
    
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('assets_frontend/assets/')?>demos/blog_02.png" alt="" class="img-responsive">
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="post-type">
                                        <i class="fa fa-images"></i>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <h4><a title="" href="blog-single-sidebar.html">New Graphic Designer on the block</a></h4>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                    </div>
                                </div>
                                <div class="blog-carousel-desc">
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean vel faucibus nunc, et venenatis magna. In hac habitasse platea dictumst. </p>
                                </div>
                            </div>
    
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('assets_frontend/assets/')?>demos/blog_03.png" alt="" class="img-responsive">
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="post-type">
                                        <i class="fa fa-images"></i>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <h4><a title="" href="blog-single-sidebar.html">New Graphic Designer on the block</a></h4>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                    </div>
                                </div>
                                <div class="blog-carousel-desc">
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean vel faucibus nunc, et venenatis magna. In hac habitasse platea dictumst. </p>
                                </div>
                            </div>
    
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('assets_frontend/assets/')?>demos/blog_01.png" alt="" class="img-responsive">
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="blog-single-sidebar.html"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="post-type">
                                        <i class="fa fa-images"></i>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <h4><a title="" href="blog-single-sidebar.html">New Graphic Designer on the block</a></h4>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> April 01, 2014</span>
                                        <span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                    </div>
                                </div>
                                <div class="blog-carousel-desc">
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean vel faucibus nunc, et venenatis magna. In hac habitasse platea dictumst. </p>
                                </div>
                            </div>
                        </div>
                </div><!-- end carousel_wrapper -->

                <div class="clearfix"></div>

                <div class="buttons text-center">
                    <a style="width: 100%;" href="berita.html" class="btn btn-primary btn-lg" title="">Selengkapnya</a>
                </div>
                
            </div><!-- end content -->
            
        	<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="title">
                <h2>Berita Populer</h2>
            </div><!-- end title -->
            	<div class="widget">
					<ul class="recent_posts_widget">
                        <li>
                        <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/sidebar_hot_01.jpg" alt="">Android Toy Restyled Again Latest Phone.</a>
                        <a class="readmore" href="#">Feburay 16, 2013</a>
                           <div class="rating">
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star-o"></i>
                            </div><!-- rating -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/sidebar_hot_02.jpg" alt="">Nulla vitae libero, a pharetra. </a>
                            <a class="readmore" href="#">Feburay 16, 2013</a>
                           <div class="rating">
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            </div><!-- rating -->
                        </li>
                        <li>
                        <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/sidebar_hot_03.jpg" alt="">This is another review post.</a>
                        <a class="readmore" href="#">Feburay 16, 2013</a>
                           <div class="rating">
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star-o"></i>
                            </div><!-- rating -->
                        </li>
                        <li>
                            <a href="#"><img src="<?= base_url('assets_frontend/assets/')?>demos/sidebar_hot_04.jpg" alt="">Did you see our new fruit?</a>
                            <a class="readmore" href="#">Feburay 16, 2013</a>
                           <div class="rating">
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            	<i class="fa fa-star"></i>
                            </div><!-- rating -->
                        </li>
                    </ul><!-- recent posts -->  
                </div><!-- end widget -->
            <div class="clearfix"></div>
            <div class="buttons text-right">
                <a style="width: 150px;" href="<?php echo base_url('berita'); ?>" class="btn btn-primary btn-md" title="">Selengkapnya</a>
            </div>
            <div class="title">
                <h2>Unduhan</h2>
            </div><!-- end title -->
            	<div class="widget">
                    <div class="social_widget"> 
                    	<div class="social_like" style="margin-bottom: 10px;">
                        	<div class="icon-container pull-left">
                                <i class="fa fa-file"></i>
                            </div>
                        	<div class="social_count">
								<h3><a href="#">Berkas 1</a></h3>
                                <small>Diunduh sebanyak 37x</small>
                                <div class="social_button">
                                    <a href="#" class="btn btn-primary">Unduh</a>
                                </div>
                            </div>
                        </div>  
                    	<div class="social_like" style="margin-bottom: 10px;">
                        	<div class="icon-container pull-left">
                                <i class="fa fa-file"></i>
                            </div>
                        	<div class="social_count">
								<h3><a href="#">Berkas 5</a></h3>
                                <small>Diunduh sebanyak 87x</small>
                                <div class="social_button">
                                    <a href="#" class="btn btn-primary">Unduh</a>
                                </div>
                            </div>
                        </div> 

                    </div><!-- end social-widget -->                    
                </div><!-- end widget -->
                <div class="clearfix"></div> 
                <div class="buttons text-right">
                    <a style="width: 150px;" href="#" class="btn btn-primary" title="">Selengkapnya</a>
                </div>
            </div><!-- end content -->
    	</div><!-- end container -->
    </section>

 

     <section class="white-wrapper" style="padding-top: 10px;">
        <div class="container">
            <div class="general-title">
                <h2>Peta Persebaran Titik Bencana</h2>
                <hr>
            </div><!-- end general title -->
        </div><!-- end container -->
        <div id="map" style="margin-top: 20px;"></div>
        <div class="clearfix"></div>  
    </section>
        