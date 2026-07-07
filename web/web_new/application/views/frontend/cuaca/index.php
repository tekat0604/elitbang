<!-- 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <body data-mobile-nav-style="classic"> -->

    
        
        <!-- start page title -->
<section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>/images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
    <div class="overlay-hero"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center small-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                    <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Cuaca</h1>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- end page title -->
    
    <section class="white-wrapper">
        <div class="container">
            <div id="content">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="general-title">
                        <h4 style="color: #e98024; font-weight: 300;"> INFORMASI CUACA</h4>
                        <hr>
                        <p style="color: #2a3052; font-size: 20px; margin-top: 20px; margin-bottom: 30px ; font-weight: 600;"> Informasi Cuaca yang ada di Kota Surakarta</p>
                    </div>
                         <div>
                             <?php $this->load->view('frontend/cuaca/prakiraan', $prakiraan) ?>
                            </div>
                         <div> &nbsp; </div>
                         <div>
                             <p style="color: #444; font-size: 18px; font-weight: 600; text-align: center;
                                   "><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Sumber : BMKG</p>
                         </div>
                        </div>

                        <br>
                        <div class="next_prev text-left">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left" ></i> Kembali</a>
                    </div>
            </div>
        </div>
    </section>
    

</body>
</html>