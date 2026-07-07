<style type="text/css">
    .widget ul.recent_posts_widget li a.link_sidebar {
        color: #444 !important;
    }

    .widget ul.recent_posts_widget li a.link_sidebar:hover {
        color: #e87a37 !important;
    }
</style>
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
                            <div class="blog-carousel-desc"><?= @$row->konten ?></div>
                        </div>
                    </div>
                </div><!-- end blog-masonry -->

                <div class="clearfix"></div>

            </div><!-- end row -->
        </div><!-- end content -->

    </div><!-- end container -->
</section>