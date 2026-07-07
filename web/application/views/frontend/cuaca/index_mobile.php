    <section class="white-wrapper">
        <div class="container">
            <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 0;">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
                            <div class="doc">
                                <div id="custom_tab" class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-map" style="padding-right: 10px;"></i>Peta Himawari</a></li>
                                        <li class=""><a href="#tab2" data-toggle="tab" style="display: none;"><i class="fa fa-map" style="padding-right: 10px;"></i>Peta Sukoharjo</a></li>
                                        <li class=""><a href="#tab3" data-toggle="tab"><i class="fa fa-map" style="padding-right: 10px;"></i>Cuaca Sukoharjo</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <!-- <iframe scrolling="yes" src="https://dataweb.bmkg.go.id/Satelit/IMAGE/HIMA/H08_EH_Jateng.png?id=050353u4hyxecb37bhp70vj" style="width: 100%; min-height: 1000px;/*border: 0px none; margin-left: -80px; min-height: 1450px; margin-top: -350px; width: 1176px;*/"> </iframe>  -->
                                           <img style="max-width: 100%;display:block;height:auto" src="https://dataweb.bmkg.go.id/Satelit/IMAGE/HIMA/H08_EH_Jateng.png?id=54639isojb863v4250605nf" alt="">
                                        </div>
                                        <div class="tab-pane" id="tab2" style="display: none;">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126564.62864268977!2d110.74877151079268!3d-7.55920341723655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16627ad11ab1%3A0xe7fe4e0454bc3095!2sSurakarta%2C%20Surakarta%20City%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1584956254196!5m2!1sen!2sid" width="100%" height="712" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <!--<iframe scrolling="no" src="https://www.bmkg.go.id/cuaca/prakiraan-cuaca.bmkg?Kota=Surakarta&AreaID=501266&Prov=11" style="border: 0px none; margin-left: -80px; min-height: 1450px; margin-top: -350px; width: 1176px;"> </iframe>-->
                                            <?php $this->load->view('frontend/cuaca/prakiraan',$prakiraan)?>
                                            <strong style="color: blue;">Sumber: BMKG</strong>
                                        </div>
                                    </div><!-- end tab-content -->
                                </div><!-- end tabbable -->
                            </div>
                        </div><!-- end col-lg-12 -->
                    </div><!-- end blog-masonry -->
                </div><!-- end row --> 
            </div><!-- end content -->
        </div>
    </section>
    <!-- Content END-->