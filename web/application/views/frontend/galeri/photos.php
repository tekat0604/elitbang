    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2><?= @$detail['judul'] ?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?= base_url('frontend/galeri') ?>">Galeri</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="site-section" data-aos="fade">
        <div class="container-fluid">
            <div class="row" id="lightgallery">
                <?php foreach ($photos as $row) {
                    if ($row['image'] != '' && $row['image'] != null) {
                        $img_thumb_gallery = '<img src="' . base_url('uploads/sub_menu/small/' . $row['image']) . '" 
                        alt="' . $row['judul'] . '" class="img-fluid">';
                        $zoom_image = base_url('uploads/sub_menu/' . $row['image']);
                    } else {
                        $img_thumb_gallery = '<img src="' . base_url('assets/img/image_not_found.png') . '" 
                        alt="' . $row['judul'] . '" class="img-fluid">';
                        $zoom_image = base_url('assets/img/image_not_found.png');
                    }
                    if ($row['link'] != '') {
                        $url_youtube = "https://www.youtube.com/watch?v=" . $row['link'] . "";
                    } else {
                        $url_youtube = "";
                    }
                    if ($row['jenis'] != 1) {
                ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="<?php echo $zoom_image; ?>" data-sub-html="<p><?php echo $row['judul']; ?></p>">
                            <a href="#">
                                <div class="div_berita_box"><?php echo $img_thumb_gallery; ?></div>
                            </a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="<?php echo $url_youtube; ?> " data-sub-html="<p> <?php echo $row['judul']; ?> </p>">
                            <a href="#">
                                <div class="div_berita_box"><?php echo $img_thumb_gallery; ?></div>
                            </a>
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