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
    <link rel="shortcut icon" href="<?=base_url()?>assets/front/img/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?=base_url()?>assets/front/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/css/shortcodes/shortcodesae52.css?v=5" rel="stylesheet">
    <link href="<?=base_url()?>assets/front/styleae52.css?v=5" rel="stylesheet">
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                    <h2>Album Peta</h2>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="#">Data</a></li>
                        <li class="active">Album Peta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-50">
                <h2 class="section-title">Album Peta INTIP Kota Surakarta</h2>
                <!-- <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet vived at vestibulum purus erra,</p> -->
            </div>
            <div class="portfolio-container">
                <ul class="portfolio-filter brand-filter text-center">
                    <li class="active waves-effect waves-light" data-group="all">All</li>
                    <?php foreach($kategori as $v):?>
                        <li class="waves-effect waves-light" data-group="<?=$v['slug']?>"><?=$v['nama']?></li>
                    <?php endforeach?>
    
                </ul>
                <div class="portfolio portfolio-with-title col-2 gutter mtb-50">

                    <?php foreach($album as $v):?>
                    <div class="portfolio-item" data-groups='["all","<?=$v['slug']?>"]'>
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?=base_url()?>assets/img/album/<?=$v['file']?>" alt="<?=$v['nama_foto']?>">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator"><?=$v['nama_foto']?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                    
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
    <?php include_once('index_js.php');?>
</body>

</html>