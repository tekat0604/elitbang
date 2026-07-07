<section class="post-wrapper-top jt-shadow clearfix">
    <div class="container">
        <div class="col-lg-12">
            <h2>Detail Laporan / Aduan</h2>
            <ul class="breadcrumb pull-right mobile_none">
                <li><a href="<?= base_url('daftar_laporan') ?>">Daftar Laporan</a></li>
                <li>Detail Laporan</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-wrapper">
    <div class="container">

        <div id="content" class="col-lg-6 col-md-8 col-sm-12 col-xs-12" style="padding-bottom: 0px;">
            <div class="row">
                <div class="blog-masonry" style="margin-top: 22px;">
                    <div class="col-lg-12">
                        <div class="blog-carousel">
                            <div class="entry">
                                <?php
                                if ($row->gambar != '' && $row->gambar != null) {
                                    $img = '<img src="' . base_url('uploads/lapor/' . $row->gambar) . '" alt="" 
                                        class="img-responsive" draggable="false">';
                                } else {
                                    $img = '';
                                }
                                echo $img;
                                ?>
                            </div>
                            <div class="blog-carousel-header">
                                <h1><?= $row->subjek ?></h1>
                                <?php $explode_datetime = explode(' ', $row->created);
                                $date = tgl_indo($explode_datetime[0]);
                                $time = substr($explode_datetime[1], 0, 5); ?>
                                <div class="blog-carousel-meta">
                                    <span><i class="fa fa-calendar-alt"></i> <?= $date ?></span>
                                    <span><i class="fa fa-phone-alt"></i> <a><?= substr($row->no_hp, 0, 9) . 'xxx' ?></a></span>
                                    <!--<span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>-->
                                    <span><i class="fa fa-user"></i> <a><?= $row->nama ?></a></span>
                                </div>
                            </div>
                            <div class="blog-carousel-desc">
                                <h4 style="padding-bottom: 0px; margin-bottom: 0px;"> Lokasi : </h4>
                                <p class="justify" style="border-bottom: 1px solid #ddd;"> <?= $row->lokasi ?></p>
                                <h4 style="padding-bottom: 0px; margin-bottom: 0px;"> Detail Lokasi : </h4>
                                <p class="justify" style="border-bottom: 1px solid #ddd;"> <?= $row->lokasi_detail ?></p>
                                <h4 style="padding-bottom: 0px; margin-bottom: 0px;"> Pesan : </h4>
                                <p class="justify" style="border-bottom: 1px solid #ddd;">Pesan : <?= $row->pesan ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

        <div id="sidebar" class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="title">
                    <h3 style="margin: 0 0 5px 0; padding-bottom: 5px;">Lokasi</h3>
                </div>
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>

            <!--<div class="widget">
                    <div class="title">
                        <h2>Laporan Lainnya</h2>
                    </div>
                    <ul class="recent_posts_widget">
                        <li>
                            <a href="lapor-detail.html"><img src="assets/demos/sidebar_hot_01.jpg" alt="">Android Toy Restyled Again Latest Phone.</a>
                            <a class="readmore" href="lapor-detail.html">Feburay 16, 2013</a>
                            <div class="rating">
                                <i class="fa fa-user" style="padding-right:5px"></i>Budi Sasono
                            </div>
                        </li>
                        <li>
                            <a href="lapor-detail.html"><img src="assets/demos/sidebar_hot_02.jpg" alt="">Nulla vitae libero, a pharetra. </a>
                            <a class="readmore" href="lapor-detail.html">Feburay 16, 2013</a>
                            <div class="rating">
                                <i class="fa fa-user" style="padding-right:5px"></i>Budi Sasono
                            </div>
                        </li>
                        <li>
                            <a href="lapor-detail.html"><img src="assets/demos/sidebar_hot_03.jpg" alt="">This is another review post.</a>
                            <a class="readmore" href="lapor-detail.html">Feburay 16, 2013</a>
                            <div class="rating">
                                <i class="fa fa-user" style="padding-right:5px"></i>Budi Sasono
                            </div>
                        </li>
                        <li>
                            <a href="lapor-detail.html"><img src="assets/demos/sidebar_hot_04.jpg" alt="">Did you see our new fruit?</a>
                            <a class="readmore" href="lapor-detail.html">Feburay 16, 2013</a>
                            <div class="rating">
                                <i class="fa fa-user" style="padding-right:5px"></i>Budi Sasono
                            </div>
                        </li>
                    </ul>
                </div>-->
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="next_prev text-center">
                    <ul class="pager" style="margin: 0px; padding: 0px;">
                        <li class="previous">
                            <a href="<?= base_url('./'); ?>"> <i class="fa fa-arrow-left"></i> Kembali</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</section>