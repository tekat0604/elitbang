<html class="no-js" lang="en">


<body data-mobile-nav-style="classic">
    
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

    <section class="half-section">
        <div class="container">
            <ul class="portfolio-overlay portfolio-wrapper grid grid-loading grid-2col xl-grid-4col lg-grid-4col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center">
            <?php foreach($album as $row){
                    $link_album = base_url('frontend/photos?date='.$row['tanggal'].'&id='.$row['id']); 
                    if($row['image']!='' && $row['image']!=null){
                        $image        = '<img src="'.base_url('uploads/menu/medium/'.$row['image'].'').'" alt="">' ;
                    }else{
                        $image        = '<img src="'.base_url('assets/img/image_not_found.png').'" alt="">';
                    }
                    ?>

        <li class="grid-sizer"></li>
        <li class="grid-item wow animate__fadeIn">
            <div class="portfolio-box">
                <div class=" bg-gradient-sky-blue-pink portfolio-image">
                    <div class="portfolio-hover justify-content-end d-flex flex-column padding-50px-tb lg-padding-30px-tb xs-padding-15px-tb">
                        <div  class="image-wrap">
                            <i class="feather font-weight-300 text-white absolute-middle-center icon-small move-center-bottom" ><?php echo $row['judul']?></i>
                            <a href="<?php echo $link_album; ?>" class="btn btn-white py-2 px-4">More Photos
                            <!-- <a href="<?php echo $link_album; ?>" class="btn btn-dark py-2 px-4"> -->
                        </div>
                    </div>
                    <?php echo $image; ?>
                </a>
                </div>
            </div>
                <?php } ?>
            </li>
    </ul>
        </div>
        <!-- <div class="col-12 d-flex justify-content-center margin-7-half-rem-top md-margin-5-rem-top wow animate__fadeIn"> -->
            <!-- <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center"> -->
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-left icon-extra-small d-xs-none"></i> -->
                    <!-- </a></li> -->
                    <!-- <?= @$pagging ?> -->
                <!-- <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-right icon-extra-small d-xs-none"></i></a></li> -->
            <!-- </ul> -->
        <!-- </div>  -->
    </section>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->

    
</body>
</html>