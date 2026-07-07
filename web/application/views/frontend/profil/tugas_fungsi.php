<section class="post-wrapper-top jt-shadow clearfix">
    <div class="container">
        <div class="col-lg-12">
            <h2> Profil </h2>
            <ul class="breadcrumb pull-right">
                <li><a href="<?php echo base_url('./'); ?>"> <?php echo @$row->judul; ?> </a></li>
                <li>Detail</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-wrapper">
    <div class="container">
        <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="blog-masonry">
                    <div class="col-lg-12">
                        <div class="blog-carousel">
                            <div class="blog-carousel-header">
                                <h1><?= @$row->judul ?></h1>
                            </div>
                            <div class="blog-carousel-desc">
                                <?= @$row->konten ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>