<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
                
        <div class="block block-themed">
            <div class="block-header bg-gd-sun">
                <h3 class="block-title">Data Website</h3>
                <!-- <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-opd"><i class="fa fa-plus"></i> Tambah OPD</button> -->
            </div>
            <div class="block-content">
                <div class=" table-responsive">  
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th style="text-align: left">Nama Sistem</th>
                                <th style="text-align: center">Logo Header</th>
                                <th style="text-align: center">Logo Footer</th>
                                <th style="text-align: left;">Alamat</th>
                                <th style="text-align: left;">Nomor Telpon</th>
                                <th style="text-align: left;">Email</th>
                                <th style="text-align: left;">Text Footer</th>
                                <th style="text-align: center;width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<form id="form_website" enctype="multipart/form-data">
<div class="modal fade" id="modal-website" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Web</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- content -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <input type="hidden" name="id">
                    <div class="form-group row">
                        <label class="col-12" for="nama_sistem">Nama Sistem</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="nama_sistem" name="nama_sistem" placeholder="Masukkan nama sistem">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="logo_header">Logo Header</label>
                        <div class="col-md-12">
                            <img src="" id="logo_header" style="width: 30%">
                            <input class="form-control" type="file" id="logo_header" name="logo_header"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="logo_footer">Logo Footer</label>
                        <div class="col-md-12">
                            <img src="" id="logo_footer" style="width: 30%">
                            <input class="form-control" type="file" id="logo_footer" name="logo_footer"> 
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="alamat">Alamat</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="nomor_telpon">Nomor Telpon</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" placeholder="Masukkan nomor telpon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="email">Email</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="email" name="email" placeholder="Masukkan nomor telpon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="text_footer">Text Footer</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="text_footer" name="text_footer" placeholder="Masukkan text footer">
                        </div>
                    </div>
                    
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-opd">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- END Pop In Modal -->