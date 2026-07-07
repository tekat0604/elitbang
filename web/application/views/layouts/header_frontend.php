
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Sistem Informasi Ekonomi Kota Surakarta"/>
    <meta property="og:title" content="Sistem Informasi Ekonomi Kota Surakarta"/>
    <meta property="og:description" content="Sistem Informasi Ekonomi Kota Surakarta"/>
    <meta property="og:image" content="https://app.demoo.id/front_eko_ska/assets/images/favicon.png"/>
    <meta name="format-detection" content="telephone=no">
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="<?= base_url() ?>assets_frontend/assets/images/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets_frontend/assets/images/favicon.png" />
    
    <!-- PAGE TITLE HERE -->
    <title><?= get_website()->nama_sistem ?></title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--[if lt IE 9]>
    <script src="<?= base_url() ?>assets_frontend/assets/js/html5shiv.min.js"></script>
    <script src="<?= base_url() ?>assets_frontend/assets/js/respond.min.js"></script>
    <![endif]-->
    
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/plugins.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/templete.css">
    
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/style.css">
    <link class="skin" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/css/skin/skin-4.css">
    
    <!-- Highcharts -->
    <script src="<?= base_url() ?>assets_frontend/assets/js/highcharts/highcharts.js"></script>
    <script src="<?= base_url() ?>assets_frontend/assets/js/highcharts/modules/exporting.js"></script>
    <script src="<?= base_url() ?>assets_frontend/assets/js/highcharts/modules/export-data.js"></script>
    
    <!-- REVOLUTION SLIDER CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_frontend/assets/plugins/revolution/revolution/css/revolution.min.css">
    

    <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Work+Sans:100,200,300,400,500,600,700,800,900');</style>
</head>
<body id="bg">
<div class="page-wraper">
    <div class="cube-transition" id="loading-area1"><div></div><div></div></div>
    <!-- header -->
    <header class="site-header header header-transparent mo-left">
        <!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion">
                        <a href="index.html"><img src="<?= base_url().'assets_frontend/assets/images/'.get_website()->logo_header ?>" alt=""></a>
                    </div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <a href="<?= base_url('login') ?>" class="btn radius-xl" style="text-transform: uppercase;">Login</a>
                            <button id="quik-search-btn" type="button" class="btn-link btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <!-- Quik search -->
                    <div class="dlab-quik-search">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Masukkan kata kunci">
                            <span id="quik-search-remove"><i class="ti-close"></i></span>
                        </form>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                        <div class="logo-header mostion">
                            <a href="index.html"><img src="<?= base_url().'assets_frontend/assets/images/'.get_website()->logo_footer ?>" alt=""></a>
                        </div>
                        <ul class="nav navbar-nav"> 
                            <li class="<?php if($this->uri->segment(2) == '') { echo "active"; } ?>"><a href="<?= base_url('front') ?>">Home</a> </li>
                            <li class="<?php if($this->uri->segment(2) == 'berita') { echo "active"; } ?>"><a href="<?= base_url('front/berita') ?>">Berita</a> </li>
                            <li class="<?php if($this->uri->segment(2) == 'data') { echo "active"; } ?>"><a href="<?= base_url('front/data') ?>">Data Marko Ekonomi</a></li>
                            <li><a href="<?= base_url('peta') ?>">Peta</a></li>
                            <li><a href="javascript:void(0);">Unduhan <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li class="<?php if($this->uri->segment(2) == 'kajian') { echo "active"; } ?>"><a href="<?= base_url('front/kajian') ?>">Kajian</a></li>
                                    <li class="<?php if($this->uri->segment(2) == 'unduhan') { echo "active"; } ?>"><a href="<?= base_url('front/unduhan') ?>">Data Regulasi</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($this->uri->segment(2) == 'kontak') { echo "active"; } ?>"><a href="<?= base_url('front/kontak') ?>">Kontak</a></li>                       </ul>   
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->