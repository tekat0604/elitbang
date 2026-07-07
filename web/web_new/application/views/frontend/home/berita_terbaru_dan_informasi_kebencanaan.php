
            <!-- start blog berita bencana baru-->               
            <?php
    if (count($informasi_kebencanaan) > 0) {
        echo '<div id="owl_blog_three_line" class="owl-carousel">';
        foreach ($informasi_kebencanaan as $key => $value) {
            $link_informasi_kebencanaan = base_url('informasi_kebencanaan/detail/' . $value['tanggal'] . '/' . $value['id']);
            if ($value['image'] != '' && $value['image'] != null) {
                $image        = '<img src="' . base_url('uploads/menu/small/' . $value['image'] . '') . '" alt="" class="img-responsive">';
            } else {
                $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
            }
    ?>
                            <div class="blog-post bg-white box-shadow-medium margin-30px-bottom wow animate__fadeIn rad-10" style="visibility: visible; animation-name: fadeIn;">
                            <div class="d-flex flex-column flex-md-row align-items-start">
                            <div class="blog-post-image bg-medium-slate-blue">
                                    <?php echo $image; ?>
                            </div>

                    <div class="post-details padding-2-half-rem-lr md-padding-2-half-rem-lr sm-no-padding">
                                    <span class="alt-font text-small text-orange font-weight-500 text-uppercase d-inline-block margin-15px-bottom sm-margin-10px-bottom"><?php echo validateDate($value['tanggal']) ? tgl_indo($value['tanggal']) : '-'; ?></span>
                                    <!-- <a href="<?php echo $link_informasi_kebencanaan; ?>" title="<?php echo $value['judul']; ?>"> -->
                                    <a href="<?php echo $link_informasi_kebencanaan; ?>" title="<?php echo $value['judul']; ?>" class="alt-font font-weight-500 text-extra-large text-extra-dark-gray d-block margin-20px-bottom sm-margin-10px-bottom"><?php echo substr($value['judul'], 0, 45); ?>...</a>
                                    
                                    <p class="post-description mb-0"><?php echo substr(strip_tags($value['konten']), 0, 140); ?>...</p>
                                </div>
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
                    <a style="width: 100%;" href="<?php echo base_url('informasi_kebencanaan'); ?>" class="btn btn-secondary btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
<!-- end blog berita bencana terbaru -->


