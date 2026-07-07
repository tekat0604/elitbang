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
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.css" />
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<style type="text/css" media="screen">
#chartdiv {
    width: 100%;
    height: 500px;
}

.amcharts-export-menu-top-right {
    top: 10px;
    right: 0;
}
</style>

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
                <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet vived at vestibulum purus erra,</p>
            </div>
            <div id="chartdiv"></div>
            <div class="table-responsive ptb-50">
                <table id="myTable" class="table table-bordered " role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>BWK</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd">
                            <td class="sorting_1">1</td>
                            <td></td>
                            <td>1</td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="sorting_1">2</td>
                            <td>I</td>
                            <td>1</td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="sorting_1">3</td>
                            <td>II</td>
                            <td>1</td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="sorting_1">4</td>
                            <td>IV</td>
                            <td>1</td>
                        </tr>
                        <tr role="row" class="odd">
                            <td class="sorting_1">5</td>
                            <td>V</td>
                            <td>2</td>
                        </tr>
                        <tr role="row" class="even">
                            <td class="sorting_1">6</td>
                            <td>VI</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
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
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
    <script type="text/javascript">
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": [{
            "country": "I",
            "visits": 1,
            "color": "#FF0F00"
        }, {
            "country": "II",
            "visits": 1,
            "color": "#FF6600"
        }, {
            "country": "IV",
            "visits": 1,
            "color": "#FF9E01"
        }, {
            "country": "V",
            "visits": 2,
            "color": "#FCD202"
        }, {
            "country": "VI",
            "visits": 1,
            "color": "#CD0D74"
        }],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": "Jumlah"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 0
        },
        "export": {
            "enabled": true
        }

    });
    </script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <?php include_once('index_js.php');?>
</body>

</html>