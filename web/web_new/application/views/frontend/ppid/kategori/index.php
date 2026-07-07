<html class="no-js" lang="en">
<link rel="stylesheet" href="<?= base_url() ?>/assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?= base_url() ?>/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<style type="text/css">
@media (max-width: 767px) {

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info,
        div.dataTables_wrapper div.dataTables_paginate {
            text-align: left;
        }

        div.dataTables_wrapper div.dataTables_length select {
            margin-left: 30px;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 20px;
        }
    }
</style>

<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        load_table();
    });

    function load_table(input = null) {
        var id_kategori = '<?php echo $this->uri->segment(3); ?>';
        table = $('#table-data').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": false,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('ppid/get_data') ?>",
                "type": "GET",
                "data": {
                    id_kategori: id_kategori
                },
            },
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
                emptyTable: 'Tidak ada data'
            },
            "columnDefs": [],
        });
    }
</script>

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
                            <a href="<?php echo base_url('./'); ?>"> <?php echo $kategori_ppid; ?> &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg> </a>&nbsp; Detail
                        </li>
                    </ul>
                    <h6 class="alt-font text-extra-dark-gray font-weight-500"><?php echo $kategori_ppid; ?></h6>
            
        <section class="blog-wrapper">
            <div class="container">
                <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="blog-masonry">
                            <div class="col-lg-12">
                                <div class="doc">
                                    <table class="table" id="table-data">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th>Judul</th>
                                                <th style="width: 20%;">Berkas</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div><!-- end col-lg-12 -->
                        </div><!-- end blog-masonry -->
                    </div><!-- end row -->
                </div><!-- end content -->
            </div><!-- end container -->
        </section>

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
