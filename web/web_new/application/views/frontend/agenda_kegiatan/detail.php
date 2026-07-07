<html class="no-js" lang="en">
    
    <body data-mobile-nav-style="classic">
        
        <!-- start page title -->
        <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
            <div class="overlay-hero"></div>
            <div class="container">
                <div class="row justify-content-center align-items-center small-screen">
                    <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                        <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                        <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                            <!-- start breadcrumb -->
                            <ul class="xs-text-center">
                                <li>Dashboard</li>
                                <li><a href="#" class="text-white-hover">Profil</a></li>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                        <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Agenda Kegiatan</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->    
    
    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2><?php echo $judul_halaman; ?></h2>
                <ul class="breadcrumb pull-right mobile_none">
                    <li><a href="<?php echo base_url($halaman);?>"><?php echo $judul_halaman; ?></a></li>
                    <li>Detail</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="blog-wrapper">
        <div class="container">
            <div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="blog-masonry">
                        <div class="col-lg-12">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <img src="<?= base_url('./uploads/menu/'.$row->image)?>" alt="" class="img-responsive" draggable="false">
                                </div>
                                <div class="blog-carousel-header">
                                    <h1><?= @$row->judul?></h1>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> <?= validateDate($row->tanggal)?tgl_indo($row->tanggal):'-'?></span> 
                                    </div>
                                </div>
                                <div class="blog-carousel-desc"><?= @$row->konten?></div>
                            </div>
                        </div>
                    </div><!-- end blog-masonry -->

                    <div class="clearfix"></div>
                    
                </div><!-- end row -->
            </div><!-- end content -->

            <div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="widget" hidden>
                    <form action="#" class="search_form">
                        <input type="text" class="form-control" placeholder="Search">
                    </form><!-- end search form -->
                </div> 
                <div class="widget">
                    <div class="title">
                        <h2><?php echo $judul_halaman; ?> Lainnya</h2>
                    </div><!-- end title -->
                    <ul class="recent_posts_widget">
                    <?php  
                    foreach ($list_lainnya as $key => $value) {
                        $url_detail_lainnya = base_url(''.$halaman.'/detail/'.$value->tanggal.'/'.$value->id);
                        $tanggal_lainnya    = validateDate($value->tanggal) ? tgl_indo($value->tanggal) : '-';
                        echo '
                        <li>
                            <a href="'.$url_detail_lainnya.'"> '.$value->judul.' </a>
                            <a class="readmore" href="'.$url_detail_lainnya.'"> '.$tanggal_lainnya.' </a> 
                        </li>';
                    }
                    ?> 
                         
                    </ul><!-- recent posts -->
                </div><!-- end widget -->
            </div><!-- end left-sidebar -->

        </div><!-- end container -->
    </section>
