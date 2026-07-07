<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="INSPIRO" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/portal/') ?>images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Layanan BPBD Surakarta</title>
    <!-- Stylesheets & Fonts -->
    <link href="<?= base_url('assets/portal/') ?>css/plugins.css" rel="stylesheet">
    <link href="<?= base_url('assets/portal/') ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/portal/') ?>css/custom.css">
    <link href="<?= base_url('assets/portal/') ?>css/animate.css" rel="stylesheet" type="text/css" />
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <div class="container-fluid landing vh-100 overflow-auto">
            <div id="logo">
                <img class="img img-responsive" src="<?= base_url('assets/portal/') ?>images/logo-all-bpbd-v1.png" alt="" height="55">
            </div>
            <div class="row pt-5">
                <div class="col-lg-6 d-flex flex-column">
                    <div class="content" style="padding-top: 130px;">
                        <h1 class="text-white">
                            Selamat datang di Layanan
                            <span style="color: #E67820;">BPBD Surakarta</span>
                        </h1>
                        <p class="p-0">
                            Website BPBD Surakarta adalah situs yang menyediakan informasi dan layanan
                            tentang
                            penanggulangan bencana di Kota
                            Surakarta.
                        </p>
                        <a href="<?= base_url('frontend') ?>" class="btn position-relative">Kunjungi Website</a>
                        <a href="<?php echo base_url(); ?>" class="btn position-relative">Kunjungi Portal</a>
                    </div>
                </div>

                <!-- jenis layanan start -->
                <div class="col-lg-6">
                    <div class="row overflow-responsive justify-content-center">
                        <?php
                        foreach ($layanan as $dt_layanan) { ?>
                            <div class="col-md-4 mb-3">
                                <div class="wrap-card">
                                    <div class="card layanan shadow p-3 text-center border-0 overflow-hidden transition-1 mb-0">
                                        <div class="text-center mx-auto">
                                            <img src="<?= base_url('assets/portal/') ?>images/favicon.ico" class="img-6">
                                        </div>
                                        <div class="card-body cardbodinya p-0 mt-2 justify-content-center">
                                            <h5 style="line-height: 18px;"> <?= @$dt_layanan->judul ?> </h5>
                                        </div>
                                        <div class="isikonten">
                                            <div class="overlay-dark-2"></div>
                                            <div class="text-isi">
                                                <a href="javascript:void(0)" class="btn btn-cstm-1" onclick="detail(<?= @$dt_layanan->id ?>)">Kunjungi Layanan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- jenis layanan ends -->
                <div class="footer content text-white mb-0 text-center mt-2">
                    Copyright © 2023 | BPBD Kota Surakarta
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Jenis Layanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid dlogok">
                            ....
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" style="padding: 5px 10px 5px 10px ;">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>

    <!-- Scroll top -->
    <a id="scrollTop">
        <i class="icon-chevron-up"></i>
        <i class="icon-chevron-up"></i>
    </a>
    <script src="<?= base_url('assets/portal/') ?>js/jquery.js"></script>
    <script src="<?= base_url('assets/portal/') ?>js/plugins.js"></script>
    <script src="<?= base_url('assets/portal/') ?>js/functions.js"></script>
    <script src="<?= base_url('') ?>assets/js/plugins/sweetalert2/new.js"></script>

    <script>
        function detail(id) {
            $('#myModal .modal-body .dlogok').html('');
            $.ajax({
                type: "POST",
                url: '<?= base_url('portal/detail_layanan') ?>',
                dataType: "JSON",
                data: {
                    id: id,
                },
                beforeSend: function(res) {
                    Swal.fire({
                        title: 'Loading ...',
                        html: '<i style="font-size:25px;" class="fa fa-sync fa-spin"></i>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                complete: function(res) {
                    Swal.close();
                    // setTimeout(function() {
                    //     Swal.close();
                    // }, 10);
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#myModal .modal-title').text(res.row.judul);
                        $('#myModal').modal('show');
                        $('#myModal .modal-body .dlogok').html(res.html);
                    }
                }
            });
        }
    </script>
</body>

</html>