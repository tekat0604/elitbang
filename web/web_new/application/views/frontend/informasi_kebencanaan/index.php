<html class="no-js" lang="en">
    

<style type="text/css">
#container1 {
   width: 315;
   height: 236px;
}

#container1 img {
   width: 400px;
   height: 300px;
}


</style>

<body data-mobile-nav-style="classic">
    
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>/images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
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
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Berita Kebencanaan</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <section class="bg-light-gray padding-eleven-lr xl-padding-two-lr xs-no-padding-lr half-section">
        <div class="container">
            <div class="row">
                <div class="col-12 blog-content">
                <div class="widget margin-top">
                    <ul class="blog-grid blog-wrapper grid grid-loading grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                        <li class="grid-sizer"></li>
                        <?php $no = 1;
                            foreach (@$list_data as $row) {
                                $tanggal = validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-';
                                if ($row->image != '' && $row->image != null) {
                                    $img_thumnail = '<img src="' . base_url('uploads/menu/' . $row->image) . '" alt="" class="img-responsive">';
                                } else {
                                    $img_thumnail = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
                                }
                            ?>
                        <!-- start blog item -->
                        <!-- <div id="container1"> -->
                        <li class="grid-item wow animate__fadeIn mt-2">
                            <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                <div class="blog-post-image bg-medium-slate-blue">
                                
                                    <a href="<?= base_url('' . $halaman . '/detail/' . $row->tanggal . '/' . $row->id) ?>" title="" ><img src="<?php echo $img_thumnail; ?><?php echo $img_thumnail; ?></a>

                                </div>"
                                <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                    <a class="alt-font text-small d-inline-block margin-10px-bottom"><?= validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-' ?></a>
                                    <a href="<?= base_url('' . $halaman . '/detail/' . $row->tanggal . '/' . $row->id) ?>" class="alt-font font-weight-500 text-extra-medium text-extra-dark-gray margin-15px-bottom d-block"><?= $row->judul ?> - <?= date('Y', strtotime($row->tanggal)) ?></a>
                                    <p><?php echo substr(strip_tags($row->konten), 0, 100); ?></p>
                                </div>
                                <?php
                                if ($no % 3 == 0) {
                                    echo '</div> <div class="row"> ';
                                }
                                $no++;
                            }
                            ?>
                            </div>
                        </li>
                        <!-- end blog item -->
                    </ul>
                </div>


                        <div class="col-12 d-flex justify-content-center margin-7-half-rem-top md-margin-5-rem-top wow animate__fadeIn">
                            <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center">
                                <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-left icon-extra-small d-xs-none"></i>
                            </a></li>
                                <?= @$pagging ?>
                                <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-right icon-extra-small d-xs-none"></i></a></li>
                            </ul>
                        </div> 
                        
                        


                </div>
            </div>
        </div>
    </section>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->

</body>
</html>