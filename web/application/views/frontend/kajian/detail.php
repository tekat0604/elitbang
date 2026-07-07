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
        <div style="padding-top:30px" class="section-full bg-white content-inner">
            <div class="container">
                <div class="row sp30 business-solution">
                    <div class="col-lg-6 col-md-6 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.8s">
                        <div class="about-img2">
                            <img style="width: 475px; height: auto;" src="<?= base_url('assets_frontend/images/kajian/').$row->gambar ?>" class="img-move" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 m-b30 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.8s">
                        <h5><?php echo $row->judul ?></h5>
                        <p><?php echo $row->deskripsi ?></p>
                        
                        <h4 class="m-b5">Penulis</h4>
                        <p><?php echo $row->penulis ?></p>

                        <h4 class="m-b5">Tahun Terbit</h4>
                        <p><?php echo $row->tahun_terbit ?></p>

                        <h4 class="m-b5">Penerbit</h4>
                        <p><?php echo $row->penerbit ?></p>
                        
                        <a href="<?php echo base_url('assets_frontend/images/file_kajian/') . $row->file ?>" class="btn btn-md radius-xl">Unduh Berkas</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog grid END -->
    </div>
</div>
<!-- Content END-->