<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }

    #map {
        width: 100%;
        height: 500px;
    }

    #unduhan_home>thead>tr>th {
        vertical-align: middle;
        border: 1px solid #e5e5e5;
        font-size: 16px;
        padding: 5px 5px 5px 5px;
        color: #444;
        font-weight: 600;
        text-transform: uppercase;

    }

    #unduhan_home>tbody>tr>td {
        vertical-align: middle;
        font-size: 14px;
        padding: 5px 5px 5px 5px;
    }

    .widget {
        height: 375px;
        margin-bottom: 30px;
    }

    .blog-carousel-desc div {
        line-height: 18px;
    }

    .blog-carousel-desc.div_home {
        height: 98px;
    }

    .leaflet-control-container .leaflet-control #controlbox {
        top: -4px;
    }

    .leaflet-control-container .leaflet-control #controlbox #boxcontainer div:nth-child(2) {
        margin-top: 3px !important;
    }

    .leaflet-control-container .leaflet-control .panel {
        background: #fff !important;
        margin-top: 10px !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-header {
        border-bottom: 2px solid rgba(255, 235, 200, 0.9) !important;
        border-right: 2px solid rgba(255, 235, 200, 0.9) !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container {
        background: #e87a37 !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-header .panel-header-container .panel-header-title {
        color: #FFF !important;
        font-size: 18px !important;
        line-height: 24px !important;
        padding-top: 13px !important;
        padding-bottom: 13px !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item {
        padding: 0px !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button {
        color: #444 !important;
    }

    .leaflet-control-container .leaflet-control .panel .panel-content ul.panel-list li.panel-list-item button:hover {
        color: #e87a37 !important;
    }

    .leaflet-popup-content-wrapper,
    .leaflet-popup-tip {
        background: white;
        color: #333;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
        box-shadow: none !important;
    }

    .leaflet-popup-content a {
        color: #ff0000;
    }

    #tabel_pesebaran tr td {
        padding: 5px 5px 5px 5px;
        box-shadow: none !important;
    }

    .header-berita-wrapper {
        box-shadow:
            0px 0px 1.8px rgba(0, 0, 0, 0.07),
            0px 0px 14px rgba(0, 0, 0, 0.14);
        padding-bottom: 20px;
        background: #2a3052;
    }

    .header-berita .berita__title {
        /* overflow-y: scroll; */
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        color: white !important;
    }

    .header-berita .berita__content {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        background-color: transparent;
        color: white !important;
    }

    .header-berita .blog {
        border-bottom: 1px solid gray;
    }

    .header-berita .div_home_box .img-responsive {
        width: 100%;
    }

    .services_vertical .service_vertical_box {
        box-shadow:
            0px 0px 1.8px rgba(0, 0, 0, 0.07),
            0px 0px 14px rgba(0, 0, 0, 0.14);
    }

    .messagebox .rotate {
        border-radius: 8px;
    }

    div .title h2.title_head_widget_owl_blog_two_line {}

    @media(max-width: 480px) {
        div .title h2.title_head_widget_owl_blog_two_line {
            max-width: 300px;
            /*font-size: 18px!important;*/
        }

        .blog-carousel-desc.div_home {
            height: auto;
        }
    }

    @media(max-width: 420px) {
        div .title h2.title_head_widget_owl_blog_two_line {
            max-width: 210px;
            font-size: 22px !important;
            margin-top: 20px !important;
        }
    }

    @media(max-width: 780px) {
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox {
            background: rgba(255, 255, 255, 0.9);
            width: 320px !important;
            height: 60px;
            padding: 15px 50px 15px;
            margin-left: 10px;
        }

        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-menu-container {
            left: 0;
            top: 6px;
        }

        .leaflet-control-container .leaflet-control #controlbox #boxcontainer div:nth-child(2) {
            margin-top: 5px !important;
        }

        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-searchbutton-container,
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer .searchbox-searchbutton-container::after {
            right: 0;
            top: 15px;
        }

    }

    @media(max-width: 360px) {
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox {
            width: 290px !important;
        }
    }

    @media(max-width: 320px) {
        .leaflet-control-container .leaflet-control #controlbox #boxcontainer.searchbox {
            width: 260px !important;
        }
    }

    @media screen and (max-width: 1200px) {
        .tp-banner {
            height: 537px !important;
        }
    }

    @media screen and (min-width: 1200px) {
        .tp-banner {
            height: 561px !important;
        }
    }

    @media screen and (min-width: 992px) {
        .services_vertical .service_vertical_box {
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 16px;
            border-radius: 8px;
        }

        .services_vertical .service_vertical_box h3 {
            margin-top: 0;
        }

        .services_vertical .service_vertical_box p {
            text-align: center;
        }
    }
</style>
<div class="container-fluid">
    <div>
        <div class="col-xs-12 col-md-8" style="padding-right:0;">
            <?php
            //Konten Slider dan Running Text(Pesan Singkat)
            include "slider_dan_running_text.php";
            ?>
        </div>
        <div class="col-xs-12 col-md-4 header-berita-wrapper">
            <div class="title">
                <h2 class="title_head_widget_owl_blog_two_line" style="color: white;">Berita Terbaru</h2>
            </div>
            <div class="mb-0 header-berita">
                <?php
                if (count($list_berita) > 0) {
                    echo '<div>';
                    foreach ($list_berita as $key => $value) {
                        $link_berita = base_url('berita/detail/' . $value['tanggal'] . '/' . $value['id']);
                        if ($value['image'] != '' && $value['image'] != null) {
                            $image        = '<img src="' . base_url('uploads/menu/small/' . $value['image'] . '') . '" alt="" class="img-responsive">';
                        } else {
                            $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
                        }
                ?>
                        <div class="mb-4 blog">
                            <div class="blog-carousel-header" style="padding-bottom: 5px;">
                                <h4 style="line-height: 20px; padding: 0px!important; margin: 2px 0px 2px 0px !important;">
                                    <a class="berita__title" href="<?php echo $link_berita; ?>" title="<?php echo $value['judul']; ?>">
                                        <?php echo substr($value['judul'], 0, 70); ?>...</a>
                                </h4>
                            </div>
                            <div class="berita__content" style="padding: 0px!important; 
                                margin: 0px 0px 5px 0px!important;">
                                <div><?php echo substr(strip_tags($value['konten']), 0, 150); ?>... </div>
                            </div>
                        </div>
                <?php
                    }
                    echo ' 
                        </div>
                            ';
                } else {
                    echo "<p> Data Kosong</p>";
                }
                ?>
                <div class="clearfix"></div>
                <div class="buttons text-center">
                    <a style="width: 100%;" href="<?php echo base_url('berita'); ?>" class="btn btn-success btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
            </div>
            <!-- <div class="widget mb-0 header-berita">
                <?php
                if (count($list_berita) > 0) {
                    echo '<div id="owl_blog_two_line" class="owl-carousel">';
                    foreach ($list_berita as $key => $value) {
                        $link_berita = base_url('berita/detail/' . $value['tanggal'] . '/' . $value['id']);
                        if ($value['image'] != '' && $value['image'] != null) {
                            $image        = '<img src="' . base_url('uploads/menu/small/' . $value['image'] . '') . '" alt="" class="img-responsive">';
                        } else {
                            $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
                        }
                ?>
                        <div class="blog-carousel">
                            <div class="entry">
                                <div class="div_home_box">
                                    <?php echo $image; ?>
                                </div>
                                <div class="magnifier">
                                    <div class="buttons">
                                        <a class="st" rel="bookmark" href="<?php echo $link_berita; ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="post-type" hidden>
                                    <i class="fa fa-info"></i>
                                </div>
                            </div>
                            <div class="blog-carousel-header" style="padding-bottom: 5px;">
                                <h4 style="line-height: 20px; padding: 0px!important; margin: 2px 0px 2px 0px !important;">
                                    <a href="<?php echo $link_berita; ?>" title="<?php echo $value['judul']; ?>">
                                        <?php echo substr($value['judul'], 0, 45); ?>...</a>
                                </h4>
                                <div class="blog-carousel-meta" style="line-height: 16px; padding: 0px!important; margin: 0px!important;">
                                    <span><i class="fa fa-calendar"></i>
                                        <?php echo validateDate($value['tanggal']) ? tgl_indo($value['tanggal']) : '-'; ?></span>
                                </div>
                            </div>
                            <div class="blog-carousel-desc div_home" style="padding: 0px!important; 
                                margin: 0px 0px 5px 0px!important; background: #fff;">
                                <div><?php echo substr(strip_tags($value['konten']), 0, 140); ?>... </div>
                            </div>
                        </div>
                <?php
                    }
                    echo ' 
                        </div>
                            ';
                } else {
                    echo "<p> Data Kosong</p>";
                }
                ?>
                <div class="clearfix"></div>
                <div class="buttons text-center">
                    <a style="width: 100%;" href="<?php echo base_url('berita'); ?>" class="btn btn-primary btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
            </div> -->
        </div>
    </div>
</div>

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

            <?php
            foreach ($grid2 as $key => $value) {
                if ($value['image'] != '' && $value['image'] != null) {
                    $img_grid     = '<img src="' . base_url('uploads/grid_home/' . $value['image'] . '') . '" 
                        alt="' . $value['judul'] . '" style="width: 100%;">';
                } else {
                    $img_grid     = '<img src="' . base_url('assets/img/image_not_found.png') . '" 
                        alt="' . $value['judul'] . '" style="width: 100%;">';
                }
                if ($value['link'] != '' && $value['link'] != null) {
                    $link_grid    = 'href="http://' . $value['link'] . '" target="_blank" ';
                } else {
                    $link_grid    = 'href="#"';
                }
            ?>
                <div class="col-lg-3 col-md-3 col-sm-6 last">
                    <a <?php echo $link_grid; ?> style="text-decoration: none;">
                        <div class="service_vertical_box">
                            <div class="service-icon">
                                <?php echo $img_grid; ?>
                            </div>
                            <h3><?php echo $value['judul']; ?></h3>
                            <p style="line-height: 18px;"><?php echo $value['konten']; ?></p>
                        </div>
                    </a>
                </div><!-- end col-lg-3 -->
            <?php
            }
            ?>
        </div><!-- end services_vertical -->
        <div class="clearfix"></div>
    </div><!-- end container -->
</div><!-- end transparent-bg -->

<section class="blog-wrapper">
    <div class="container">
        <?php include "agenda_kegiatan_dan_unduhan.php"; ?>
        <div class="row">
            <div id="content" class="col-md-12">
                <div class="embedsocial-hashtag" data-ref="0a3a386f9868c2feeb75077c08aacc606bfdf806">
                    <a class="feed-powered-by-es feed-powered-by-es-slider-img" href="https://embedsocial.com/social-media-aggregator/" target="_blank" title="Instagram widget">
                        <img src="https://embedsocial.com/cdn/images/embedsocial-icon.png" alt="EmbedSocial">
                        Instagram widget
                    </a>
                </div>
                <script>
                    (function(d, s, id) {
                        var js;
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://embedsocial.com/cdn/ht.js";
                        d.getElementsByTagName("head")[0].appendChild(js);
                    }(document, "script", "EmbedSocialHashtagScript"));
                </script>
            </div>
        </div>
    </div>
</section>




<section class="white-wrapper" style="padding: 10px 0px 0px 0px;" hidden>
    <div class="container">
        <div class="general-title">
            <h2 class="title_dongker">Peta Persebaran Titik Bencana</h2>
            <hr>
        </div><!-- end general title -->
    </div><!-- end container -->
    <div id="map-" style="margin-top: 20px;"></div>
    <div class="clearfix"></div>
</section>
