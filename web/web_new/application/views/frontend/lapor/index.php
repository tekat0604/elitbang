<style type="text/css">
#pac-input{
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-top: 12px;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 400px;
    height: 38px;
    border-radius: 10px;
}

#pac-input:focus {
    border-color: #e87a37;
    border-radius: 10px;
}
@media (max-width: 767px){
    #pac-input {
        position            : absolute!important;
        top                 : 50px!important;
        left                : 0px!important;
        width               : 94%;
    }
    #pac-input:focus {
        border-color: #e87a37; 
    }
}
</style>
<?php $get_profil_website = get_profil_website(); ?>
<section class="post-wrapper-top jt-shadow clearfix">
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
    <!-- <div id="map"></div> -->
<!--    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15820.841980739278!2d110.8024302!3d-7.5520116!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf2e4517f78cb774e!2sKantor%20BPBD%20Kota%20Surakarta!5e0!3m2!1sen!2sid!4v1584949705661!5m2!1sen!2sid" width="100%" height="450px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
        <input id="pac-input" class="controls" type="text" placeholder="Pencarian Lokasi">
    
    
    <div class="container">
        <?php if(@$this->session->flashdata('success')){ ?>
        <div class="general-title">
            <?= $this->session->flashdata('success');?>
        </div><hr>
        <?php } else if(@$this->session->flashdata('failed')){ ?>
        <div class="general-title">
            <?= $this->session->flashdata('failed');?>
        </div><hr>
        <?php } ?>
        
    <div class="" id="map_canvas" style="z-index:1; width: 100%; height: 500px;"></div>
    <div class="slider-shadow hide-this-on-mobile"></div>
    <div class="clearfix"></div>
    <div class="general-title">
        <h2>Halaman Aduan / Laporan</h2>
        <hr>
        <p class="lead">Lengkapi isian di bawah ini:</p>
    </div>  
    <div class="contact_form">
    <div id="message"></div>
        <form id="laporform" action="<?= base_url('processing/save_lapor')?>" name="laporform" method="post" enctype="multipart/form-data">
            <input type="hidden" id="lat" name="lat" value="<?= @set_value('lat')?>" required>
            <input type="hidden" id="lng" name="lng" value="<?= @set_value('lng')?>" required>
            <div class="row"> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama *)" value="<?= @set_value('nama')?>" required> 
                    <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email *)" value="<?= @set_value('email')?>" required>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor HP / WhatsApp *)" value="<?= @set_value('no_hp')?>" required> 
                    <input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subjek *)" value="<?= @set_value('subjek')?>" required>  
                    <select class="form-control" id="kategori" name="kategori" placeholder="Kategori Bencana">
                        <?php foreach($kategori as $row){?>
                        <option value="<?= $row['id'].'|'.$row['nama_kategori_bencana']?>"><?= $row['nama_kategori_bencana']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi silakan klik atau cari pada peta *)" value="<?= @set_value('lokasi')?>" readonly required> 
                    <input type="text" name="lokasi_detail" id="lokasi_detail" class="form-control" placeholder="Detail lokasi / keterangan tambahan (optional)" value="<?= @set_value('lokasi_detail')?>">
                    <input type="file" name="image" id="image" class="form-control" placeholder="Gambar" accept="image/*">
                    <textarea class="form-control" name="pesan" id="pesan" rows="7" placeholder="Pesan *)" 
                    required style="height: 133px!important;"><?= @set_value('pesan')?></textarea> 
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12"> 
                    <hr>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" value="SEND" id="btn-submit" class="btn btn-lg btn-primary pull-right">
                    KIRIM LAPORAN <i></i></button>
                </div> 
            </div>
        </form>    
    </div><!-- end contact-form -->
    
    <div class="clearfix"></div>
    
    <div class="row padding-top margin-top">
        <div class="contact_details">
            
            <div class="col-lg-3 col-sm-3 col-md-6 col-xs-6">
                <div class="text-center">
                    <div class="wow swing">
                        <div class="contact-icon">
                            <a href="tel:027156545614" target="_blank" class=""> <i class="fa fa-phone fa-3x"></i> </a>
                        </div><!-- end dm-icon-effect-1 -->
                         <p><strong>Telepon: </strong> <?php echo $get_profil_website->telepon; ?> </p>
                    </div><!-- end service-icon -->
                </div><!-- end miniboxes -->
            </div><!-- end col-lg-4 -->  

            <div class="col-lg-3 col-sm-3 col-md-6 col-xs-6">
                <div class="text-center">
                    <div class="wow swing">
                        <div class="contact-icon">
                            <a href="mailto:bpbdsurakarta@go.id" target="_blank" class=""> <i class="fa fa-envelope fa-3x"></i> </a>
                        </div><!-- end dm-icon-effect-1 -->
                         <p><strong>Email: </strong> <?php echo $get_profil_website->email; ?></p>
                    </div><!-- end service-icon -->
                </div><!-- end miniboxes -->
            </div><!-- end col-lg-4 -->

            <div class="col-lg-3 col-sm-3 col-md-6 col-xs-6">
                <div class="text-center">
                    <div class="wow swing">
                        <div class="contact-icon">
                            <a href="https://goo.gl/maps/pCmspfkK2iCpsvnv5" target="_blank" class=""> <i class="fa fa-map-marker-alt fa-3x"></i> </a>
                        </div><!-- end dm-icon-effect-1 -->
                         <p> <?php echo $get_profil_website->alamat; ?></p>
                    </div><!-- end service-icon -->
                </div><!-- end miniboxes -->
            </div><!-- end col-lg-4 -->

            <div class="col-lg-3 col-sm-3 col-md-6 col-xs-6">
                <div class="text-center">
                    <div class="wow swing" onclick="go_to('<?= base_url('daftar_laporan')?>')">
                        <div class="contact-icon">
                            <a href="javascript:;" class=""> <i class="fa fa-file-alt fa-3x"></i> </a>
                        </div><!-- end dm-icon-effect-1 -->
                         <p> Daftar Laporan / Aduan</p>
                    </div><!-- end service-icon -->
                </div><!-- end miniboxes -->
            </div><!-- end col-lg-4 -->                  
        </div><!-- end contact_details -->
    </div><!-- end margin-top --><br><br>
    </div><!-- end container -->
</section><!-- end map wrapper -->