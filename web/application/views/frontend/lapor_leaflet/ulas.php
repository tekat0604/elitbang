<style type="text/css">
    .reload_lokasi {
        position: absolute;
        top: 53px;
        right: 25px;
        cursor: pointer;
        z-index: 99999999999
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 34px;
        margin-bottom: 0;
    }

    .empty_map {
        padding: 10px;
        border: 1px solid #ff0000;
        animation: fade 1s infinite alternate;
    }

    .empty_map:hover:before {
        box-shadow: 0 0 15px #000;
        filter: blur(3px);
        transform: scale(1.2);
    }

    .empty_map:hover {
        box-shadow: 0 0 15px #000;
        text-shadow: 0 0 15px #000;
    }

    @keyframes fade {
        from {
            opacity: 0.5;
            top: -10px;
        }
    }
</style>
<?php $get_profil_website = get_profil_website(); ?>
<section class="post-wrapper-top jt-shadow clearfix" hidden>
    <div class="container">
        <div class="col-lg-12">
            <h2>Informasi</h2>
            <ul class="breadcrumb pull-right">
                <li><a href="javascript:;">Lapor</a></li>
            </ul>
        </div>
    </div>
</section>
<section style="margin-top:30px" class="white-wrapper nopadding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="notifikasi_aduan" class="validasi"></div>
            </div>
        </div>
    </div>
    <div class="container hide_after_sent_form">
        <div class="row">
            <div class="col-md-12">
                <embed src="https://ulas.surakarta.go.id/index.php?mod=complain&sub=frameForm&act=view&typ=html&layout=horizontal&oid=151" style="width: 100%; height: 500px;">
            </div>
        </div>
    </div><!-- end container -->
</section><!-- end map wrapper -->