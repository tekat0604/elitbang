<html class="no-js" lang="en">


<body data-mobile-nav-style="classic">
    
    <!-- start page title -->
    <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>/images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
        <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                    <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                        <!-- start breadcrumb -->
                        <ul class="xs-text-center">
                            <li>Dashboard</li>
                            <li><a href="<?= base_url('frontend/profil') ?>" class="text-white-hover">Profil</a></li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Gempa</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <section class="half-section">
        <div class="container">
            <!-- <div class="row justify-content-center">
                <div class="col-md-12 text-center margin-six-bottom">
                    <h6 class="alt-font text-extra-dark-gray font-weight-500">Image gallery style 01</h6>
                </div>
            </div> -->
            <div class="row justify-content-center">
            <div class="col-lg-12">
                    <h5>INFO GEMPA BUMI</h5>
                    <ul class="breadcrumb pull-right">
                        <li><a href="javascript:;">Gempa bumi</a></li>
                    </ul>
                </div>
            </div>
            <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="blog-masonry">
                            <div class="col-lg-12">
                                <div class="doc">
                                    <h6>Informasi Gempa Bumi Dirasakan</h6>
                                    <table class="table" id="table-data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Waktu Gempa</th>
                                                <th>Wilayah</th> 
                                                <th>Magnitudo</th>
                                                <th>Kedalaman</th>
                                                <th>Lintang Bujur</th>
                                                <th>Keterangan</th> 
                                            </tr>
                                        </thead>
                                    </table>
                                    <p style="color: blue; font-weight: bold;">Sumber: BMKG</p>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                            </div><!-- end col-lg-12 -->
                        </div><!-- end blog-masonry -->
                    </div><!-- end row -->
                </div><!-- end content -->
        </div>
        
    </section>

    

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up" style="line-height: 2;"></i></a>
    <!-- end scroll to top -->
       <!-- <script src="assets/datatabel/jquery-3.5.1.js"></script> -->
       <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
       <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
       <script type="text/javascript">
           $(document).ready(function() {
               $('#example').DataTable();
           } );
       </script>
</body>
</html>