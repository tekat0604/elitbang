<!-- Content -->
<div style="padding:0" class="page-content bg-white">
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-shap dlab-bnr-inr-lg overlay-black-middle" style="background-image:url(<?= base_url('assets_frontend/images/slide4.png') ?>); background-size: cover; background-position: center center; background-repeat: no-repeat; height: 700px;">
            <div class="container">
                <div class="dlab-bnr-inr-entry text-white">
                    <h1>Sistem Informasi <br> <span style="color: #ffb9b9;">Perekonomian Kota Surakarta</span> </h1>
                    <!-- <p>A young and fearless superteam, powered by our ideals</p> -->
                </div>
            </div>
        </div>
    <div class="content-block">
        <!-- Article -->
        <div class="section-full content-inner-1">
            <div class="section-head text-center m-b30">
                <h2>Berita Terbaru</h2>
            </div>
            <div class="container">
                <div class="row">
                    <?php foreach ($berita as $data): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-post blog-grid style1 shadow wow fadeInUp">
                            <div class="dlab-post-media dlab-img-effect"> 
                                <img class="fit-content" src="<?= base_url('assets_frontend/images/artikel/').$data->gambar1 ?>" alt="">
                            </div>
                            <div class="dlab-info">
                                <div class="dlab-post-meta"> 
                                    <ul>
                                        <li class="post-date"><?= date("l d F Y, H:m", strtotime($data->dibuat_pada)) ?> WIB</li>
                                    </ul>
                                </div>
                                <div class="dlab-post-title">
                                    <h5 class="post-title"><a href="<?php echo base_url('frontend/detail_berita/').slug($data->judul) ?>"><?php echo $data->judul ?></a></h5>
                                </div>
                                <div class="dlab-post-text">
                                    <p><?php echo substr($data->isi1,0,130) ?>...</p>
                                </div>
                                <a href="<?php echo base_url('frontend/detail_berita/').slug($data->judul) ?>" class="btn-link text-black">Selengkapnya <i class="la la-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="row">
                    <div class="section-head text-center m-b30">
                        <a href="<?php echo base_url('frontend/berita/') ?>" class="btn btn-md radius-xl">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Article -->
        <!-- About services  -->
        <div class="section-full bg-white about-service-area1 content-inner" style="padding-top: 20px;">
            <div class="section-head text-center m-b30">
                <h2>Data Ekonomi</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                        <div class="icon-bx-wraper about-service1 center">
                            <div class="icon-bx-sm radius bg-color1 m-b20"> 
                                <a href="javascript:void(0);" class="icon-cell"><img src="<?= base_url() ?>assets_frontend/assets/images/service-icon/services5/icon1.png" alt=""></a> 
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-title">Pertumbuhan Ekonomi</h5>
                                <!-- <p>Recognized as a leading customer satisfaction brand, our global customer support program</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                        <div class="icon-bx-wraper about-service1 center">
                            <div class="icon-bx-sm radius bg-color2 m-b20"> 
                                <a href="javascript:void(0);" class="icon-cell"><img src="<?= base_url() ?>assets_frontend/assets/images/service-icon/services5/icon2.png" alt=""></a> 
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-title">PDRB Seri 2010</h5>
                                <!-- <p>Recognized as a leading customer satisfaction brand, our global customer support program</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.9s">
                        <div class="icon-bx-wraper about-service1 center">
                            <div class="icon-bx-sm radius bg-color3 m-b20"> 
                                <a href="javascript:void(0);" class="icon-cell"><img src="<?= base_url() ?>assets_frontend/assets/images/service-icon/services5/icon3.png" alt=""></a> 
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-title">Pertumbuhan Investasi</h5>
                                <!-- <p>Recognized as a leading customer satisfaction brand, our global customer support program</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.9s">
                        <div class="icon-bx-wraper about-service1 center">
                            <div class="icon-bx-sm radius bg-color4 m-b20"> 
                                <a href="data.html" class="icon-cell"><img src="<?= base_url() ?>assets_frontend/assets/images/service-icon/services5/icon3.png" alt=""></a> 
                            </div>
                            <div class="icon-content">
                                <h5 class="dlab-title">Selengkapnya</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="section-head text-center m-b30">
                        <a href="https://app.demoo.id/ekonomi_surakarta/front/data" class="btn btn-md radius-xl">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About services End -->
        <div style="padding-top: 0;" class="section-full bg-white content-inner">
            <div class="container">
                <div class="section-head text-center">
                    <h2>Kajian</h2>
                </div>
                <div class="dlab-blog-grid-3 row">
                    <div style="padding: 10px 0;" class="section-full bg-white content-inner port-style2">
                        <div class="container">
                            <div class="row">
                                <?php foreach ($kajian as $data): ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 m-b30 wow fadeInUp">
                                    <div class="dlab-box dlab-gallery-box wrapper-kajian-1">
                                        <a href="<?php echo base_url('frontend/detail_kajian/').slug($data->judul) ?>">
                                            <div class="dlab-media wrapper-kajian-2"> 
                                                <div class="display-unduhan" style="background-image:url(<?= base_url('assets_frontend/images/kajian/').$data->gambar ?>)" alt="<?php echo $data->judul ?>"></div> 
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon overlay-gradient align-b text-white"> 
                                                        <div class="port-box text-left">
                                                            <div class="judul-ringkasan">Ringkasan</div>
                                                            <div class="ringkasan"><?php echo $data->deskripsi ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="<?php echo base_url('frontend/detail_kajian/').slug($data->judul) ?>"><div class="judul-kajian"><?php echo $data->judul ?></div>
                                    <a href="<?php echo base_url('frontend/detail_kajian/').slug($data->judul) ?>"><div class="subjudul-kajian"><?php echo $data->penulis ?><span style="float: right;color: tomato;"><?php echo $data->penerbit ?></span></div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <div class="row">
                                <div class="section-head text-center m-b30">
                                    <a href="<?php echo base_url('frontend/kajian') ?>" class="btn btn-md radius-xl">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Content END-->