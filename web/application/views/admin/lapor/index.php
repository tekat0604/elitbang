<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style> 
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<link rel="stylesheet" href="<?php echo base_url('');?>assets/leaflet/real_time/leaflet_awesome_number_markers.css" />
<style>
    .container-fluid{
        padding:0px 0px 10px 0px;
    }
    #map{
        width: 100%;
        height: 500px;
    }  
    /* .leaflet-popup-content-wrapper, .leaflet-popup-tip{
        background: #ffcc00;
    }
    .leaflet-container a.leaflet-popup-close-button{
        color: #fff;
    }
    .leaflet-container a.leaflet-popup-close-button:hover{
        color: #ff0000;
    } */
    #tabel_pesebaran{   
        border-radius: 10px;
        font-size       : 14px;
    } 
    #tabel_pesebaran tr td{  
        padding: 7px 10px 7px 10px;
        box-shadow: none!important; 
    } 
    .leaflet-popup-content{
        width           : 350px!important;
    }
    .circle_marker{
        width           : 10px; 
        height          : 10px; 
        background      : #fff; 
        border-radius   : 50%; 
        margin-top      : 2px;
    }
    #tabel_pesebaran .btn_action{
        padding         : 7px 20px 7px 20px;
        border-radius   : 7px;
        color           : #FFF;
        background      : red;
        text-decoration : none;
        border          : 2px solid rgba(255,255,255,0.8);
    }
    #tabel_pesebaran tr{
        background-color: rgba(155,155,155,0.2);
    }
    #tabel_pesebaran tr:nth-child(odd){
        background-color: rgba(200,200,200,0.2);
    }
    .awesome-number-marker-icon-red{
        animation: fade 1s infinite alternate;
    } 
    .awesome-number-marker-icon-red:hover:before{ 
        box-shadow: 0 0 15px #000;
        filter: blur(3px);
        transform: scale(1.2);
    }
    .awesome-number-marker-icon-red:hover{ 
    box-shadow: 0 0 15px #000;
    text-shadow: 0 0 15px #000;
    border-radius: 50%; 
    }
    @keyframes fade {
        from {
            opacity: 0.5;
            top: -10px;
        }
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <!-- <h2 class="content-heading"></h2> -->
        <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_table('all')">
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
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_table('dibalas')">
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
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_table('belum_dibalas')">
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
            <div class="col-xs-12 col-sm-6 col-md-6 col-xl-3" onclick="refresh_table('ditangani')">
                <a class="block block-link-shadow text-center panel-count" id="belum_dibalas" href="javascript:void(0)">
                    <div class="block-content ribbon ribbon-bookmark ribbon-success ribbon-left">
                        <div class="ribbon-box" id="count-ditangani"><?= $count->ditangani?></div>
                        <p class="mt-5">
                            <i class="fa fa-archive fa-3x"></i>
                        </p>
                        <p class="font-w600 text-uppercase">Sudah Ditangani</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="si si-bubbles"></i> Peta Sebaran</h3>
                <div class="block-options" style="display: none;">
                    <a type="button" class="btn btn-sm btn-alt-danger btn_ubah" href="<?= base_url('admin/lapor')?>">
                        <i class="fa fa-chevron-left"></i> Kembali ke Tabel
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div id="map"></div>
            </div>
        </div>
        
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"><i class="si si-bubbles"></i> Daftar Lapor</h3>
                <div class="block-options" style="display: none;">
                    <a type="button" class="btn btn-sm btn-alt-danger btn_ubah" href="<?= base_url('admin/lapor/peta')?>">
                        Tampilkan Peta <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
            <div class="block-content">
            <!-- Table start -->
            <table class="table table-striped" id="mydata" style="width:100%">
                <thead>
                    <tr>
                        <!--<th style="width: 5%;">No</th>-->
                        <th style="width: 20%;">Nama</th>
                        <th>Kategori - Subjek</th>
                        <th style="width: 15%;">Date</th>
                        <th style="width: 15%;">Ditangani</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
            </table>
            <!-- Table end -->
            </div>
        </div>
        
    </div>
</main>
<!-- END Main Container -->