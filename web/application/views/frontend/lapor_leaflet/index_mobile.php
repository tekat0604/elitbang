<style type="text/css">
.reload_lokasi{
    position        : absolute; 
    top             : 53px ; 
    right           : 25px ;  
    cursor          : pointer;  
    z-index         : 99999999999
}
.custom-file {
    position: relative;
    display: inline-block;
    width: 100%;
    height: 34px;
    margin-bottom: 0;
}
.empty_map{
    padding         : 10px;
    border          : 1px solid #ff0000;
    animation       : fade 1s infinite alternate;
}
.empty_map:hover:before{ 
    box-shadow: 0 0 15px #000;
    filter: blur(3px);
    transform: scale(1.2);
}
.empty_map:hover{ 
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
 
<section style="margin-top:30px" class="white-wrapper nopadding">   
    <div class="container">  
        <div class="row">
            <div class="col-md-12">  
                <div id="notifikasi_aduan" class="validasi"></div>
            </div>
        </div>
    </div>
    <div class="container hide_after_sent_form">   
        
        <div class="clearfix"></div>
        <div class="general-title">
            <h2>Halaman Aduan / Laporan</h2>
            <hr>
            <p class="lead">Lengkapi isian di bawah ini:</p>
        </div>   
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="label">Tentukan Lokasi </label> 
                </div>
                <div id="reload_lokasi" class="reload_lokasi"> 
                    <button type="button" class="btn btn-danger glow"> <i class="fa fa-map-marker-alt" ></i>  Lokasi Anda </button>
                </div>
                <div class="" id="map" style="z-index:1; width: 100%; height: 500px;"></div>
                <div class="slider-shadow hide-this-on-mobile"></div>
            </div> 
        </div>

        
        <div class="row">
            <div class="col-md-12">   
                
                <form id="form_pengiriman_aduan" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group" style='margin-bottom: 0px;'>
                            <label for="label"> Latitutude</label>
                            <input type="text" id="latitude" name="lat" value="<?= @set_value('lat')?>" 
                            class="form-control" placeholder="Latitutude" readonly="" >  
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group" style='margin-bottom: 0px;'>
                            <label for="label"> Longitude</label>
                            <input type="text" id="longitude" name="lng" value="<?= @set_value('lng')?>" 
                            class="form-control" placeholder="Longitude" readonly="" >  
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div id='error_koordinat' class="validasi"></div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">    
                        <div class="form-group">
                            <label for="label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama *)" 
                            value="<?= @set_value('nama')?>" > 
                            <div id='error_nama' class="validasi"></div> 
                        </div>
                        <div class="form-group">
                            <label for="label"> Email </label> 
                            <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email *)" 
                            value="<?= @set_value('email')?>" >
                            <div id='error_email' class="validasi"></div>
                        </div>
                        <div class="form-group">
                            <label for="label"> Nomor HP / WhatsApp  </label> 
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor HP / WhatsApp *)" 
                            value="<?= @set_value('no_hp')?>"> 
                            <div id='error_no_hp' class="validasi"></div>
                        </div>
                        <div class="form-group">
                            <label for="label"> Subjek </label> 
                            <input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subjek *)" 
                            value="<?= @set_value('subjek')?>">   
                            <div id='error_subjek' class="validasi"></div>
                        </div> 
                        <div class="form-group">
                            <label for="label"> Kategori Bencana </label> 
                            <select class="form-control" id="kategori" name="kategori" placeholder="Kategori Bencana">
                                <?php foreach($kategori as $row){?>
                                <option value="<?= $row['id'].'|'.$row['nama_kategori_bencana']?>"><?= $row['nama_kategori_bencana']?></option>
                                <?php } ?>
                            </select> 
                            <div id='error_kategori' class="validasi"></div>
                        </div>
                    </div>
                    <div class="col-md-6">   

                        <div class="form-group">
                            <label for="label"> Lokasi </label> 
                            <input type="text" name="lokasi" id="lokasi" class="form-control" 
                            placeholder="Lokasi *)" value="<?= @set_value('lokasi')?>"> 
                            <div id='error_lokasi' class="validasi"></div>
                        </div>
                        <div class="form-group">
                            <label for="label"> Detail lokasi </label> 
                            <input type="text" name="lokasi_detail" id="lokasi_detail" class="form-control" 
                            placeholder="Detail lokasi / keterangan tambahan (optional)" value="<?= @set_value('lokasi_detail')?>">
                        </div> 
                        <div class="form-group">
                            <label for="label"> Pesan </label> 
                            <textarea class="form-control" name="pesan" id="pesan" rows="6" placeholder="Pesan *)"  ><?= @set_value('pesan')?></textarea> 
                        </div> 

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="nama">Upload Gambar <i class="text-danger" style="margin-left: 110px; font-weight: normal;">Ukuran Terbaik 1679 x 790 px</i> </label> 
                                <div id="tambah_image_preview_container" class="form-group" style="width: 200px; height: auto; overflow:hidden;line-height: auto;border:1px solid #dddddd; background-color:#ffffff"> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="tambah_image" name="image" 
                                    accept="image/*">
                                    <label id="tambah_image_label" class="custom-file-label" for="tambah_image">
                                    Silahkan pilih file...</label>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="label">Kode Captcha</label> 
                             <p id="captcha_img"><?= @$image;?></p>  
                             <input class="form-control" type='text' name='captcha' 
                             id='captcha' placeholder="Masukkan Kode Captcha *)" > 
                            <div id='error_captcha' class="validasi"></div> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">   
                        <button type="submit" value="SEND" id="btn-submit" class="btn btn-lg btn-primary pull-right">
                        KIRIM LAPORAN <i></i></button>
                    </div>
                </div> 
                <hr> 
                <p style="margin-bottom: 50px;"> &nbsp; </p>
                </form> 
            </div> 
        </div> 
    <div class="clearfix"></div> 
    </div><!-- end container -->
</section><!-- end map wrapper -->