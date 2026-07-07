     <section class="blog-wrapper">
        <div class="container">
            <div id="content" class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="blog-masonry">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="buttons text-left">
                                    <a href="<?= $_SERVER['HTTP_REFERER']?>" class="btn btn-primary btn-md" 
                                    title=""> <i class="fa fa-arrow-left"></i> Kembali  </a>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-carousel">
                                    <div class="entry">
                                    <?php 
                                        if($row->gambar!='' && $row->gambar!=null){
                                            $img ='<img src="'.base_url('uploads/lapor/'.$row->gambar).'" alt="" 
                                            class="img-responsive" draggable="false">';
                                        }else{
                                            $img ='';
                                        }
                                        echo $img;
                                    ?> 
                                    </div>
                                    <div class="blog-carousel-header">
                                        <h1><?= $row->subjek?></h1>
                                        <?php $explode_datetime = explode(' ',$row->created);
                                        $date = tgl_indo($explode_datetime[0]);
                                        $time = substr($explode_datetime[1],0,5);?>
                                        <div class="blog-carousel-meta">
                                            <span><i class="fa fa-calendar-alt"></i> <?= $date?></span>
                                            <span><i class="fa fa-phone-alt"></i> <a><?= substr($row->no_hp,0,9).'xxx'?></a></span>
                                            <!--<span><i class="fa fa-eye"></i> <a href="#">84 Views</a></span>-->
                                            <span><i class="fa fa-user"></i> <a><?= $row->nama?></a></span>
                                        </div>
                                    </div>
                                    <div class="blog-carousel-desc">
                                    <h4 style="padding-bottom: 0px; margin-bottom: 0px;"> Lokasi : </h4>
                                    <p class="justify" style="border-bottom: 1px solid #ddd;">  <?= $row->lokasi?></p> 
                                    <h4 style="padding-bottom: 0px; margin-bottom: 0px;"> Pesan : </h4> 
                                    <p class="justify" style="border-bottom: 1px solid #ddd;">Pesan : <?= $row->pesan?></p>
                                </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="widget">
                                    <div class="title">
                                        <h3>Lokasi</h3>
                                    </div>
                                    <div id="map" style="width: 100%; height: 350px;"></div>
                                </div> 
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div> 
        </div>
    </section>
