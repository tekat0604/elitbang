<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta | INTIP SOLO</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>favicon.png" type="image/x-icon" />


    <!-- CSS -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/> -->
    <link rel="stylesheet" href="<?=base_url()?>assets_front/css/leaflet.css"/>
    <link rel="stylesheet" id="css-main" href="<?= base_url()?>assets/css/codebase.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets_front/css/custom.css">
    <style>
        #myfooter{
            position: fixed;
            width: 100%;
            bottom: 0px;
            z-index: 2000;
            padding: 10px;
            /* background: #ffffff; */
        }
    </style>

</head>
<body>
    <div id="page-container" class="page-header-fixed page-header-glass">

    <div id="page-header">
        <div class="content-header">
            <div id="logo" class="content-header-section">
                <div class="row">
                    <div class="col-1"><img src="<?=base_url()?>assets/solo.png" alt=""></div>
                    <div class="col-11" style="padding-left: 30px;padding-top: 7px">
                        <h2 style="color: #ffffff">INTIP SOLO</h2>
                        <div style="color: #ffffff; font-size: larger; margin-top: -20px">
                            Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-section">
                <button id="btn_map_home" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Kembali ke beranda">
                    <i class="si si-home"></i>
                </button>
                <button id="btn_map_zoom_in" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Perbesar peta">
                    <i class="si si-magnifier-add"></i>
                </button>
                <button id="btn_map_zoom_out" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Perkecil peta">
                    <i class="si si-magnifier-remove"></i>
                </button>
                <button id="btn_map_info" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Tampilkan Informasi Layer">
                    <i class="si si-info"></i>
                </button>
                <button id="btn_map_layers" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Tampilkan layer peta">
                    <i class="si si-layers"></i>
                </button>
                <button id="btn_map_base" type="button" class="btn btn-lg btn-circle btn_map mr-10" title="Pilih peta dasar">
                    <i class="si si-globe"></i>
                </button>
                <button id="btn_map_menu" type="button" class="btn btn-lg btn-circle mr-10 ml-30" title="Tampil atau sembunyikan menu">
                    <i class="fa fa-tasks"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile_header" style="display:none;">
        <div class="row" style="margin-right:0px">
            <div class="col-2" style="padding-top: 10px; padding-left: 30px;"><img src="<?=base_url()?>assets/solo.png" alt=""></div>
            <div class="col-10" style="padding-left: 30px;padding-top: 7px">
                <h2 style="color: #ffffff">INTIP SOLO</h2>
                <div style="color: #ffffff; font-size: larger; margin-top: -20px">
                    Informasi Tata Ruang Infrastruktur dan Perencanaan Kota Surakarta
                </div>
            </div>
        </div>
    </div>
    
    <div id="map"></div>
    <div id="side_layers" class="side_option">
        <div class="side_option_title">Layer</div>
        <div class="side_option_content">

            <?php foreach($grup_layer as $k=>$v):?>
                <div class="layer_group">
                    <div class="layer_group_title"><?=$v['nama_grup_layer']?></div>
                    <div class="layer_group_content pl-10">
                        <?php foreach($layer as $kk=>$vv):?>
                            <?php if($vv['id_grup_layer'] == $v['id_grup_layer']):?>
                                <div>
                                    <label class="css-control css-control-danger css-checkbox">
                                        <?php if(in_array($vv['slug_layer'],['batas_kecamatan','jaringan_jalan_primer','jaringan_jalan_sekunder'])):?>
                                            <input type="checkbox" class="css-control-input" name="<?=$vv['slug_layer']?>" data-name="<?=$vv['nama_layer']?>" checked>
                                        <?php else:?>
                                            <input type="checkbox" class="css-control-input" name="<?=$vv['slug_layer']?>" data-name="<?=$vv['nama_layer']?>">
                                        <?php endif;?>
                                        <span class="css-control-indicator"></span> <?=$vv['nama_layer']?>
                                    </label>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>  
                    </div>
                </div>
            <?php endforeach;?>

            

            <!-- <div class="layer_group">
                <div class="layer_group_title">Base Symbology</div>
                <div class="layer_group_content pl-10">
                    <div>
                        <label class="css-control css-control-danger css-checkbox">
                            <input type="checkbox" class="css-control-input" name="base_symbology">
                            <span class="css-control-indicator"></span> Base Symbology
                        </label>
                    </div>
                </div>
            </div> -->




        </div>
    </div>

    
    <div id="side_base" class="side_option">
        <div class="side_option_title">Base Map</div>
        <div class="side_option_content">
            <div>
                <!-- Google -->
                <label class="css-control css-control-danger css-radio">
                    <input type="radio" class="css-control-input" name="base_map" value="google_map">
                    <span class="css-control-indicator"></span> Google Map
                </label>
                    <div class="pl-30">
                        <label class="css-control css-control-danger css-radio google_child">
                            <input type="radio" class="css-control-input" name="google_base_map" value="roadmap">
                            <span class="css-control-indicator"></span> Roadmap
                        </label>
                    </div>
                    <div class="pl-30">
                        <label class="css-control css-control-danger css-radio google_child">
                            <input type="radio" class="css-control-input" name="google_base_map" value="satellite">
                            <span class="css-control-indicator"></span> Satellite
                        </label>
                    </div>
                    <div class="pl-30">
                        <label class="css-control css-control-danger css-radio google_child">
                            <input type="radio" class="css-control-input" name="google_base_map" value="hybrid">
                            <span class="css-control-indicator"></span> Hybrid
                        </label>
                    </div>
                    <div class="pl-30">
                        <label class="css-control css-control-danger css-radio google_child">
                            <input type="radio" class="css-control-input" name="google_base_map" value="terrain">
                            <span class="css-control-indicator"></span> Terrain
                        </label>
                    </div>
                    
                    <!-- OSM -->
                    <label class="css-control css-control-danger css-radio">
                    <input type="radio" class="css-control-input" name="base_map" value="osm_map" checked>
                    <span class="css-control-indicator"></span> Open Street Map
                </label>
            </div>
                
            <div>
                <!-- <label class="css-control css-control-danger css-radio">
                    <input type="radio" class="css-control-input" value="big_map" name="base_map">
                    <span class="css-control-indicator"></span> BIG
                </label> -->
            </div>
        </div>
    </div>
    <div id="side_info" class="side_option">
        <div class="side_option_title">Info Detail Layer</div>
        <div class="side_option_content">
            
        </div>
    </div>
    <!-- <div id="side_search" class="side_option">
        <div class="side_option_title">Cari Koordinat</div>
        <div class="side_option_content">
            <div class="mt-20">
                <label for="cari_lat">Latitude</label>
                <input class="form-control" type="number" name="cari_lat" placeholder="Masukkan latitude...">
            </div>
            <div class="mt-20">
                <label for="cari_lng">Longitude</label>
                <input class="form-control" type="number" name="cari_lng" placeholder="Masukkan longitude...">
            </div>
            <div class="mt-20" style="text-align: right;">
                <button id="cari_latlng" class="btn btn-primary"><i class="si si-magnifier"></i> Cari</button>
            </div>
        </div>
    </div> -->

     <!-- mobile tabs -->
    <!-- Block Tabs Animated Fade -->
    <div id="mobile_tabs" class="block" style="display:none">
        <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#mobile_base_map"><i class="si si-globe"></i> Peta Dasar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mobile_layers"><i class="si si-layers"></i> Layer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mobile_info"><i class="si si-info"></i> Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mobile_search"><i class="si si-magnifier"></i> Cari</a>
            </li>
        </ul>
        <div class="block-content tab-content overflow-hidden">
            <div class="tab-pane fade show active" id="mobile_base_map" role="tabpanel">
                <div id="side_base">
                    <!-- Google -->
                    <label class="css-control css-control-danger css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="google_map">
                        <span class="css-control-indicator"></span> Google Map
                    </label>
                        <div class="pl-30">
                            <label class="css-control css-control-danger css-radio google_child">
                                <input type="radio" class="css-control-input" name="google_base_map" value="roadmap">
                                <span class="css-control-indicator"></span> Roadmap
                            </label>
                        </div>
                        <div class="pl-30">
                            <label class="css-control css-control-danger css-radio google_child">
                                <input type="radio" class="css-control-input" name="google_base_map" value="satellite">
                                <span class="css-control-indicator"></span> Satellite
                            </label>
                        </div>
                        <div class="pl-30">
                            <label class="css-control css-control-danger css-radio google_child">
                                <input type="radio" class="css-control-input" name="google_base_map" value="hybrid">
                                <span class="css-control-indicator"></span> Hybrid
                            </label>
                        </div>
                        <div class="pl-30">
                            <label class="css-control css-control-danger css-radio google_child">
                                <input type="radio" class="css-control-input" name="google_base_map" value="terrain">
                                <span class="css-control-indicator"></span> Terrain
                            </label>
                        </div>
                        
                        <!-- OSM -->
                        <label class="css-control css-control-danger css-radio">
                        <input type="radio" class="css-control-input" name="base_map" value="osm_map" checked>
                        <span class="css-control-indicator"></span> Open Street Map
                    </label>
                </div>
            </div>
            <div class="tab-pane fade" id="mobile_layers" role="tabpanel">
                <div id="side_layers">
                    <?php foreach($grup_layer as $k=>$v):?>
                        <div class="layer_group">
                            <div class="layer_group_title"><?=$v['nama_grup_layer']?></div>
                            <div class="layer_group_content pl-10">
                                <?php foreach($layer as $kk=>$vv):?>
                                    <?php if($vv['id_grup_layer'] == $v['id_grup_layer']):?>
                                        <div>
                                            <label class="css-control css-control-danger css-checkbox">
                                                <?php if(in_array($vv['slug_layer'],['batas_kecamatan','jaringan_jalan_primer','jaringan_jalan_sekunder'])):?>
                                                    <input type="checkbox" class="css-control-input" name="<?=$vv['slug_layer']?>" data-name="<?=$vv['nama_layer']?>" checked>
                                                <?php else:?>
                                                    <input type="checkbox" class="css-control-input" name="<?=$vv['slug_layer']?>" data-name="<?=$vv['nama_layer']?>">
                                                <?php endif;?>
                                                <span class="css-control-indicator"></span> <?=$vv['nama_layer']?>
                                            </label>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>  
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>   
            </div>
            <div class="tab-pane fade" id="mobile_info" role="tabpanel">
                <div id="info_content"></div>
            </div>
            <div class="tab-pane fade" id="mobile_search" role="tabpanel">
                <div>
                    <label for="cari_lat">Latitude</label>
                    <input class="form-control" type="number" name="cari_lat">
                </div>
                <div>
                    <label for="cari_lng">Longitude</label>
                    <input class="form-control" type="number" name="cari_lng"> 
                </div>
                        
                <div class="mt-20 mb-20">
                    <button id="cari_latlng" class="btn btn-map col-12" style="background:#ff0000;color:#ffffff"><i class="si si-magnifier"></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Block Tabs Animated Fade -->

</div>
<div id="myfooter">
        <div class="row">
            <div class="col-lg-5 col-sm-12">
            </div>
            <div class="col-lg-3 col-sm-12 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        Latitude: 
                    </div>
                </div>
                <input class="form-control" type="number" name="cari_lat">    
            </div>
            <div class="col-lg-3 col-sm-12 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        Longitude: 
                    </div>
                </div>
                <input class="form-control" type="number" name="cari_lng">    
            </div>

            <div class="col-lg-1 col-sm-12">
                <button id="cari_latlng" class="btn btn-map" style="background:#ff0000;color:#ffffff"><i class="si si-magnifier"></i> Cari</button>
            </div>
        </div>

</div>

<!-- JS -->
<!-- <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
crossorigin=""></script> -->
<!-- <script src="https://unpkg.com/@mapbox/leaflet-pip@latest/leaflet-pip.js"></script> -->
<script src="<?=base_url()?>assets_front/js/leaflet.js"></script>
<script src="<?=base_url()?>assets_front/js/leaflet-pip.js"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE"></script>
<script src="<?=base_url(); ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
<script src="<?= base_url(); ?>assets/js/codebase.js"></script>
<?php include_once('peta_rencana_js.php')?>
</body>
</html>