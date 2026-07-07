<html class="no-js" lang="en">

<body data-mobile-nav-style="classic">
    
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>/images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
        <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                    <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                        <!-- start breadcrumb -->
                        <ul class="xs-text-center">
                            <li>Dashboard</li>
                            <li><a href="href="<?= base_url('berita') ?>"" class="text-white-hover">Berita</a></li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h4 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Detail Berita Kebencanaan</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <br>

    <section class="bg-light-gray half-section pt-0 post-wrapper-top jt-shadow">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="blog-list blog-side-image">
                    <div class="blog-carousel">
                                <div class="entry">
                                    <?php $img = is_file('./uploads/menu/' . $row->image) ? base_url('uploads/menu/' . $row->image) : './assets/img/image_not_found.png'; ?>
                                    <img src="<?= $img ?>" alt="" class="img-responsive" draggable="false">
                                </div>
                                <div class="blog-carousel-header">
                                    <br>
                                    <h5><?php echo $judul_halaman; ?></h5>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> <?= validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-' ?></span>
                                        <!--<span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                        <span><i class="fa fa-user"></i> <a href="#">Admin</a></span>-->
                                    </div>
                                </div>
                                <div class="blog-carousel-desc"><?= @$row->konten ?></div>
                            </div>
                    </div>

                    <br><br>
                    <div class="next_prev text-center">
                        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left" ></i> Kembali</a>
                    </div>

                    
                    
                </div>
                <div class="col-12 col-sm-4 col-md-12 col-xl-4">
                <div class="widget">
                    <div class="title">
                    <h5><?php echo $judul_halaman; ?> Lainnya</h5>
                    </div>
                    <ul class="nav nav-tabs nav-stacked">
                    <?php  
                    foreach ($list_lainnya as $key => $value) {
                        $url_detail_agenda  = base_url(''.$halaman.'/detail/'.$value->tanggal.'/'.$value->id);
                        $tanggal_agenda     = validateDate($value->tanggal) ? tgl_indo($value->tanggal) : '-';
                        echo '
                        <li>
                            <b><a href="'.$url_detail_agenda.'"> '.$value->judul.' </a></b>
                            <a class="readmore" href="'.$url_detail_agenda.'"> ' . '&nbsp;' .'(' .$tanggal_agenda. ')' .' </a> 
                            <br>
                            </li>';
                    }
                    ?> 
                    </ul>
                </div>


                <br>
                </div>
            </div>
        </div>
    </section>    

                            
    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->
    <!-- javascript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/orgChart.min.js"></script>
    <script type="text/javascript" src="assets/js/struktur-org.js"></script>
</body>
</html>




