<!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-shap dlab-bnr-inr-lg overlay-black-middle" style="background-image:url(<?= base_url('assets_frontend/images/artikel/bg.jpg') ?>); background-size: cover; background-position: center center; background-repeat: no-repeat;">
            <div class="container">
                <div class="dlab-bnr-inr-entry text-white">
                    <h1>Artikel <span style="color: #ffb9b9;">Berita</span> </h1>
                    <!-- <p>A young and fearless superteam, powered by our ideals</p> -->
                </div>
            </div>
        </div>
        <div class="content-block">
            <!-- blog grid -->
            <div class="section-full content-inner">
                <div class="container">
                    <div class="dlab-blog-grid-3 row">
                        <!-- Side bar END -->
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xl-8">
                            <?php foreach ($data->result() as $row): ?>
                            <div class="blog-post blog-large wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                                <div class="dlab-post-media radius-md">
                                    <a href="<?php echo base_url('frontend/detail_berita/').slug($row->judul) ?>"><img src="<?= base_url('assets_frontend/images/artikel/').$row->gambar1 ?>" alt="<?php echo $row->judul ?>"></a>
                                </div>
                                <div class="dlab-info">
                                    <div class="dlab-post-meta">
                                        <div class="author-thum"><img src="https://ui-avatars.com/api/?name=<?php echo $row->nama ?>" alt=""></div>
                                        <ul>
                                            <li class="post-author"><a href="javascript:#;"><?php echo $row->nama ?></a></li>
                                            <li class="post-date"><?php echo pecah_tanggal($row->dibuat_pada)['tanggal'] ." ". get_month(pecah_tanggal($row->dibuat_pada)['bulan']) ." ". pecah_tanggal($row->dibuat_pada)['tahun'].", ". date("H:m", strtotime($row->dibuat_pada)) ?> WIB</li>
                                        </ul>
                                    </div>
                                    <div class="dlab-post-title ">
                                        <h5 class="post-title"><a href="<?php echo base_url('frontend/detail_berita/').slug($row->judul) ?>"><?php echo $row->judul ?></a></h5>
                                    </div>
                                    <div class="dlab-post-text">
                                        <p>
                                            <?php echo substr($row->isi1,0,300) ?>...
                                        </p>
                                    </div>
                                    <div class="dlab-post-readmore"> 
                                        <a href="<?php echo base_url('frontend/detail_berita/').slug($row->judul) ?>" title="READ MORE" rel="bookmark" class="btn-link">Selengkapnya..</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>

                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                                    <?php echo $pagination ?>
                                </div>
                            </div>
                            <!-- Pagination END -->
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="side-bar sticky-top">
                                <div class="widget recent-posts-entry wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.8s">
                                    <h5 class="widget-title">Berita Terbaru </h5>
                                    <div class="widget-post-bx">
                                        <?php foreach ($berita_terbaru as $row): ?>
                                        <div class="widget-post clearfix">
                                            <div class="dlab-post-media"> <img src="<?= base_url('assets_frontend/images/artikel/') . $row->gambar1 ?>" alt="<?php echo $row->judul ?>"> </div>
                                            <div class="dlab-post-info">
                                                <div class="dlab-post-header">
                                                    <h6 class="post-title"><a href="<?php echo base_url('frontend/detail_berita/').slug($row->judul) ?>"><?php echo $row->judul ?></a></h6>
                                                </div>
                                                <div class="dlab-post-meta">
                                                    <ul>
                                                        <li class="post-date"><?php echo pecah_tanggal($row->dibuat_pada)['tanggal'] ." ". get_month(pecah_tanggal($row->dibuat_pada)['bulan']) ." ". pecah_tanggal($row->dibuat_pada)['tahun'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="widget widget_archive wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.0s">
                                    <h5 class="widget-title">Archives Post</h5>
                                    <ul>
                                        <?php foreach ($berita_archive as $row): ?>
                                        <li><a href="<?php echo base_url('frontend/berita_archive/') . $row->tahun .'/'. $row->bulan ?>"><?php echo get_month($row->bulan) ." ". $row->tahun ?> <span class="badge badge-warning"><?php echo $row->jumlah ?></span></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- blog grid END -->
        </div>
    </div>
    <!-- Content END-->