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
            <h2> PPID </h2>
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
                            <?php
                            if (@$row->image != '' && @$row->image != null) {
                                echo ' 
                                <div class="entry">
                                    <img src="' . base_url('./uploads/page_ppid/' . $row->image) . '" alt="" class="img-responsive" draggable="false">
                                </div>';
                            } else {
                            }
                            ?>
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

        <div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12" hidden>
            <div class="widget" hidden>
                <form action="#" class="search_form">
                    <input type="text" class="form-control" placeholder="Search">
                </form><!-- end search form -->
            </div>
            <div class="widget">
                <div class="title">
                    <h2> PPID </h2>
                </div><!-- end title -->
                <ul class="recent_posts_widget">
                    <?php
                    foreach ($list_lainnya as $key => $value) {
                        $url_detail_lainnya = base_url('ppid/page/' . $value->id);
                        echo '
                        <li style=" height: 20px; margin-bottom: 5px; border-bottom: 1px solid #ddd; ">
                            <a class="link_sidebar" href="' . $url_detail_lainnya . '"> ' . $value->judul . ' </a> 
                        </li>';
                    }
                    ?>

                </ul><!-- recent posts -->
            </div><!-- end widget -->
        </div><!-- end left-sidebar -->

    </div><!-- end container -->
</section>