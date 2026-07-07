<html class="no-js" lang="en">
    
    <body data-mobile-nav-style="classic">
        
        <!-- start page title -->
        <section class="parallax py-0" style="background-image: url('<?= base_url('assets_frontend/new_assets/') ?>images/bg-hero.jpg'); background-position-y: 50%; background-repeat: no-repeat;">
            <div class="overlay-hero"></div>
            <div class="container">
                <div class="row justify-content-center align-items-center small-screen">
                    <div class="col-12 col-xl-6 col-lg-7 col-md-10 position-relative page-title-large text-center">
                        <span class="text-white opacity-6 alt-font margin-5px-bottom d-block xs-line-height-20px d-none">Profil</span>
                        <div class="breadcrumb justify-content-center text-white opacity-8-half alt-font margin-5px-bottom d-block xs-line-height-20px">
                            <!-- start breadcrumb -->
                            <ul class="xs-text-center">
                                <li>Dashboard</li>
                                <li><a href="#" class="text-white-hover">Profil</a></li>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                        <h1 class="text-white alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Agenda Kegiatan</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->    
    
    <section class="post-wrapper-top jt-shadow clearfix">
        <div class="container">
            <div class="col-lg-12">
                <h2><?php echo $judul_halaman ?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="javascript:;"><?php echo $judul_halaman ?></a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="blog-wrapper">
        <div class="container">
            <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="blog-masonry"> 
                        <div class="row">  
                        <?php 
                        $no=1; 
                        if($list_data != NULL){
                        foreach(@$list_data as $row){
                            $tanggal = validateDate($row->tanggal) ? tgl_indo($row->tanggal) : '-';
                            if($row->image!='' && $row->image!=null){
                                $img_thumnail = '<img src="'.base_url('uploads/menu/'.$row->image).'" alt="" class="img-responsive">';
                            }else{
                                $img_thumnail = '<img src="'.base_url('assets/img/image_not_found.png').'" alt="" class="img-responsive">';
                            }
                        ?>
                        <div class="col-md-4">
                            <div class="blog-carousel">
                                <div class="entry">
                                    <?php echo $img_thumnail; ?>
                                    <div class="magnifier">
                                        <div class="buttons">
                                            <a class="st" rel="bookmark" href="<?= base_url(''.$halaman.'/detail/'.$row->tanggal.'/'.$row->id)?>">
                                            <i class="fa fa-link"></i> </a> 
                                        </div>
                                    </div>
                                    <div class="post-type">
                                        <i class="fa fa-images"></i>
                                    </div>
                                </div>
                                <div class="blog-carousel-header">
                                    <h3><a title="" href="<?= base_url(''.$halaman.'/detail/'.$row->tanggal.'/'.$row->id)?>"> 
                                        <?= $row->judul?> - <?= date('Y', strtotime($row->tanggal))?>
                                    </a></h3>
                                    <div class="blog-carousel-meta">
                                        <span><i class="fa fa-calendar"></i> <?php echo$tanggal;?></span> 
                                    </div>
                                </div>
                                <div class="blog-carousel-desc">
                                    <?php echo substr(strip_tags($row->konten),0,100); ?> 
                                </div>
                            </div>
                        </div>
                        <?php 
                            if($no % 3==0 ){
                                echo '</div> <div class="row"> ';
                            }
                            $no++;
                        }
                    }else{
                        echo "<h6>" ."<div class=text-center>" . "Belum ada data" . "</h6>";
                    }
                ?>
                    </div><!-- end blog-masonry -->

                    <div class="clearfix"></div>
                    <hr>
                    <?php if($no >= 6  ){ ?>
                            <div class="col-12 d-flex justify-content-center margin-7-half-rem-top md-margin-5-rem-top wow animate__fadeIn">
                                <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center">
                                    <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-left icon-extra-small d-xs-none"></i>
                                </a></li>
                                    <?= @$pagging ?>
                                    <li class="page-item"><a class="page-link" href="#"><i class="feather icon-feather-arrow-right icon-extra-small d-xs-none"></i></a></li>
                                </ul>
                            </div> 
                        <?php }?>
                        
                </div><!-- end row -->
            </div><!-- end content --> 
        </div><!-- end container -->
    </section>
