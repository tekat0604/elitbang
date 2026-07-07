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
                    <h4 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Detail Berita</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <br>

    <section class="bg-light-gray half-section pt-0 post-wrapper-top jt-shadow">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col margin-30px-bottom xs-margin-15px-bottom wow animate__fadeIn" data-wow-delay="0.4s">
                    <div class="feature-box bg-white box-shadow-small box-shadow-large-hover border-radius-6px padding-2-half-rem-all lg-padding-3-rem-all">
                        <div class="feature-box-content last-paragraph-no-margin">
                            <ul class="nav nav-tabs nav-stacked">
                                <div class="entry">
                                    <?php $img = is_file('./uploads/menu/' . $row->image) ? base_url('uploads/menu/' . $row->image) : './assets/img/image_not_found.png'; ?>
                                    <img src="<?= $img ?>" alt="" class="img-responsive" draggable="false">
                                </div>
                                <div class="blog-carousel-header">
                                    <br>
                                    <h5><?= @$row->judul ?></h5>
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
        
                <div class="col margin-30px-bottom xs-margin-15px-bottom wow animate__fadeIn" data-wow-delay="0.4s">
                    <div class="feature-box bg-white box-shadow-small box-shadow-large-hover border-radius-6px padding-2-half-rem-all lg-padding-3-rem-all">
                        <div class="feature-box-content last-paragraph-no-margin">
                            <a href="<?= base_url('/lapor') ?>" class="alt-font font-weight-500 text-large margin-15px-bottom d-block text-extra-dark-gray sm-margin-10px-bottom">Kategori</a>
                            <ul class="nav nav-tabs nav-stacked">
                            <?php foreach (get_kategori_berita() as $r) { ?>
                            <li <?= $r->id == $row->id_kategori_menu ? 'class="active"' : '' ?>><a href="<?= base_url('berita?id=' . $r->id) ?>"><?= $r->kategori ?></a></li>
                        <?php } ?>
                        </p>
                            </ul>
                        </div>
                    </div>
                </div>

                <br>
                
                <div class="col margin-30px-bottom xs-margin-15px-bottom wow animate__fadeIn" data-wow-delay="0.4s">
                    <div class="feature-box bg-white box-shadow-small box-shadow-large-hover border-radius-6px padding-2-half-rem-all lg-padding-3-rem-all">
                        <div class="feature-box-content last-paragraph-no-margin">
                        <a href="<?= base_url('/lapor') ?>" class="alt-font font-weight-500 text-large margin-15px-bottom d-block text-extra-dark-gray sm-margin-10px-bottom">Berita Lainnya</a>
                        <ul class="nav nav-tabs nav-stacked">
                        <?php foreach ($berita as $x) {
                            $img = is_file('./uploads/menu/' . $x->image) ? base_url('uploads/menu/' . $x->image) : './assets/img/image_not_found.png';
                        ?>
                            <li>
                                <a href="<?= base_url('berita/detail/' . $x->tanggal . '/' . $x->id) ?>">
                                    <img src="<?= $img ?>" alt="" width="80px" height="80px">
                                    <?= $x->judul ?>
                                </a>
                                <!-- <br> -->
                                <a class="readmore" href="<?= base_url('berita/detail/' . $x->tanggal . '/' . $x->id) ?>">
                                    <?= validateDate($x->tanggal) ? tgl_indo($x->tanggal) : '-' ?>
                                </a>
                            </li>
                            <hr>
                        <?php } ?>
                        </p>
                            </ul>
                        </div>
                    </div>
                </div>


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




