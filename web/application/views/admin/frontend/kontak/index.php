<!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm text-left" style="background-image:url(<?= base_url('assets_frontend/images/phone.jpg') ?>); background-size: cover; background-position: bottom center; background-repeat: no-repeat;">
            <div class="container">
                <div class="dlab-bnr-inr-entry text-white">
                    <h1>Kontak Kami  </h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-block">
            <div class="section-full content-inner bg-white contact-form style2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-head">
                                <h2>Untuk Informasi Lebih Lanjut <br>Hubungi Kami</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-md-6 m-b30">
                                    <div class="m-b30">
                                        <img class="content-img img-move2" src="<?= base_url() ?>assets_frontend/images/contect/pic1.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 m-b30">
                                    <div class="contect-info m-b15">
                                        <div class="icon-content">
                                            <h4 class="dlab-title m-b5">Alamat</h4>
                                            <p>Surakarta</p>
                                        </div>
                                    </div>
                                    <div class="contect-info">
                                        <div class="icon-content">
                                            <h4 class="dlab-title m-b5">Phone</h4>
                                            <p>(+0271) 616481</p>
                                        </div>
                                    </div>
                                    <div class="contect-info">
                                        <div class="icon-content">
                                            <h4 class="dlab-title m-b5">Email</h4>
                                            <p>surakarta@go.id</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 m-b30 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                            <div class="contact-box shadow">
                                <div class="dzFormMsg"></div>
                                <form method="post" class="dzForm col-md-12" action="script/contact.php">
                                    <input type="hidden" value="Contact" name="dzToDo">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row sp10 form-group">
                                                <div class="col-lg-12 col-md-12">
                                                    <label>Name* </label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="dzName" type="text" required="" class="form-control" placeholder="First Name" _vkenabled="true">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input name="dzName" type="text" required="" class="form-control" placeholder="Last Name" _vkenabled="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email Address*  </label>
                                                <input name="dzEmail" type="email" class="form-control" required="" placeholder="Email" _vkenabled="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row sp10 form-group">
                                                <div class="col-lg-12 col-md-12">
                                                    <label>Phone* </label>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <input name="dzPhone" type="text" required="" class="form-control" placeholder="###" _vkenabled="true">
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <input name="dzPhone" type="text" required="" class="form-control" placeholder="###" _vkenabled="true">
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <input name="dzPhone" type="text" required="" class="form-control" placeholder="###" _vkenabled="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Subject* </label> 
                                                <input name="dzSubject" type="text" required="" class="form-control" placeholder="Subject" _vkenabled="true">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Message* </label> 
                                                <textarea name="dzMessage" rows="4" class="form-control" required="" placeholder="Message" _vkenabled="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN&amp;co=aHR0cDovL3BhdGEuZGV4aWdubGFiLmNvbTo4MA..&amp;hl=en&amp;v=n1ZaVsRK4TYyiKxYab0h8MUD&amp;size=normal&amp;cb=91he9yvmmg7g" width="304" height="78" role="presentation" name="a-1wvx0n7iwpfz" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div></div>
                                                <input class="form-control d-none" style="display:none;" data-recaptcha="true" required="" data-error="Please complete the Captcha" _vkenabled="true">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button name="submit" type="submit" value="Submit" class="btn radius-xl gradient-primary btn-lg">SEND<span></span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action -->
            <div class="section-full call-action-one gradient-two text-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                            <h5>Check out our newest and most popular digital branding programs</h5>
                        </div>
                        <div class="col-lg-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.8s">
                            <a href="#" class="btn-link float-right white">Check Programs<i class="fa fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action end -->
        </div>
    </div>
    <!-- Content END-->