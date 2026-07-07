<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Sistem Informasi BPBD | Kabupaten Sukoharjo</title>

        <meta name="description" content="Sistem Informasi BPBD | Kabupaten Sukoharjo">
        <meta name="author" content="Phicosdev">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Sistem Informasi BPBD | Kabupaten Sukoharjo">
        <meta property="og:site_name" content="INTIP">
        <meta property="og:description" content="Sistem Informasi BPBD | Kabupaten Sukoharjo">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets_frontend/assets/')?>custom/images/bpbd-solo.png" type="image/x-icon" />
        <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets_frontend/assets/')?>custom/images/bpbd-solo.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets_frontend/assets/')?>custom/images/bpbd-solo.png">
 
        <link rel="stylesheet" href="<?=base_url()?>assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
        <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
        <?php
        if(isset($extra_css)){
            echo $extra_css;
        }
        ?>

        <!-- Dropzone -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/dropzonejs/min/dropzone.min.css">

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/magnific-popup/magnific-popup.min.css">
        

        <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
        
    </head>
    <body>
        <!--
        MAIN CONTENT LAYOUT
        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed page-header-modern ">
            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="content-header content-header-fullrow px-15">
                            <!-- Mini Mode -->
                            <div class="content-header-section sidebar-mini-visible-b">
                                <!-- Logo -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                                </span>
                                <!-- END Logo -->
                            </div>
                            <!-- END Mini Mode -->

                            <!-- Normal Mode -->
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                                <!-- Close Sidebar, Visible only on mobile screens -->
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                                
                                <!-- END Close Sidebar -->

                                <!-- Logo -->
                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="<?=base_url()?>">
                                        <!-- <i class="si si-globe text-primary"></i> -->
                                        <span class="font-size-xl text-dual-primary-dark">SIM</span>
                                        <span class="font-size-xl" style="color: #e87a37;"> BPBD</span>
                                    </a>
                                </div>
                                <!-- END Logo -->
                            </div>
                            <!-- END Normal Mode -->
                        </div>
                        <!-- END Side Header -->

                        <!-- Side User -->
                        <div class="content-side content-side-full content-side-user px-10 align-parent">
                            <!-- Visible only in mini mode -->
                            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                <img class="img-avatar img-avatar32" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="">
                            </div>
                            <!-- END Visible only in mini mode -->

                            <!-- Visible only in normal mode -->
                            <div class="sidebar-mini-hidden-b text-center">
                                <a class="img-link" href="#">
                                    <img class="img-avatar" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="">
                                </a>
                                <ul class="list-inline mt-10">
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href=""><?= $this->session->userdata('nama'); ?></a>
                                    </li>
                                    
                                    <li class="list-inline-item">
                                        <a class="link-effect text-dual-primary-dark" href="<?= base_url(); ?>auth/login/out">
                                            <i class="si si-logout"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Visible only in normal mode -->
                        </div>
                        <!-- END Side User -->