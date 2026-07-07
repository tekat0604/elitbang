    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2>Galeri</h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="javascript:;">Galeri</a></li>
                </ul>
            </div>
        </div>
    </section>



    <section class="blog-wrapper">
        <div class="container">

            <div class="blog-masonry">
                <div class="row">

                    <?php foreach ($album as $row) {
                        $link_album = base_url('frontend/photos?date=' . $row['tanggal'] . '&id=' . $row['id']);
                        if ($row['image'] != '' && $row['image'] != null) {
                            $image        = '<img src="' . base_url('uploads/menu/medium/' . $row['image'] . '') . '" alt="" class="img-responsive" draggable="false">';
                        } else {
                            $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive" draggable="false">';
                        }
                    ?>

                        <div class="col-md-4">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <div class="div_berita_box">
                                        <?php echo $image; ?>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <a href="<?php echo $link_album; ?>">
                                        <h1> <?php echo $row['judul'] ?> </h1>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>



                </div>
            </div>
        </div>
    </section>
    <?php
    /*
<div style="padding:10vh" class="container-fluid aos-init aos-animate" data-aos="fade" data-aos-delay="500">
        <div class="swiper-container images-carousel swiper-container-horizontal swiper-container-free-mode">
            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                <?php foreach ($album as $row) {
                    $link_album = base_url('frontend/photos?date=' . $row['tanggal'] . '&id=' . $row['id']);
                    if ($row['image'] != '' && $row['image'] != null) {
                        $image        = '<img src="' . base_url('uploads/menu/medium/' . $row['image'] . '') . '" alt="">';
                    } else {
                        $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="">';
                    }
                ?>
                    <div class="swiper-slide swiper-slide-active" style="width: 432px; margin-right: 20px;">
                        <div class="image-wrap">
                            <div class="image-info">
                                <h2 class="mb-3"><?php echo $row['judul'] ?></h2>
                                <a href="<?php echo $link_album; ?>" class="btn btn-outline-white py-2 px-4">More Photos</a>
                            </div>
                            <?php echo $image; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span></div>
            <!-- <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div> -->
            <div class="swiper-scrollbar"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </div>
*/
    ?>