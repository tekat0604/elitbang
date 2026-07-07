<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="INSPIRO" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/portal/') ?>images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Portal BPBD Surakarta</title>
    <!-- Stylesheets & Fonts -->
    <link href="<?= base_url('assets/portal/') ?>css/plugins.css" rel="stylesheet">
    <link href="<?= base_url('assets/portal/') ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/portal/') ?>css/custom.css">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 landing vh-100 d-flex flex-column justify-content-between">
                    <div id="logo">
                        <img class="img img-responsive" src="<?= base_url('assets/portal/') ?>images/logo-all-bpbd-v1.png" alt="" height="55">
                    </div>
                    <div class="content">
                        <h1 class="text-white">
                            Selamat datang di Web Portal <br>
                            <span style="color: #E67820;">BPBD Surakarta</span>
                        </h1>
                        <p class="col-8 p-0">
                            Website BPBD Surakarta adalah situs yang menyediakan informasi dan layanan
                            tentang
                            penanggulangan bencana di Kota
                            Surakarta.
                        </p>
                        <a href="<?= base_url('frontend') ?>" class="btn position-relative">Kunjungi Website</a>
                        <a href="https://appbagor.surakarta.go.id/sop/skm/instrumen/isi/24" class="btn position-relative" target="_blank">
                            Survey Kepuasan Masyarakat
                        </a>
                        <a href="<?=base_url('assets/app-release.apk')?>" class="" target="_blank" style="margin-left: 10px; background: #ff0000; 
                        display: none; ">
                            <img src="<?=base_url('assets/img/icon_android.png')?>" style="width: 230px; padding-top: 10px;"> 
                        </a>
                        <a href="<?=base_url('assets/app-release.apk')?>"  class="btn position-relative" target="_blank" style="margin-left: 5px;">
                             Aplikasi Abdi Anti Prei
                        </a>
                    </div>

                    <div class="footer text-white">
                        Copyright © 2023 | BPBD Kota Surakarta
                    </div>
                </div>

                <!-- LIST WEBSITE -->
                <div class="col-lg-4 p-0" style="right: 0; height:100vh; display: flex; flex-direction: column;">
                    <div class="list-group text-center" style="background-color: transparent">
                        <a href="<?= base_url('lapor/ulas') ?>" class="d-flex list-group-item list-group-item-action align-items-center justify-content-center">
                            <div>
                                <h4>Pengaduan</h4>
                                <p class="">
                                    Situs web yang menyediakan informasi dan sumber daya tentang
                                    persiapan dan
                                    respons dalam menghadapi bencana alam atau
                                    kejadian darurat lainnya.
                                </p>
                            </div>
                        </a>
                        <a href="<?= base_url('portal/layanan') ?>" class="d-flex list-group-item list-group-item-action align-items-center justify-content-center">
                            <div>
                                <h4>Jenis Layanan</h4>
                                <p class="">
                                    Situs web ini terdapat 14 layanan yang ada di BPBD Surakarta
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <a id="scrollTop">
            <i class="icon-chevron-up"></i>
            <i class="icon-chevron-up"></i>
        </a>
        <script src="<?= base_url('assets/portal/') ?>js/jquery.js"></script>
        <script src="<?= base_url('assets/portal/') ?>js/plugins.js"></script>
        <script src="<?= base_url('assets/portal/') ?>js/functions.js"></script>
        <script>
            (function() {
                var s = document.createElement("script");
                s.setAttribute("data-account", "GmB3uqn0Ax");
                s.setAttribute("src", "https://cdn.userway.org/widget.js");
                document.body.appendChild(s);
            })();
        </script><noscript>Enable JavaScript to ensure <a href="https://userway.org">website accessibility</a></noscript>
</body>

</html>