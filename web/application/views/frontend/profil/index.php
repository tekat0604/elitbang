<style type="text/css">
    .pagination li.paginate_button a:hover {
        color: #333 !important;
    }

    .blog-masonry .blog-carousel {
        margin: 0 10px;
        border-radius: 15px;
        background: #fff0e4;
        padding: 10px !important
    }

    @media (max-width: 767px) {

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info,
        div.dataTables_wrapper div.dataTables_paginate {
            text-align: left;
        }

        div.dataTables_wrapper div.dataTables_length select {
            margin-left: 30px;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 20px;
        }
    }

    .navbar-nav>li.active a {
        color: #00ff00;
    }
</style>

<section class="grey-wrapper" style="padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="widget margin-top">
                    <img src="<?= is_file('./uploads/menu/' . @$profil['image']) ? base_url('uploads/menu/' . @$profil['image']) : base_url('assets_frontend/assets/custom/images/bpbd-solo.png') ?>" class="img-responsive" alt="" draggable="false" style="width: 80%; margin: 0 10%;">
                </div><!-- end widget -->
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 style="text-transform: uppercase; color: #e98024; font-weight: 300;">Profil Kami</h2>

                    <?php if (@$profil['konten'] != null) { ?>

                        <div style="font-size: 16px;"> <?php echo $profil['konten']; ?> </div>
                    <?php } else { ?>
                        <p>BPBD dalam melaksanakan tugas dipimpin oleh seorang Kepala Badan secara ex-offico dijabat oleh Sekretaris Daerah yang berkedudukan di bawah dan bertanggung jawab kepala Walikota.</p>
                        <p>BPBD mempunyai tugas melaksanakan penyusunan dan pelaksanakan kebijakan daerah di bidang penanggulangan bencana.</p>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div><!-- end widget -->
            </div><!-- end col-lg-6 -->
        </div><!-- end row --><br>
    </div><!-- end container -->
</section>

<section class="white-wrapper jt-shadow">
    <div class="container">
        <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 0;">
            <div class="row">
                <div class="blog-masonry">
                    <div class="col-lg-12">
                        <div class="doc">
                            <h2 style="color: #e98024; font-weight: 300;">Tentang Kami</h2>
                            <div id="custom_tab" class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li style="padding:0" class="col-lg-2 col-xs-6">
                                        <a href="#tab1" data-toggle="tab" style="padding:5px; ">
                                            <i class="fa fa-briefcase" style="padding-right: 7px;"></i>Tugas & Fungsi
                                        </a>
                                    </li>
                                    <li style="padding:0" class="col-lg-2 col-xs-6 active">
                                        <a href="#tab2" data-toggle="tab" style="padding:5px; ">
                                            <i class="fa fa-chart-line" style="padding-right: 5px;"></i>Visi Misi dan Strategi
                                        </a>
                                    </li>
                                    <li style="padding:0" class="col-lg-2 col-xs-6">
                                        <a href="#tab3" data-toggle="tab" style="padding:5px; ">
                                            <i class="fa fa-users" style="padding-right: 7px;"></i>Struktur Organisasi
                                        </a>
                                    </li>
                                    <li style="padding:0" class="col-lg-2 col-xs-6">
                                        <a href="#tab4" data-toggle="tab" style="padding: 5px; ">
                                            <i class="fa fa-users" style="padding-right: 7px;"></i>Profil Pejabat
                                        </a>
                                    </li>
                                    <li style="padding:0" class="col-lg-2 col-xs-6">
                                        <a href="#tab5" data-toggle="tab" style="padding: 5px; ">
                                            <i class="fa fa-users" style="padding-right: 7px;"></i>Profil Pegawai
                                        </a>
                                    </li>
                                    <li style="padding:0" class="col-lg-2 col-xs-6">
                                        <a href="#tab6" data-toggle="tab" style="padding: 5px; ">
                                            <i class="fa fa-users" style=" padding-right: 7px;"></i>Agenda Pimpinan
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <?php if (@$tusi['konten'] != null) {
                                            echo $tusi['konten'];
                                        } else { ?>
                                            <p>
                                                Untuk melaksanakan tugas pokok BPBD mempunyai fungsi:
                                                <li> Penyusunan rencana program, pengendalian, evaluasi dan pelaporan</li>
                                                <li> Perumusan kebijakan teknis di bidang penyelenggaraan penanggulangan bencana daerah</li>
                                                <li> Pengkoordinasian dan pengkomamdoan pelaksanaan penyelenggaraan penanggulangan bencana daerah</li>
                                                <li> Pelaksanaan pembinaan, fasilitasi dan pelaksanaan tugas di bidang kesekretarian, pencegahan dan kesiapsiagaan, kedaduratan dan logistik serta rehabilitasi dan rekonstruksi</li>
                                                <li> Pelaksanaan pemantauan, evaluasi dan pelaporan di bidang penyelenggaraan penanggulangan bencana daerah</li>
                                                <li> Penyelenggaraan sosialisasi dan</li>
                                                <li> Pembinaan jabatan fungsional</li>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class="tab-pane active" id="tab2">
                                        <?php if (@$visi['konten'] != null) {
                                            echo $visi['konten'];
                                        } else { ?>
                                            <p>BPBD dalam melaksanakan tugas dipimpin oleh seorang Kepala Badan secara ex-offico dijabat oleh Sekretaris Daerah yang berkedudukan di bawah dan bertanggung jawab kepala Walikota.</p>
                                            <p>BPBD mempunyai tugas melaksanakan penyusunan dan pelaksanakan kebijakan daerah di bidang penanggulangan bencana.</p>
                                        <?php } ?>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <img style="width: 100%;  " src="<?= is_file('./uploads/menu/' . @$struktur['image']) ? base_url('uploads/menu/' . @$struktur['image']) : base_url('assets_frontend/assets/custom/images/struktur-org.png') ?>" alt="">
                                    </div>
                                    <div class="tab-pane" id="tab4">

                                        <?php
                                        if (count($profil_pejabat) > 0) {
                                            foreach ($profil_pejabat as $key => $value) {
                                                if ($value['image'] != '' && $value['image'] != null) {
                                                    $image        = '<img src="' . base_url('uploads/profil_anggota/medium/' . $value['image'] . '') . '" alt="" 
                                                    class="img-responsive" >';
                                                } else {
                                                    $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive" >';
                                                }
                                                if ($value['link'] != '' && $value['link'] != null) {
                                                    $link_pejabat = ' <a href="http://' . $value['link'] . '" target="_blank" class="btn btn-warning btn-md"> 
                                                    Lihat <i class="fa fa-arrow-right"></i> </a>';
                                                } else {
                                                    $link_pejabat = '';
                                                }
                                        ?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 first">
                                                        <div class="team_member">
                                                            <div class="entry"> <?php echo $image; ?> </div><!-- end entry -->
                                                        </div><!-- end team_member -->
                                                    </div><!-- end col-lg-3 -->
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="team_member">
                                                            <div class="widget">
                                                                <div style="margin:0 15px">
                                                                    <h1 style="margin:10px 0 0 0"><?php echo $value['nama'] ?> <span></h1>
                                                                </div>
                                                                <div id="skills" class="skills_bar" style="margin:0">
                                                                    <div class="col-lg-6">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">NIP</small>
                                                                            <div class="profil-desc"><?php echo $value['nip'] ?></div>
                                                                        </div>
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Nama</small>
                                                                            <div class="profil-desc"><?php echo $value['nama'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Tempat, Tanggal Lahir</small>
                                                                            <div class="profil-desc">
                                                                                <?php echo ' ' . $value['tempat_lahir'] . ', ' . $value['tanggal_lahir'] . ''; ?>
                                                                            </div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Pangkat (Golru) </small>
                                                                            <div class="profil-desc"><?php echo $value['pangkat_golru'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">TMT Pangkat</small>
                                                                            <div class="profil-desc"><?php echo $value['tmt_pangkat'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Jabatan</small>
                                                                            <div class="profil-desc"><?php echo $value['jabatan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">TMT Jabatan</small>
                                                                            <div class="profil-desc"><?php echo $value['tmt_jabatan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Formasi</small>
                                                                            <div class="profil-desc"><?php echo $value['formasi'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Unit Kerja </small>
                                                                            <div class="profil-desc">
                                                                                <?php echo $value['unit_kerja']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Pendidikan </small>
                                                                            <div class="profil-desc"><?php echo $value['pendidikan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Alamat </small>
                                                                            <div class="profil-desc"><?php echo $value['alamat'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">LHKPN</small>
                                                                            <div class="profil-desc"><?php echo $link_pejabat; ?></div>
                                                                        </div>

                                                                    </div>


                                                                </div><!-- end skills_bar -->
                                                            </div><!-- end widget -->


                                                        </div><!-- end team_member -->
                                                    </div><!-- end col-lg-8 -->
                                                    <div class="clearfix"></div>
                                                    <hr class="row" style="border-color:#ffb080;border-style:dashed">
                                                </div>
                                        <?php
                                            };
                                        } else {
                                            echo '
                                            <div class="row"> 
                                                <div class="col-md-12"> Data Kosong </div> 
                                            </div>';
                                        }
                                        ?>



                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <div class="general-title">
                                            <h2>Profil Pegawai</h2>
                                            <hr>
                                        </div><!-- end general title -->
                                        <?php
                                        if (count($profil_pegawai) > 0) {
                                            foreach ($profil_pegawai as $key => $value) {
                                                if ($value['image'] != '' && $value['image'] != null) {
                                                    $image        = '<img src="' . base_url('uploads/profil_anggota/medium/' . $value['image'] . '') . '" alt="" 
                                                    class="img-responsive" >';
                                                } else {
                                                    $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive" >';
                                                }
                                                if ($value['link'] != '' && $value['link'] != null) {
                                                    $link_pegawai = ' <a href="http://' . $value['link'] . '" target="_blank" class="btn btn-warning btn-md"> 
                                                    Lihat <i class="fa fa-arrow-right"></i> </a>';
                                                } else {
                                                    $link_pegawai = '';
                                                }
                                        ?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 first">
                                                        <div class="team_member">
                                                            <div class="entry"> <?php echo $image; ?> </div><!-- end entry -->
                                                        </div><!-- end team_member -->
                                                    </div><!-- end col-lg-3 -->
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="team_member">
                                                            <div class="widget">
                                                                <div style="margin:0 15px">
                                                                    <h1 style="margin:10px 0 0 0"><?php echo $value['nama'] ?> <span></h1>
                                                                </div>
                                                                <div id="skills" class="skills_bar" style="margin:0">
                                                                    <div class="col-lg-6">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">NIP</small>
                                                                            <div class="profil-desc"><?php echo $value['nip'] ?></div>
                                                                        </div>
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Nama</small>
                                                                            <div class="profil-desc"><?php echo $value['nama'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Tempat, Tanggal Lahir</small>
                                                                            <div class="profil-desc">
                                                                                <?php echo ' ' . $value['tempat_lahir'] . ', ' . $value['tanggal_lahir'] . ''; ?>
                                                                            </div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Pangkat (Golru) </small>
                                                                            <div class="profil-desc"><?php echo $value['pangkat_golru'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">TMT Pangkat</small>
                                                                            <div class="profil-desc"><?php echo $value['tmt_pangkat'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Jabatan</small>
                                                                            <div class="profil-desc"><?php echo $value['jabatan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">TMT Jabatan</small>
                                                                            <div class="profil-desc"><?php echo $value['tmt_jabatan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Formasi</small>
                                                                            <div class="profil-desc"><?php echo $value['formasi'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Unit Kerja </small>
                                                                            <div class="profil-desc">
                                                                                <?php echo $value['unit_kerja']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Pendidikan </small>
                                                                            <div class="profil-desc"><?php echo $value['pendidikan'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">

                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">Alamat </small>
                                                                            <div class="profil-desc"><?php echo $value['alamat'] ?></div>
                                                                        </div>
                                                                        <hr style="margin: 0;border-color:#ffb080">
                                                                        <div class="profil-point">
                                                                            <small style="font-style:italic">LHKPN</small>
                                                                            <div class="profil-desc"><?php echo $link_pegawai; ?></div>
                                                                        </div>

                                                                    </div>


                                                                </div><!-- end skills_bar -->
                                                            </div><!-- end widget -->


                                                        </div><!-- end team_member -->
                                                    </div><!-- end col-lg-8 -->
                                                    <div class="clearfix"></div>
                                                    <hr class="row" style="border-color:#ffb080;border-style:dashed">
                                                </div>
                                        <?php
                                            };
                                        } else {
                                            echo '
                                            <div class="row"> 
                                                <div class="col-md-12"> Data Kosong </div> 
                                            </div>';
                                        }
                                        ?>

                                    </div>
                                    <div class="tab-pane" id="tab6">

                                        <?php
                                        /*
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">  
<style type="text/css">
    .blog_button, .shop_title_slider span, .cat_widget h3, .rating i, .big_title_onepage span, .small_thin_grey1 i, 
    .popular_items .meta span i, .ch-info-front i, .service_vertical_box:hover .service-icon i, .bgdark span, 
    .item .icon-container, .slider_title_a, .mini_title2 i, .team_member span, 
    .blog-carousel-meta span i, .high_title2, .high_title, .big_title span, 
    .small_title span, .mini_title span, .check li:before, .service-icon-circle i, 
    .servicebox:hover .service-icon i, .shop-right .title .price, .shop_item .price, .cart_table .price2, 
    .widget h3 span, .big_title_slider span, a, .milestone-counter i, a.readmore, .tabbed-menu li a:hover, 
    .footer-menu li a:hover, .mmode .title span, .footer-menu li a:focus, #header-style-1 .yamm h3 i, 
    #header-style-1 .yamm-fw .dropdown-menu li a:before, #topbar .topbar-login i, .group_box i, 
    #topbar .callus i, #topbar .topbar-cart i{
        color: #e87a37;
    }
</style>
*/
                                        ?>
                                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                                        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
                                        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
                                        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
                                        <style type="text/css">
                                            .blog_button,
                                            .shop_title_slider span,
                                            .cat_widget h3,
                                            .rating i,
                                            .big_title_onepage span,
                                            .small_thin_grey1 i,
                                            .popular_items .meta span i,
                                            .ch-info-front i,
                                            .service_vertical_box:hover .service-icon i,
                                            .bgdark span,
                                            .item .icon-container,
                                            .slider_title_a,
                                            .mini_title2 i,
                                            .team_member span,
                                            .blog-carousel-meta span i,
                                            .high_title2,
                                            .high_title,
                                            .big_title span,
                                            .small_title span,
                                            .mini_title span,
                                            .check li:before,
                                            .service-icon-circle i,
                                            .servicebox:hover .service-icon i,
                                            .shop-right .title .price,
                                            .shop_item .price,
                                            .cart_table .price2,
                                            .widget h3 span,
                                            .big_title_slider span,
                                            a,
                                            .milestone-counter i,
                                            a.readmore,
                                            .tabbed-menu li a:hover,
                                            .footer-menu li a:hover,
                                            .mmode .title span,
                                            .footer-menu li a:focus,
                                            #header-style-1 .yamm h3 i,
                                            #header-style-1 .yamm-fw .dropdown-menu li a:before,
                                            #topbar .topbar-login i,
                                            .group_box i,
                                            #topbar .callus i,
                                            #topbar .topbar-cart i {
                                                color: #e87a37;
                                            }

                                            #agenda_pimpinan>thead>tr>th {
                                                vertical-align: top;
                                                border: 1px solid #e5e5e5;
                                                font-size: 16px;
                                                padding: 10px 15px 10px 15px;
                                                color: #444;
                                                font-weight: 600;

                                            }

                                            #agenda_pimpinan>tbody>tr>td {
                                                vertical-align: top;
                                                font-size: 15px;
                                                padding: 10px 15px 10px 15px;
                                                color: #333;
                                            }
                                        </style>
                                        <div class="doc">
                                            <h2> Data Agenda Kegiatan</h2>
                                            <table class="table" id="agenda_pimpinan">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Kegiatan</th>
                                                        <th>Tempat Kegiatan</th>
                                                        <th>Tanggal Kegiatan</th>
                                                        <th>Tanggal Kegiatan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div><!-- end doc -->
                                    </div>
                                </div><!-- end tab-content -->
                            </div><!-- end tabbable -->
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end blog-masonry -->
            </div><!-- end row -->
        </div><!-- end content -->
    </div>
</section>