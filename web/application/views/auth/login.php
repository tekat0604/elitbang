<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Sistem Perekonomian Kota Surakarta</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/front/img/favicon.png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url() ?>assets/front/fonts/iconfont/material-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/css/shortcodes/shortcodes.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/css/shortcodes/login.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/front/style.css" rel="stylesheet">
</head>
<style>
.box {
    max-width: 350px;
    padding: 32px 35px 0px 35px;
    border: 1px solid #EEE;
}
#captcha_img img {
    max-width: 264px !important;
}
</style>

<body>
    <main>
        <center style="margin-top: 60px;">
            <img class="responsive-img" style="width: 50px; padding-top: 10px; padding-bottom: 10px;" 
            src="<?php echo base_url() ?>assets/img/logo_surakarta.png" />
            <h5 class="indigo-text">Silakan masuk menggunakan akun anda</h5>
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row box" style="margin-bottom: 100px">
                    <form class="col s12" action="<?php echo base_url('auth/login/auth') ?>" method="POST">
                        <?php echo ($this->session->flashdata('msg') == '' ? '' : $this->session->flashdata('msg')); ?>
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='username' id='username' />
                                <label for='username'>Username</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Password</label>
                            </div>
                        </div>
                        <div class="form-group captcha row">
                            <div class="col-12">
                                <p id="captcha_img"><?=$image;?></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="captcha">Kode Captcha</label> <a href="#" onclick="ref();" class="float-right ref"><i class="fa fa-refresh"></i> Refresh</a>
                            <input type="text" class="form-control" id="captcha" placeholder="Masukkan Kode Captcha" name="captcha" autocomplete="off" required>
                        </div>
                        <br />
                        <center>
                            <div class='row' style="padding: 20px;">
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect  red accent-4'>Login</button>
                            </div>
                            <div style="margin-bottom:30px">
                                <a href="<?=base_url()?>"><i class="fa fa-home" style="font-size:larger"></i> Kembali</a>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </center>
    </main>
    <!-- <div id="preloader">
        <div class="preloader-position">
            <img src="<?php echo base_url() ?>assets/front/img/logo-bappeda-dark.png" alt="logo">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div> -->
    <script src="<?php echo base_url() ?>assets/front/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/materialize/js/materialize.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/menuzord.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jquery.sticky.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/smoothscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/jquery.stellar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/imagesloaded.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/animated-headline.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/scriptsae52.js?v=5"></script>
    <script>
    function ref(){
        $.ajax({
        type : "POST",
        url  : "<?php echo base_url('auth/login/change_captcha')?>",
        dataType : "JSON",
            success: function(response){
                $("#captcha_img").html(response);
            }
        });
        return false;
    }
    </script>
</body>

</html>