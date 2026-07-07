<!-- Content -->

    <div class="page-content">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-shap dlab-bnr-inr-lg overlay-black-middle" style="background-image:url(<?= base_url('assets_frontend/images/banner/economy.jpg') ?>); background-size: cover; background-position: center center; background-repeat: no-repeat;">
            <div class="container">
                <div class="dlab-bnr-inr-entry text-white">
                    <h1>Data Makro Ekonomi </h1>
                    <p>Kota Surakarta s/d tahun 2020</p>
                </div>
            </div>
        </div> 
        <!-- inner page banner END -->
        <div class="content-block">
            <?php 
            $no = 1; $left =''; $anti = '';
            foreach ($data as $value_data): 
            if (fadeIn($no) == 'fadeInLeft') {
                $left = 'left';
                $anti = 'fadeInRight'; 
            } else {
                $left = ''; 
                $anti = 'fadeInLeft';
            }
            ?>  
            <!-- about service -->
            <div class="section-full img-box-element">
                <div class="container">
                    <div class="row dzseth m-lr0 about-service-area4 <?= $left ?>">
                        <div class="col-lg-8 col-md-12 p-lr0 wow <?= fadeIn($no); ?> d-flex align-items-center" data-wow-duration="2s" data-wow-delay="0.4s" style="height: 514px;">
                            <div id="container-<?= $value_data->id ?>" style="width:100%; height:400px;"></div>
                        </div>
                        <div class="col-lg-4 col-md-12 d-flex p-lr0 align-items-center wow <?= $anti; ?>" data-wow-duration="2s" data-wow-delay="0.8s" style="height: 514px;">
                            <div class="about-info-left p-10">
                                <h2><?= $value_data->judul ?></h2>
                                <p class="text-justify text"><?= $value_data->deskripsi ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $no++; endforeach ?> 

        </div>
        <!-- about service end -->
         
    </div>
    <!-- Content END-->