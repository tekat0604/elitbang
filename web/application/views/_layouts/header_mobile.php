<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>BPBD KOTA SURAKARTA</title>
    <link rel="shortcut icon" href="<?= base_url('assets_frontend/assets/') ?>custom/images/bpbd-solo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BPBD Kota Surakarta">
    <meta name="keywords" content="BPBD Kota Surakarta">
    <meta name="author" content="BPBD Kota Surakarta">

    <!-- Bootstrap Styles -->
    <link href="<?= base_url('assets_frontend/assets/') ?>css/bootstrap.css" rel="stylesheet">

    <!-- Styles -->
    <link href="<?= base_url('assets_frontend/assets/') ?>style.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="<?= base_url('assets_frontend/assets/') ?>css/all.css" rel="stylesheet">

    <!-- Carousel Slider -->
    <link href="<?= base_url('assets_frontend/assets/') ?>css/owl-carousel.css" rel="stylesheet">

    <!-- CSS Animations -->
    <link href="<?= base_url('assets_frontend/assets/') ?>css/animate.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,400italic,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Exo:400,300,600,500,400italic,700italic,800,900' rel='stylesheet' type='text/css'>

    <!-- SLIDER ROYAL CSS SETTINGS -->
    <link href="<?= base_url('assets_frontend/assets/') ?>royalslider/royalslider.css" rel="stylesheet">
    <link href="<?= base_url('assets_frontend/assets/') ?>royalslider/skins/default-inverted/rs-default-inverted.css" rel="stylesheet">

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>rs-plugin/css/settings.css" media="screen" />

    <?php if (@$add_plugin_galeri) { ?>
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/jquery-ui.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/lightgallery.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/swiper.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/aos.css">
        <link rel="stylesheet" href="<?= base_url() ?>/assets_frontend/assets/galeri/css/style.css">
    <?php } ?>

    <!-- Switcher Only -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/switcher.css" media="all" />
    <!-- END Switcher Styles -->

    <!-- Demo Examples -->
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/tael.css" title="tael" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/light-green.css" title="light-green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/yellow.css" title="yellow" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/light-blue.css" title="light-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/purple.css" title="purple" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/violet.css" title="violet" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/red.css" title="red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?= base_url('assets_frontend/assets/') ?>dark-style.css" title="dark" media="all" />
    <!-- END Demo Examples -->

    <!-- Styles -->
    <link href="<?= base_url('assets_frontend/assets/') ?>custom/css/style.css" rel="stylesheet">
    <?php
    if (isset($extra_css)) {
        $this->load->view($extra_css);
    }
    ?>
</head>

<body>

    <?php $get_profil_website = get_profil_website(); ?>