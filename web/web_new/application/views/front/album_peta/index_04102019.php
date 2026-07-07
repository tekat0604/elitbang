<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>INTIP KOTA SURAKARTA</title>
    <link rel="shortcut icon" href="<?=base_url()?>assets/front/img/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/front/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/css/shortcodes/shortcodesae52.css?v=5" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/styleae52.css?v=5" rel="stylesheet">
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body id="top" class="has-header-search">
    <header id="header" class="tt-nav nav-border-bottom">
        <div class="header-sticky light-header ">
            <div class="container">
                <!-- <div class="search-wrapper">
                    <div class="search-trigger pull-right">
                        <div class='search-btn'></div>
                        <i class="material-icons">&#xE8B6;</i>
                    </div>
                    <i class="search-close material-icons">&#xE5CD;</i>
                    <div class="search-form-wrapper">
                        <form action="#" class="white-form">
                            <div class="input-field">
                                <input type="text" name="search" id="search">
                                <label for="search" class="">Search Here...</label>
                            </div>
                            <button class="btn blue-grey darken-4 search-button waves-effect waves-light" type="submit"><i class="material-icons">&#xE8B6;</i></button>
                        </form>
                    </div>
                </div> -->
                <?php include_once(APPPATH.'views/front/layout/menu.php')?>
            </div>
        </div>
    </header>
    <section class="page-title ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Album Peta</h2>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="#">Data</a></li>
                        <li class="active">Album Peta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="section-title">Album Peta INTIP Kota Surakarta</h2>
                <!-- <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet vived at vestibulum purus erra,</p> -->
            </div>
            <div class="portfolio-container">
                <ul class="portfolio-filter brand-filter text-center">
                    <li class="active waves-effect waves-light" data-group="all">All</li>
                    <li class="waves-effect waves-light" data-group="rencana">Rencana</li>
                    <li class="waves-effect waves-light" data-group="eksisting">Eksisting</li>
                    <li class="waves-effect waves-light" data-group="fisik_dasar">Fisik Dasar</li>
                    <li class="waves-effect waves-light" data-group="kawasan">Kawasan</li>
                    <!-- <li class="waves-effect waves-light" data-group="rencana">Rencana</li>
                    <li class="waves-effect waves-light" data-group="administrasi">Administrasi</li>
                    <li class="waves-effect waves-light" data-group="struktur">Struktur Ruang</li>
                    <li class="waves-effect waves-light" data-group="kawasan">Kawasan</li> -->
                </ul>
                <div class="portfolio portfolio-with-title col-2 gutter mtb-50">
                    <div class="portfolio-item" data-groups='["all","rencana"]'>
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url()?>assets/front/img/peta-rencana.jpg" alt="image">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator">Peta Rencana <i class="fa fa-ellipsis-v right"></i></span>
                                <p>Peta Rencana Pola Ruang Kota Surakarta</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title">Peta Rencana <i class="material-icons right">&#xE5CD;</i></span>
                                <p>Peta Rencana Pola Ruang Kota Surakarta</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <a class="waves-effect waves-light btn pink white-text">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-item" data-groups='["all","administrasi"]'>
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url()?>assets/front/img/peta-administrasi.jpg" alt="image">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator">Peta Administrasi <i class="fa fa-ellipsis-v right"></i></span>
                                <p>Peta Administrasi Wilayah Kota Surakarta</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title">Peta Administrasi <i class="material-icons right">&#xE5CD;</i></span>
                                <p>Peta Administrasi Wilayah Kota Surakarta</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <a class="waves-effect waves-light btn pink white-text">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-item" data-groups='["all","struktur"]'>
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url()?>assets/front/img/peta-struktur.jpg" alt="image">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator">Peta Struktur Ruang <i class="fa fa-ellipsis-v right"></i></span>
                                <p>Peta Struktur Ruang Wilayah Kota Surakarta</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title">Peta Struktur Ruang <i class="material-icons right">&#xE5CD;</i></span>
                                <p>Peta Struktur Ruang Wilayah Kota Surakarta</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <a class="waves-effect waves-light btn pink white-text">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-item" data-groups='["all","kawasan"]'>
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url()?>assets/front/img/peta-struktur.jpg" alt="image">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator">Peta Rencana Kawasan <i class="fa fa-ellipsis-v right"></i></span>
                                <p>Peta Rencana Kawasan Wilayah Kota Surakarta</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title">Peta Rencana Kawasan <i class="material-icons right">&#xE5CD;</i></span>
                                <p>Peta Rencana Kawasan Wilayah Kota Surakarta</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <a class="waves-effect waves-light btn pink white-text">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="load-more-button text-center">
                    <a class="waves-effect waves-light btn btn-large pink"> <i class="fa fa-spinner left"></i> Load More</a>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer footer-four">
        <div class="primary-footer blue-grey darken-2 text-center">
            <div class="container">
                <a href="#top" class="page-scroll btn-floating btn-large back-top waves-effect waves-light red accent-4" data-section="#top">
                <i class="material-icons">&#xE316;</i>
                </a>
                <!-- <ul class="social-link tt-animate ltr mt-20">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                </ul> -->
                <hr class="mt-15">
                <div class="row">
                    <div class="col-md-7">
                        <div class="footer-logo">
                            <img style="max-height: 80px;" src="<?=base_url()?>assets/front/img/logo-intip3.png" alt="">
                        </div>
                        <div class="footer-intro">
                            <p>“Mewujudkan Perencanaan Pembangunan Daerah yang Visioner, Partisipasif, Terpadu, Responsif, dan Berkelanjutan”</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <ul style="color: white; padding-top: 70px;">
                            <li>Jl. Jend. Sudirman No.2, Kedung Lumbu, Ps. Kliwon, Kota Surakarta, Jawa Tengah 57133</li>
                            <li> (0271) 642020 psw. 405; Fax. (0271) 655277</li>
                            <li> ipwbapppedaska@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="secondary-footer red accent-4 text-center">
            <div class="container">
                <span class="copy-text white-text ">Copyright &copy; INTIP Kota Surakarta 2018 &nbsp; | &nbsp; All Rights Reserved &nbsp;</span>
            </div>
        </div>
    </footer>
    <div id="preloader">
        <div class="preloader-position">
            <img src="<?=base_url()?>assets/front/img/logo-bappeda-dark.png" alt="logo">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="<?=base_url()?>assets/front/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/front/materialize/js/materialize.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/menuzord.js"></script>
    <script src="<?=base_url()?>assets/front/js/bootstrap-tabcollapse.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/imagesloaded.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.sticky.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/smoothscroll.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.stellar.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.shuffle.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/imagesloaded.js"></script>
    <script src="<?=base_url()?>assets/front/flexSlider/jquery.flexslider-min.js"></script>
    <script src="<?=base_url()?>assets/front/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/scriptsae52.js?v=5"></script>
    <?php include_once('index_js.php');?>
</body>

</html>