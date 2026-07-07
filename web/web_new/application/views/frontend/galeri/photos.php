<html class="no-js" lang="en">
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
        <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                    <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                        <!-- start breadcrumb -->
                        <ul class="xs-text-center">
                            <li>Dashboard</li>
                            <li><a href="#" class="text-white-hover">Profil</a></li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Galeri</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h6><?= @$detail['judul']?></h6>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?= base_url('frontend/galeri')?>">Galeri</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- <section class="half-section"> -->
            <!-- <div class="row justify-content"> -->

            <div class="site-section" data-aos="fade">
        <div class="container-fluid">
            <div class="row" id="lightgallery">
                <?php foreach($photos as $row){ 
                    if($row['image']!='' && $row['image']!=null){
                        $img_thumb_gallery = '<img src="'.base_url('uploads/sub_menu/small/'.$row['image']).'" 
                        alt="'.$row['judul'].'" class="img-fluid">';
                        $zoom_image = base_url('uploads/sub_menu/'.$row['image']);
                    }else{
                        $img_thumb_gallery = '<img src="'.base_url('assets/img/image_not_found.png').'" 
                        alt="'.$row['judul'].'" class="img-fluid">';
                        $zoom_image = base_url('assets/img/image_not_found.png');
                    } 
                    if($row['link']!=''){
                        $url_youtube="https://www.youtube.com/watch?v=".$row['link']."";
                    }else{
                        $url_youtube="";
                    }
                    if($row['jenis']!=1){
                    ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" 
                        data-src="<?php echo $zoom_image;?>" data-sub-html="<p><?php echo $row['judul']; ?></p>">
                            <a href="#"><?php echo $img_thumb_gallery;?></a><br>
                        </div>
                    <?php
                    }else{
                    ?> 
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" 
                        data-src="<?php echo $url_youtube; ?> " data-sub-html="<p> <?php echo $row['judul']; ?> </p>">
                            <a href="#"><?php echo $img_thumb_gallery;?></a>
                        </div>
                    <?php
                    }
                    ?>
               
                <?php 
                }
                ?>
            </div>
        </div>
    </div>
<?php
/*
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" 
                data-src="https://www.youtube.com/watch?v=HLXE7X92fXM" data-sub-html="<p> Video </p>">
                    <a href="#"><img src="https://app.demoo.id/bpbd/uploads/sub_menu/small/nature_small_2.jpg" 
                    alt="video" class="img-fluid"></a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" 
                data-src="https://app.demoo.id/bpbd/uploads/sub_menu/nature_small_8.jpg" data-sub-html="<p>hfg</p>">
                    <a href="#"><img src="https://app.demoo.id/bpbd/uploads/sub_menu/small/nature_small_8.jpg" 
                    alt="IMage" class="img-fluid"></a>
                </div>


                 <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="<?= base_url('uploads/sub_menu/'.$row['image'])?>" data-sub-html="<p><?= $row['judul']?> <?= $row['jenis']?></p>">
                    <a href="#"><img src="<?= base_url('uploads/sub_menu/small/'.$row['image'])?>" alt="IMage" class="img-fluid"></a>
                </div>
*/
?>
<br>

        </div>
        </div>
        </div>
    </section>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->

</body>
</html>