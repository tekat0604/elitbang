<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<style>
    .container-fluid{
        padding:0px 0px 10px 0px;
    }
    #map{
        width: 100%;
        height: 500px;
    } 
    #tabel_pesebaran tr td{  
         padding: 5px 5px 5px 5px;
         box-shadow: none!important;
    } 
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_map('all')">
                <a class="block block-link-shadow text-center panel-count" id="all" href="javascript:void(0)">
                    <div class="block-content ribbon ribbon-bookmark ribbon-primary ribbon-left">
                        <div class="ribbon-box"><?= $count->total?></div>
                        <p class="mt-5">
                            <i class="si si-envelope-letter fa-3x"></i>
                        </p>
                        <p class="font-w600 text-uppercase">Semua Laporan</p>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_map('dibalas')">
                <a class="block block-link-shadow text-center panel-count" id="dibalas" href="javascript:void(0)">
                    <div class="block-content ribbon ribbon-bookmark ribbon-warning ribbon-left">
                        <div class="ribbon-box"><?= $count->dibalas?></div>
                        <p class="mt-5">
                            <i class="fa fa-send fa-3x"></i>
                        </p>
                        <p class="font-w600 text-uppercase">Sudah Dibalas</p>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_map('belum_dibalas')">
                <a class="block block-link-shadow text-center panel-count" id="belum_dibalas" href="javascript:void(0)">
                    <div class="block-content ribbon ribbon-bookmark ribbon-danger ribbon-left">
                        <div class="ribbon-box"><?= $count->belum_dibalas?></div>
                        <p class="mt-5">
                            <i class="fa fa-archive fa-3x"></i>
                        </p>
                        <p class="font-w600 text-uppercase">Belum Dibalas</p>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_map('ditangani')">
                <a class="block block-link-shadow text-center panel-count" id="belum_dibalas" href="javascript:void(0)">
                    <div class="block-content ribbon ribbon-bookmark ribbon-success ribbon-left">
                        <div class="ribbon-box"><?= $count->ditangani?></div>
                        <p class="mt-5">
                            <i class="fa fa-archive fa-3x"></i>
                        </p>
                        <p class="font-w600 text-uppercase">Sudah ditangani</p>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="si si-bubbles"></i> Peta Sebaran</h3>
                <div class="block-options">
                    <a type="button" class="btn btn-sm btn-alt-danger btn_ubah" href="<?= base_url('admin/lapor')?>">
                        <i class="fa fa-chevron-left"></i> Kembali ke Tabel
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div id="map"></div>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
