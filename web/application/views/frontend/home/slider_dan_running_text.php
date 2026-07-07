    <div class="slider-wrapper">
        <div class="tp-banner-container" style="position: relative;">
            <div class="tp-banner" >
                <ul>
                <?php 
                foreach ($slider as $key => $value) {  
                    if($value['image']!='' && $value['image']!=null){
                        $img_slider     = '<img src="'.base_url('uploads/grid_home/'.$value['image'].'').'" 
                        alt="'.$value['judul'].'" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">' ;
                    }else{
                        $img_slider     = '<img src="'.base_url('assets/img/image_not_found.png').'" 
                        alt="'.$value['judul'].'" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">';
                    }
                    if($value['link']!='' && $value['link']!=null){
                        $link_slider    = '<a href="http://'.$value['link'].'" target="_blank" class="btn btn-primary btn-lg">Build now</a>' ;
                    }else{
                        $link_slider    = 'href="#"';
                    }
                ?>
					 
					<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                         <?php echo $img_slider; ?>
                        <?php if($value['judul']!='' && $value['judul']!=null){?>
                        <div class="tp-caption big_title_slider customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="170"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1000"
                            data-start="500"
                            data-easing="Back.easeInOut"
                            data-endspeed="300"> <?php echo $value['judul'];?>
                        </div> 
                        <?php 
                        }
                        ?>
                        <?php if($value['konten']!='' && $value['konten']!=null){?>
                        <div class="tp-caption small_title customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="246"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1300"
                            data-start="800"
                            data-easing="Back.easeInOut"
                            data-endspeed="300"> <?php echo $value['konten'];?>
                        </div>
                        <?php 
                        }
                        ?>

                        <?php if($value['link']!='' && $value['link']!=null){?>
                         <div class="tp-caption small_title customin customout start"
                            data-x="left"
                            data-hoffset="30"
                            data-y="360"
                            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                            data-speed="1600"
                            data-start="1100"
                            data-easing="Back.easeInOut"
                            data-endspeed="300"> <?php echo $link_slider;?> 
                        </div>
                        <?php 
                        }
                        ?>
                       
                    </li> 
                     <?php 
                    }
                    ?>
                </ul>
                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <div class="calloutbox bgprimary" style="margin: 0;padding: 20px 20px 10px 20px;">
            <div class="container">
            <div class="col-lg-2 marque-judul">
                INFORMASI TERKINI:
            </div>
            <div class="col-lg-10">
                <marquee behavior="scroll" direction="left" scrollamount="5">
                <?php 
                foreach ($pesan_singkat as $key => $value) {
                    echo ' '.$value['konten'].' '; 
                }
                ?> 
                </marquee>
            </div>
            </div>
        </div><!-- end messagebox -->
    </div><!-- end slider-wrapper -->
