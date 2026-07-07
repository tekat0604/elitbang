<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>

<!-- Main Container -->
<main id="main-container">
    <div class="content" style="padding-top: 0px;">
        <h2 class="content-heading" style="padding-top: 0px;padding-bottom: 0px;"><?= @$data->subjek?></h2> 
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Kategori Laporan: <?= strtoupper(@$data->kategori)?></h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-danger btn_ubah" onclick="go_to('<?= base_url('admin/lapor')?>')">
                        <i class="fa fa-chevron-left"></i> Back
                    </button>
                </div>
            </div>
            <div class="block-content">
            <form id="form_pesan" action="<?= base_url('admin/lapor/send_reply')?>" method="post">
                <input type="hidden" name="id_lapor" value="<?= @$data->id_lapor; ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <label class="col-12" for="nama"><?= @$data->nama.' - <small>'.@$data->no_hp.', '.@$data->email.'</small>'?><br>
                        <small><i>(<?= @$data->lokasi?>)</i></small>
                    </label>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-12"><div id="map" style="width: 100%; height: 400px;"></div></div>
                </div>
                
                <div class="form-group row">
                    <label class="col-12" for="pesan">Gambar</label>
                    <div class="col-md-12">
                        <?php if(is_file('./uploads/lapor/'.$data->gambar)){?>
                        <img style="max-width: 100%;" src="<?= base_url('uploads/lapor/'.$data->gambar)?>">
                        <?php } else{?>
                        <small style="color: red;"><i>Pelapor tidak mengupload gambar.</i></small>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-12" for="pesan">Detail Lokasi / Keterangan Tambahan</label>
                    <div class="col-md-12">
                        <input style="background-color: #fff;" class="form-control" id="lokasi_detail" value="<?= @$data->lokasi_detail?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row" <?= $can_reply==false?'style="margin-bottom: 0;"':''?>>
                    <label class="col-12" for="pesan">Isi Pesan
                        <?= @$data->created!=null?'<small>(Diterima pada: '.tgl_indo($data->created, true).')</small>':''?>
                    </label>
                    <div class="col-md-12">
                        <textarea style="background-color: #fff;" class="form-control" id="pesan" cols="30" rows="5" readonly><?= @$data->pesan?></textarea>
                    </div>
                </div>
                
                <?php if($can_reply==true){?>
                <div class="form-group row">
                    <label class="col-12" for="balasan"><span style="color: red;">*)</span> Balasan 
                        <?= @$data->created_balasan!=null?'<small>(Terakhir dikirim: '.tgl_indo($data->created_balasan, true).')</small>':''?>
                    </label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="balasan" name="balasan" cols="30" rows="5" placeholder="Tuliskan balasan Anda di sini. Balasan akan dikirim ke email pengadu" required><?= @$data->balasan?></textarea>
                    </div>
                </div>
                <?php } else{ ?>
                <small style="color: red;"><i>Pelapor tidak mencantumkan email.</i></small>
                <?php } ?>
                
                <div class="form-group row panel-button">
                    <div class="col-12">
                        <button type="button" class="btn btn-alt-default float-right btn_batal" onclick="go_to('<?= base_url('admin/lapor')?>')">
                            <i class="fa fa-close mr-5"></i> Batal
                        </button>
                        <?php if($can_reply==true){?>
                        <button type="submit" class="btn btn-alt-info float-right btn_simpan" id="btn-simpan" style="margin-right:10px;">
                            <i class="fa fa-send mr-5"></i> Kirim Balasan
                        </button>
                        <?php } ?>
                    </div>
                </div>
            </form>
            </div>
        </div>
        
    </div>
</main>
<!-- END Main Container -->
