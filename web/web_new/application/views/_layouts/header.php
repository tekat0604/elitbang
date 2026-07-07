<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <!-- Website description -->
    <meta name='description' content='Penyelenggara Pemerintahan Daerah di Bidang Penanggulangan Bencana'/>
    <!-- Author Name -->
    <meta name='author' content='phicosdev'/>
    <!-- SEO keyword -->
    <meta name='keywords' content='bpbd, surakarta, bpbd-surakarta'>
    <!-- Robots Meta Tag -->
    <meta name='robots' content='index, follow'>
    <!-- favicon icon -->
    <link rel="shortcut icon" href="<?= base_url('assets_frontend/new_assets/') ?>images/favicon.png">
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/new_assets/') ?>css/font-icons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/new_assets/') ?>css/theme-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/new_assets/') ?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/new_assets/') ?>css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/new_assets/') ?>css/custom.css">
    <title>BPBD Kota Surakarta</title>
</head>

<body data-mobile-nav-style="classic">
    <header>
        <nav class="navbar navbar-expand-lg navbar-boxed navbar-dark bg-transparent header-light fixed-top header-reverse-scroll">
            <div class="container-fluid nav-header-container">
                <div class="col-auto col-sm-6 col-lg-2 me-auto ps-lg-0">
                    <a class="navbar-brand" href="<?php base_url('frontend/')?>">
                        <img class="default-logo" src="<?= base_url('assets_frontend/new_assets/') ?>images/bpbd-putih.png" alt="logo-img">
                        <img class="alt-logo" src="<?= base_url('assets_frontend/new_assets/') ?>images/bpbd-dark.png" alt="logo-img">
                        <img src="<?= base_url('assets_frontend/new_assets/') ?>images/bpbd-dark.png" data-at2x="assets/images/bpbd-dark.png" class="mobile-logo logo-navbarna" alt="">
                    </a>
                </div>
                <div class="col-auto col-lg-8 menu-order px-lg-0">
                    <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav alt-font">
                            <li class="nav-item dropdown megamenu">
                                <a href="<?= base_url('frontend') ?>" class="nav-link">Beranda</a>
                            </li>
                            <li class="nav-item dropdown simple-dropdown">
                                <a href="<?= base_url('frontend/profil') ?>" class="nav-link">Profil</a>
                                <i class="feather icon-feather-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-hidden="true"></i>
                                <!-- <ul class="dropdown-menu" role="menu"> -->
                                    <!-- <li class="dropdown"><a href="<?= base_url('frontend/profil') ?>">Sejarah</a></li> -->
                                    <!-- <li class="dropdown"><a href="<?= base_url('frontend/profil') ?>" >Visi & Misi</a></li> -->
                                    <!-- <li class="dropdown"><a href="<?= base_url('frontend/profil') ?>">Tugas dan Fungsi</a></li> -->
                                    <!-- <li class="dropdown"><a href="<?= base_url('frontend/profil') ?>">Struktur Organisasi</a></li> -->
                                    <!-- <li class="dropdown"><a href="<?= base_url('frontend/profil') ?>">Komposisi Pegawai</a></li> -->
                                <!-- </ul> -->
                            </li>
                            <!-- <li class="nav-item dropdown simple-dropdown">
                                <a href="#" class="nav-link">Unit Kerja</a>
                                <i class="feather icon-feather-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-hidden="true"></i>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown">
                                        <a data-bs-toggle="dropdown" href="javascript:void(0);">Unsur Pengarah<i class="feather icon-feather-chevron-right dropdown-toggle"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="unitkerja.html">Instansi Profesional Ahli</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a data-bs-toggle="dropdown" href="javascript:void(0);">Unsur Pelaksana<i class="feather icon-feather-chevron-right dropdown-toggle"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= base_url('frontend/unit_kerja') ?>">Kepala BPBD</a></li>
                                            <li><a href="<?= base_url('frontend/unit_kerja') ?>">Kepala Pelaksana</a></li>
                                            <li><a href="unitkerja.html">Sekretariat</a></li>
                                            <li><a href="unitkerja.html">Bidang Pencegahan dan Kesiapsiagaan</a></li>
                                            <li><a href="unitkerja.html">Bidang Kedaruratan dan Logistik</a></li>
                                            <li><a href="unitkerja.html">Bidang Rehabilitasi dan Rekonstruksi</a></li>
                                        </ul>
                                    </li>
                                </ul> -->
                            <!-- </li> -->
                            <!-- <li class="nav-item dropdown simple-dropdown">
                                <a href="#" class="nav-link">Informasi Publik</a>
                                <i class="feather icon-feather-chevron-down dropdown-toggle" data-bs-toggle="dropdown" aria-hidden="true"></i>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown">
                                        <a data-bs-toggle="dropdown" href="javascript:void(0);">SAKIP BPBD<i class="feather icon-feather-chevron-right dropdown-toggle"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Perjanjian Kinerja BPBD</a></li>
                                            <li><a href="#">LKJ IP BPBD</a></li>
                                            <li><a href="#">RENSTRA BPBD</a></li>
                                            <li><a href="#">IKU BPBD</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->
                            
                            <li class="nav-item dropdown simple-dropdown"  <?= @$li_berita ?>>
                                <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link">Berita</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown <?= @$li_berita ?>"><a href="<?= base_url('berita') ?>">Semua Berita</a></li>
                                    <?php foreach (get_kategori_berita() as $row) { ?>
                                        <li><a href="<?= base_url('berita?id=' . $row->id . '&kategori=' . $row->kategori) ?>"><?= $row->kategori ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            
                            <li class="nav-item dropdown simple-dropdown"  <?= @$li_unduhan ?>>
                                <a href="<?= base_url('frontend/unduhan') ?>" class="nav-link">Unduhan</a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= base_url('frontend/galeri') ?>" class="nav-link">Galeri</a>
                            </li>

                            <li class="nav-item dropdown simple-dropdown"  <?= @$li_ppid ?>>
                                <a href="javascript:void(0)" data-toggle="dropdown" class="nav-link">PPID</a>
                                    <ul class="dropdown-menu" role="menu">
                                            <?php foreach (get_page_ppid() as $row) { ?>
                                        <li><a href="<?= base_url('ppid/page/' . $row->id . '') ?>"><?= $row->judul ?></a></li>
                                        <?php } ?>

                                        <?php foreach (get_kategori_ppid() as $row) { ?>
                                        <li><a href="<?= base_url('ppid/kategori/' . $row->id . '') ?>"><?= $row->nama_kategori ?></a></li>
                                        <?php } ?>

                                    </ul>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('peta') ?>" class="nav-link">Peta</a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('login_v2') ?>" class="nav-link">Login</a>
                            </li>

                            <!-- <div class="topmenu">
                                <span class="topbar-login"><i class="fa fa-user"></i> <a href="<?= base_url('login_v2') ?>">Login</a></span>
                            </div>end top menu -->

                        </ul>
                    </div>
                </div>

                <?php $get_profil_website = get_profil_website(); ?>
                <div class="col-auto col-lg-2 text-end pe-0 font-size-0">
                    <div class="header-social-icon d-inline-block">
                        <a href="<?= $get_profil_website->facebook ?>" target="_blank"><i class="feather icon-feather-facebook"></i></a>
                        <a href="https://www.instagram.com/bpbdkotasolo/" target="_blank"><i class="feather icon-feather-instagram"></i></a>
                        <a href="<?= $get_profil_website->twitter ?>" target="_blank"><i class="feather icon-feather-twitter"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- end header -->