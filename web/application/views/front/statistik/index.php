<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>INTIP KOTA SURAKARTA</title>
    <link rel="shortcut icon" src="<?=base_url()?>assets/front/img/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/front/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/css/shortcodes/shortcodesae52.css?v=5" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/styleae52.css?v=5" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.css" />
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        #data_per_layer{
            width: 100%;
            height: 500px;
        }

        #layer_per_opd,
        #data_per_opd,
        #layer_per_grup_layer,
        #data_per_grup_layer,
        #layer_per_jenis_peta,
        #data_per_jenis_peta,
        #data_per_status,
        #data_per_halaman_detail
        {
            width: 100%;
            height: 400px;
        }

        
    </style>
</head>

<body id="top" class="has-header-search">
    <header id="header" class="tt-nav nav-border-bottom">
        <div class="header-sticky light-header ">
            <div class="container">
                <!-- <div class="search-wrapper">
                    <div class="search-trigger pull-right">
                        <div class='search-btn'></div>
                        <i class="material-icons">&#xE8B6;</i>
                    </div>
                    <i class="search-close material-icons">&#xE5CD;</i>
                    <div class="search-form-wrapper">
                        <form action="#" class="white-form">
                            <div class="input-field">
                                <input type="text" name="search" id="search">
                                <label for="search" class="">Search Here...</label>
                            </div>
                            <button class="btn blue-grey darken-4 search-button waves-effect waves-light" type="submit"><i class="material-icons">&#xE8B6;</i></button>
                        </form>
                    </div>
                </div> -->
                <?php include_once(APPPATH.'views/front/layout/menu.php')?>
                
            </div>
        </div>
    </header>
    <section class="page-title ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Statistik</h2>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Data</a></li>
                        <li class="active">Statistik</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="section-title">Statistik INTIP Kota Surakarta</h2>
                <!-- <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet vived at vestibulum purus erra,</p> -->
            </div>
            <div>
                <div class="col-lg-12">
                    <!-- Bars Chart -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Total Data Per Layer</h3>
                        </div>
                        <div class="block-content block-content-full text-center">
                            <!-- Bars Chart Container -->
                            <div id="data_per_layer"></div>
                        </div>
                    </div>
                    <!-- END Bars Chart -->
                </div>

                <div class="row gutters-tiny invisible" data-toggle="appear">
                    <!-- Row #2 -->
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Layer Per OPD
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="layer_per_opd"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Data Per OPD
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="data_per_opd"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Row #2 -->
                </div>

                <div class="row gutters-tiny invisible" data-toggle="appear">
                    <!-- Row #3 -->
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Layer Per Grup Layer
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="layer_per_grup_layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Data Per Grup Layer
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="data_per_grup_layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Row #3 -->
                </div>

                <div class="row gutters-tiny invisible" data-toggle="appear">
                    <!-- Row #4 -->
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Layer Per Jenis Peta
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="layer_per_jenis_peta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Data Per Jenis Peta
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="data_per_jenis_peta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Row #4 -->
                </div>

                <div class="row gutters-tiny invisible" data-toggle="appear">
                    <!-- Row #5 -->
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Layer Per Status
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="data_per_status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="block">
                            <div class="block-header">
                                <h3 class="block-title">
                                    Data Per Halaman Detail
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="pull-all">
                                    <div id="data_per_halaman_detail"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Row #5 -->
                </div>
            </div>
        </div>
    </section>
    <?php include_once(APPPATH.'views/front/layout/footer.php')?>
    <div id="preloader">
        <div class="preloader-position">
            <img src="<?=base_url()?>assets/front/img/logo-bappeda-dark.png" alt="logo">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>

    

    <script src="<?=base_url()?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="<?=base_url()?>assets/front/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/front/materialize/js/materialize.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/menuzord.js"></script>
    <script src="<?=base_url()?>assets/front/js/bootstrap-tabcollapse.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/imagesloaded.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.sticky.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/smoothscroll.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.stellar.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.shuffle.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/imagesloaded.js"></script>
    <script src="<?=base_url()?>assets/front/flexSlider/jquery.flexslider-min.js"></script>
    <script src="<?=base_url()?>assets/front/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/scriptsae52.js?v=5"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.js"></script>

    <!-- Codebase Core JS -->
    <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/codebase.js"></script>

    <!-- Page JS Plugins -->
    <script src="<?=base_url()?>assets/js/plugins/amcharts4/core.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/amcharts4/charts.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/amcharts4/themes/material.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/amcharts4/themes/animated.js"></script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <?php include_once('index_js.php');?>
</body>

</html>