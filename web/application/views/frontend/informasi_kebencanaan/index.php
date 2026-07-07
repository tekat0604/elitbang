    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2><?php echo $judul_halaman ?></h2>
                <ul class="breadcrumb pull-right mobile_none">
                    <li><a href="javascript:;"><?php echo $judul_halaman ?></a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="blog-wrapper">
        <div class="container">
            <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="blog-masonry">
                        <div class="row">
                            <?php $no = 1;
                            foreach (@$list_data as $row) {
                                $tanggal = validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-';
                                if ($row->image != '' && $row->image != null) {
                                    $img_thumnail = '<img src="' . base_url('uploads/menu/' . $row->image) . '" alt="" class="img-responsive">';
                                } else {
                                    $img_thumnail = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive">';
                                }
                            ?>
                                <div class="col-md-4">
                                    <div class="blog-carousel">
                                        <div class="entry">
                                            <div class="div_berita_box">
                                                <?php echo $img_thumnail; ?>
                                            </div>
                                            <div class="magnifier">
                                                <div class="buttons">
                                                    <a class="st" rel="bookmark" href="<?= base_url('' . $halaman . '/detail/' . $row->tanggal . '/' . $row->id) ?>">
                                                        <i class="fa fa-link"></i> </a>
                                                </div>
                                            </div>
                                            <div class="post-type">
                                                <i class="fa fa-images"></i>
                                            </div>
                                        </div>
                                        <div class="blog-carousel-header">
                                            <h3><a title="" href="<?= base_url('' . $halaman . '/detail/' . $row->tanggal . '/' . $row->id) ?>">
                                                    <?= $row->judul ?> - <?= date('Y', strtotime($row->tanggal)) ?>
                                                </a></h3>
                                            <div class="blog-carousel-meta">
                                                <span><i class="fa fa-calendar"></i> <?php echo $tanggal; ?></span>
                                            </div>
                                        </div>
                                        <div class="blog-carousel-desc">
                                            <?php echo substr(strip_tags($row->konten), 0, 100); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                if ($no % 3 == 0) {
                                    echo '</div> <div class="row"> ';
                                }
                                $no++;
                            }
                            ?>
                        </div><!-- end blog-masonry -->

                        <div class="clearfix"></div>
                        <hr>
                        <div class="pagination_wrapper">
                            <!-- Pagination Normal -->
                            <?= @$pagging ?>
                        </div><!-- end pagination_wrapper -->
                    </div><!-- end row -->
                </div><!-- end content -->
            </div><!-- end container -->
    </section>