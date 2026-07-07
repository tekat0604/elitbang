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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.css" />
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
                    <h2>Informasi Geospasial</h2>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="#">Data</a></li>
                        <li class="active">Informasi Geospasial</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container">
            <div class="row" style="margin-bottom: 150px">
                <div class="col-md-12">
                    <div class="panel-group feature-accordion brand-accordion icon angle-icon" id="accordion-one">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-one" href="#informasi_dasar" aria-expanded="true" class="">
                                Informasi Geospasial Dasar
                                </a>
                                </h3>
                            </div>
                            <div id="informasi_dasar" class="panel-collapse collapse in" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <div class="table-responsive ">
                                        <table id="table_informasi_dasar" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    
                                                    <th style="text-align:center">NO</th>
                                                    <th style="text-align:center">NAMA</th>
                                                    <th style="text-align:center">DESKRIPSI</th>
                                                    <th style="text-align:center">OPD</th>
                                                    <th style="text-align:center">JUMLAH DATA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no1 = 1?>
                                                <?php foreach($informasi_dasar as $v):?>
                                                <tr>
                                                    <td style="text-align:center"><?=$no1++?></td>
                                                    <td><?=$v['nama_layer']?></td>
                                                    <td><?=$v['deskripsi_layer']?></td>
                                                    <td style="text-align:center"><?=$v['nama_opd']?></td>
                                                    <td style="text-align:center"><?=$v['jumlah_data']?></td>
                                                </tr>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Rencana Tata Ruang -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-one" href="#rencana_tata_ruang" aria-expanded="false">
                            Rencana Tata Ruang
                            </a>
                            </h3>
                            </div>
                            <div id="rencana_tata_ruang" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="table_rencana_tata_ruang" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">NO</th>
                                                    <th style="text-align:center">NAMA</th>
                                                    <th style="text-align:center">DESKRIPSI</th>
                                                    <th style="text-align:center">OPD</th>
                                                    <th style="text-align:center">JUMLAH DATA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no2 = 1?>
                                                <?php foreach($rencana_tata_ruang as $v):?>
                                                <tr>
                                                    <td style="text-align:center"><?=$no2++?></td>
                                                    <td><?=$v['nama_layer']?></td>
                                                    <td><?=$v['deskripsi_layer']?></td>
                                                    <td style="text-align:center"><?=$v['nama_opd']?></td>
                                                    <td style="text-align:center"><?=$v['jumlah_data']?></td>
                                                </tr>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tata Ruang -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-one" href="#informasi_tata_ruang" aria-expanded="false">
                            Informasi Tata Ruang
                            </a>
                            </h3>
                            </div>
                            <div id="informasi_tata_ruang" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="table_informasi_tata_ruang" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">NO</th>
                                                    <th style="text-align:center">NAMA</th>
                                                    <th style="text-align:center">DESKRIPSI</th>
                                                    <th style="text-align:center">OPD</th>
                                                    <th style="text-align:center">JUMLAH DATA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no3 = 1?>
                                                <?php foreach($informasi_tata_ruang as $v):?>
                                                <tr>
                                                    <td style="text-align:center"><?=$no3++?></td>
                                                    <td><?=$v['nama_layer']?></td>
                                                    <td><?=$v['deskripsi_layer']?></td>
                                                    <td style="text-align:center"><?=$v['nama_opd']?></td>
                                                    <td style="text-align:center"><?=$v['jumlah_data']?></td>
                                                </tr>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script data-cfasync="false" src="../../cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="<?=base_url()?>assets/front/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/front/materialize/js/materialize.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/menuzord.js"></script>
    <script src="<?=base_url()?>assets/front/js/bootstrap-tabcollapse.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/smoothscroll.min.js"></script>
    <script src="<?=base_url()?>assets/front/js/scriptsae52.js?v=5"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
    <?php include_once('index_js.php');?>
</body>

</html>