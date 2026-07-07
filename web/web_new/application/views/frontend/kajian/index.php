<!-- Content -->
<div class="page-content">
    <!-- inner page banner -->
    <div class="dlab-bnr-inr dlab-bnr-inr-shap dlab-bnr-inr-lg overlay-black-middle" style="background-image:url(<?= base_url('assets_frontend/images/kajian/kajian.jpg') ?>); background-size: cover; background-position: center center; background-repeat: no-repeat;">
            <div class="container">
                <div class="dlab-bnr-inr-entry text-white">
                    <h1>Daftar <span style="color: #ffb9b9;">Kajian</span> </h1>
                    <!-- <p>A young and fearless superteam, powered by our ideals</p> -->
                </div>
            </div>
        </div>
    <div class="content-block">
        <!-- blog grid -->
        <div class="section-full content-inner">
            <div class="container">
                <div class="dlab-blog-grid-3 row">
                        <div style="padding: 10px 0;" class="section-full bg-white content-inner port-style2">
                            <div class="container">
                                <div class="row">
                                    <?php foreach ($data as $row): ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                                        <div class="dlab-box dlab-gallery-box wrapper-kajian-1">
                                            <a href="<?php echo base_url('frontend/detail_kajian/') . $row->id ?>">
                                                <div class="dlab-media wrapper-kajian-2"> 
                                                    <div class="display-unduhan" style="background-image:url(<?= base_url('assets_frontend/images/kajian/').$row->gambar ?>)" alt=""></div> 
                                                    <div class="overlay-bx">
                                                        <div class="overlay-icon overlay-gradient align-b text-white"> 
                                                            <div class="port-box text-left">
                                                                <div class="judul-ringkasan">Ringkasan</div>
                                                                <div class="ringkasan"><?php echo $row->deskripsi ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a href="<?php echo base_url('frontend/detail_kajian/') . $row->id ?>"><div class="judul-kajian"><?php echo $row->judul ?></div>
                                        <a href="<?php echo base_url('frontend/detail_kajian/') . $row->id ?>"><div class="subjudul-kajian"><?php echo $row->penulis ?><span style="float: right;color: tomato;"><?php echo $row->tahun_terbit ?></span></div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <!-- blog grid END -->
    </div>
</div>
<!-- Content END-->