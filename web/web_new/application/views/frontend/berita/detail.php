<div class="dlab-bnr-inr dlab-bnr-inr-shap dlab-bnr-inr-lg overlay-black-middle" style="background-image:url(<?= base_url('assets_frontend/images/artikel/bg.jpg') ?>); background-size: cover; background-position: top center; background-repeat: no-repeat;">
    <div class="container">
        <div class="dlab-bnr-inr-entry text-white">
            <h1><?php echo $data->judul ?></h1>
            <!-- <p>A young and fearless superteam, powered by our ideals</p> -->
        </div>
    </div>
</div>
<!-- inner page banner END -->
<div style="padding-top:30px" class="section-full bg-white content-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row sp0 align-items-center blog-post blog-single top-post">
                    <div class="col-xl-8 col-lg-7">
                        <div class="dlab-info p-r50">
                            <div class="dlab-post-title">
                                <h2 class="post-title"><?php echo $data->judul ?></h2>
                            </div>
                            <div class="dlab-post-meta">
                                <div class="author-thum"><img src="https://ui-avatars.com/api/?name=<?php echo $data->nama ?>" alt="<?php echo $data->judul ?>"></div>
                                <ul>
                                    <li class="post-author"><a href="javascript:void(0);"><?php echo $data->nama ?></a></li>
                                    <li class="post-date"><?php echo pecah_tanggal($data->dibuat_pada)['tanggal'] ." ". get_month(pecah_tanggal($data->dibuat_pada)['bulan']) ." ". pecah_tanggal($data->dibuat_pada)['tahun'] ?></li>
                                </ul>
                            </div>
                            <div class="dlab-post-text">
                                <p style="text-align:justify">
                                    <?php echo $data->isi1 ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 m-b30">
                        <div class="dlab-media">
                            <img src="<?php echo base_url('assets_frontend/images/artikel/') . $data->gambar1 ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dlab-media">
                            <img src="<?php echo base_url('assets_frontend/images/artikel/') . $data->gambar2 ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 m-b30">
                <div class="blog-post blog-single">
                    <div class="dlab-info">
                        <div class="dlab-post-text">
                            <p style="text-align:justify">
                                <?php echo $data->isi2 ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="side-bar sticky-top">
                    <div class="widget recent-posts-entry">
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
                </div>
            </div>
        </div>
    </div>
</div>