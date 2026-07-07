    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2>Berita</h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="javascript:;">Berita</a></li>
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
                            <?php
                            $no = 1;
                            foreach (@$berita as $row) {
                                $img = is_file('./uploads/menu/' . $row->image) ? base_url('uploads/menu/' . $row->image) : './assets/img/image_not_found.png';
                            ?>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="blog-carousel">
                                        <div class="entry">
                                            <div class="div_berita_box">
                                                <img src="<?= $img ?>" alt="" class="img-responsive">
                                            </div>
                                            <div class="magnifier">
                                                <div class="buttons">
                                                    <a class="st" rel="bookmark" href="<?= base_url('berita/detail/' . $row->tanggal . '/' . $row->id . '?title=' . $row->judul) ?>"><i class="fa fa-link"></i></a>
                                                </div>
                                            </div>
                                            <div class="post-type">
                                                <i class="fa fa-images"></i>
                                            </div>
                                        </div>
                                        <div class="blog-carousel-header">
                                            <h3><a title="" href="<?= base_url('berita/detail/' . $row->tanggal . '/' . $row->id) ?>"><?= $row->judul ?> - <?= date('Y', strtotime($row->tanggal)) ?></a></h3>
                                            <div class="blog-carousel-meta">
                                                <span><i class="fa fa-calendar"></i> <?= validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-' ?></span>
                                                <!--
                                                <span>
                                                    <i class="fa fa-comment"></i> 
                                                    <a href="#">03 Comments</a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-eye"></i> 
                                                    <a href="#">84 Views</a>
                                                </span>
                                            -->
                                            </div>
                                        </div>

                                        <div class="social-icons mt-3 mb-2">
                                            <span>
                                                <a data-toggle="tooltip" data-placement="bottom" target="_blank" href="https://api.whatsapp.com/send/?text=<?= @$row->judul ?> <?= @$row->link_detail ?>" data-original-title="Whatsapp" style="background: #25D366; color: #fff; ">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </span>
                                            <span>
                                                <a data-toggle="tooltip" data-placement="bottom" target="_blank" href="http://www.twitter.com/share?url=<?= @$row->link_detail ?>" data-original-title="Twitter" style="background: #1DA1F2; color: #fff; ">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </span>
                                            <span>
                                                <a data-toggle="tooltip" data-placement="bottom" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= @$row->link_detail ?>" data-original-title="Facebook" style="background: #3C5A99; color: #fff; ">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </span>
                                            <span class="last">
                                                <a data-toggle="tooltip" data-placement="bottom" target="_blank" href="https://telegram.me/share/url?url=<?= @$row->link_detail ?>&amp;text=<?= @$row->judul ?>" data-original-title="telegram" style="background: #0088CC; color: #fff; ">
                                                    <i class="fab fa-telegram"></i>
                                                </a>
                                            </span>
                                        </div>

                                        <div class="blog-carousel-desc">
                                            <p><?php echo substr(strip_tags($row->konten), 0, 100); ?> </p>
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