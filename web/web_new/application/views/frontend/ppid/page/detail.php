<html class="no-js" lang="en">


<body data-mobile-nav-style="classic">
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
        <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                    <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                        <!-- start breadcrumb -->
                        <ul class="xs-text-center">
                            <li>Dashboard</li>
                            <li><a href="#" class="text-white-hover">Profil</a></li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">PPID</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <section class="half-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center margin-six-bottom">
                    <ul class="breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url('./'); ?>"> <?php echo @$row->judul; ?> &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg> </a>&nbsp; Detail
                        </li>
                    </ul>
                    <h6 class="alt-font text-extra-dark-gray font-weight-500"><?php echo @$row->judul; ?></h6>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                        <?php
                            if (@$row->image != '' && @$row->image != null) {
                                echo ' 
                                <div class="entry">
                                    <img src="' . base_url('./uploads/page_ppid/' . $row->image) . '" alt="" class="img-responsive" draggable="false">
                                </div>';
                            } else {
                            }
                            ?>
                            <div class="alt-font text-extra-dark-gray font-weight-500"><?= @$row->konten ?></div>
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
                </div>
            </div>
        </div>
    </section>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->
       <!-- <script src="assets/datatabel/jquery-3.5.1.js"></script> -->
       <script src="<?= base_url('assets_frontend/new_assets/') ?>datatabel/jquery.dataTables.min.js"></script>
       <script src="<?= base_url('assets_frontend/new_assets/') ?>datatabel/dataTables.bootstrap4.min.js"></script>
       <script type="text/javascript">
           $(document).ready(function() {
               $('#example').DataTable();
           } );
       </script>
</body>
</html>