    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2>Berita</h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?= base_url('berita') ?>">Berita</a></li>
                    <li>Detail</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="blog-wrapper">
        <div class="container">
            <div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="blog-masonry">
                        <div class="col-lg-12">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <?php $img = is_file('./uploads/menu/' . $row->image) ? base_url('uploads/menu/' . $row->image) : './assets/img/image_not_found.png'; ?>
                                    <img src="<?= $img ?>" alt="" class="img-responsive" draggable="false">
                                </div>
                                <div class="blog-carousel-header">
                                    <h1><?= @$row->judul ?></h1>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> <?= validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-' ?></span>
                                        <!--<span><i class="fa fa-comment"></i> <a href="#">03 Comments</a></span>
                                        <span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>
                                        <span><i class="fa fa-user"></i> <a href="#">Admin</a></span>-->
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
                                </div>
                                <div class="blog-carousel-desc"><?= @$row->konten ?></div>
                            </div>
                        </div>
                    </div><!-- end blog-masonry -->

                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="next_prev text-center">
                            <ul class="pager">
                                <li class="previous">
                                    <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"> <i class="fa fa-arrow-left"></i> Kembali</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="widget">
                    <div class="title">
                        <h2>Kategori</h2>
                    </div>
                    <ul class="nav nav-tabs nav-stacked">
                        <?php foreach (get_kategori_berita() as $r) { ?>
                            <li <?= $r->id == $row->id_kategori_menu ? 'class="active"' : '' ?> class="text-left">
                                <a href="<?= base_url('berita?id=' . $r->id) ?>" style="text-align: left;"><?= $r->kategori ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="widget">
                    <div class="title">
                        <h2>Berita Lainnya</h2>
                    </div>
                    <ul class="recent_posts_widget">
                        <?php foreach ($berita as $x) {
                            $img = is_file('./uploads/menu/' . $x->image) ? base_url('uploads/menu/' . $x->image) : './assets/img/image_not_found.png';
                        ?>
                            <li>
                                <a href="<?= base_url('berita/detail/' . $x->tanggal . '/' . $x->id) ?>">
                                    <img src="<?= $img ?>" alt="">
                                    <?= $x->judul ?>
                                </a>
                                <a class="readmore" href="<?= base_url('berita/detail/' . $x->tanggal . '/' . $x->id) ?>">
                                    <?= validateDate($x->tanggal) ? tgl_indo($x->tanggal) : '-' ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>