<style>
    #pac-input {
        position            : absolute!important;
        top                 : 60px!important;
        left                : 10px!important;
        background-color    : #fff;
        font-family         : Roboto;
        font-size           : 15px;
        font-weight         : 300; 
        padding             : 0 11px 0 13px;
        text-overflow       : ellipsis;
        width               : 93%;
        height              : 38px;
        border-radius       : 10px;
      }

      #pac-input:focus {
        border-color: #e87a37; 
      }
      #pac-input:visited {
        border-color: #ff0000; 
      }
</style>

<section class="white-wrapper nopadding">
    <input id="pac-input" class="controls" type="text" placeholder="Pencarian Lokasi">
    <div class="" id="map_canvas" style="width: 100%; height: 450px;"></div>
    <div class="clearfix"></div>
    <div class="container">
    <div class="general-title">
        <h2>Form Aduan / Laporan</h2>
        <hr>
        <p class="lead">Lengkapi isian di bawah ini:</p>
        <?php 
        if(@$this->session->flashdata('success')){
            echo $this->session->flashdata('success');
        } else if(@$this->session->flashdata('failed')){
            echo $this->session->flashdata('failed');
        }
        ?>
    </div>  
    <div class="contact_form">
    <div id="message"></div>
        <form id="laporform" action="<?= base_url('processing/save_lapor_mobile')?>" name="laporform" method="post">
            <input type="hidden" id="lat" name="lat" value="<?= @set_value('lat')?>" required>
            <input type="hidden" id="lng" name="lng" value="<?= @set_value('lng')?>" required>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama *)" 
                    value="<?= @set_value('nama')?>" required> 
                    <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email *)" 
                    value="<?= @set_value('email')?>" required>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor HP / WhatsApp *)" 
                    value="<?= @set_value('no_hp')?>" required> 
                    <input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subjek *)" 
                    value="<?= @set_value('subjek')?>" required>  
                    <select class="form-control" id="kategori" name="kategori" placeholder="Kategori Bencana">
                        <?php foreach($kategori as $row){?>
                        <option value="<?= $row['id'].'|'.$row['nama_kategori_bencana']?>"><?= $row['nama_kategori_bencana']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi silakan klik atau cari pada peta *)" value="<?= @set_value('lokasi')?>" readonly required> 
                    <input type="text" name="lokasi_detail" id="lokasi_detail" class="form-control" placeholder="Detail lokasi / keterangan tambahan (optional)" value="<?= @set_value('lokasi_detail')?>">
                    <input type="file" name="image" id="image" class="form-control" placeholder="Gambar" accept="image/*">
                    <textarea class="form-control" name="pesan" id="pesan" rows="5" placeholder="Pesan *)" required><?= @set_value('pesan')?></textarea>
                </div> 
            </div> 
            <div class="row">  
                <div class="col-md-12">
                    <div style="margin-top: 5px;"> 
                        <button type="submit" value="SEND" id="btn-submit" class="btn btn-lg btn-block btn-primary">KIRIM LAPORAN</button>  
                    </div> 
                </div> 
            </div> 
             <div class="row" style="margin-bottom: 50px;">  
                <hr>
            </div> 
        </form>    
    </div><!-- end contact-form -->
    
    <div class="clearfix"></div> 
    </div><!-- end container -->
</section><!-- end map wrapper -->