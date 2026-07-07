            <!-- <div class="title">
                <h2 class="title_head_widget_owl_blog_two_line">Berita Terbaru</h2>
            </div>
            <div class="widget">
                <?php
                if (count($list_berita) > 0) {
                    echo '<div id="owl_blog_two_line" class="owl-carousel">';
                    foreach ($list_berita as $key => $value) {
                        $link_berita = base_url('berita/detail/' . $value['tanggal'] . '/' . $value['id']);
                        if ($value['image'] != '' && $value['image'] != null) {
                            $image        = '<img src="' . base_url('uploads/menu/small/' . $value['image'] . '') . '" alt="" class="img-responsive">';
                        } else {
                            $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
                        }
                ?>
                        <div class="blog-carousel">
                            <div class="entry">
                                <div class="div_home_box">
                                    <?php echo $image; ?>
                                </div>
                                <div class="magnifier">
                                    <div class="buttons">
                                        <a class="st" rel="bookmark" href="<?php echo $link_berita; ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="post-type" hidden>
                                    <i class="fa fa-info"></i>
                                </div>
                            </div>
                            <div class="blog-carousel-header" style="padding-bottom: 5px;">
                                <h4 style="line-height: 20px; padding: 0px!important; margin: 2px 0px 2px 0px !important;">
                                    <a href="<?php echo $link_berita; ?>" title="<?php echo $value['judul']; ?>">
                                        <?php echo substr($value['judul'], 0, 45); ?>...</a>
                                </h4>
                                <div class="blog-carousel-meta" style="line-height: 16px; padding: 0px!important; margin: 0px!important;">
                                    <span><i class="fa fa-calendar"></i>
                                        <?php echo validateDate($value['tanggal']) ? tgl_indo($value['tanggal']) : '-'; ?></span>
                                </div>
                            </div>
                            <div class="blog-carousel-desc div_home" style="padding: 0px!important; 
                                margin: 0px 0px 5px 0px!important; background: #fff;">
                                <div><?php echo substr(strip_tags($value['konten']), 0, 140); ?>... </div>
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
                    <a style="width: 100%;" href="<?php echo base_url('berita'); ?>" class="btn btn-primary btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
            </div>


            <div class="clearfix"></div>
            <div> &nbsp; </div> -->

            <!-- <div> &nbsp;</div>  -->
            <div class="title">
                <h2 class="title_head_widget_owl_blog_two_line">INFORMASI KEBENCANAAN</h2>
            </div>
            <div class="widget">
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
                        <div class="blog-carousel">
                            <div class="entry">
                                <div class="div_home_box">
                                    <?php echo $image; ?>
                                </div>
                                <div class="magnifier">
                                    <div class="buttons">
                                        <a class="st" rel="bookmark" href="<?php echo $link_informasi_kebencanaan; ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <div class="post-type" hidden>
                                    <i class="fa fa-info"></i>
                                </div>
                            </div>
                            <div class="blog-carousel-header" style="padding-bottom: 5px;">
                                <h4 style="line-height: 20px; padding: 0px!important; margin: 2px 0px 2px 0px !important;">
                                    <a href="<?php echo $link_informasi_kebencanaan; ?>" title="<?php echo $value['judul']; ?>">
                                        <?php echo substr($value['judul'], 0, 50); ?>... </a>
                                </h4>
                                <div class="blog-carousel-meta" style="line-height: 16px; padding: 0px!important; margin: 0px!important;">
                                    <span><i class="fa fa-calendar"></i>
                                        <?php echo validateDate($value['tanggal']) ? tgl_indo($value['tanggal']) : '-'; ?></span>
                                </div>
                            </div>
                            <div class="blog-carousel-desc div_home" style="padding: 0px!important; 
                                margin: 0px 0px 6px 0px!important; background: #fff;">
                                <div><?php echo substr(strip_tags($value['konten']), 0, 130); ?>... </div>
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
                    <a style="width: 100%;" href="<?php echo base_url('informasi_kebencanaan'); ?>" class="btn btn-primary btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
            </div>
            <div> &nbsp;</div>
