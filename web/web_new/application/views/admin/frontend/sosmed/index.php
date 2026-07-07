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
                <h3 class="block-title">Data Sosial Media</h3>
                <!-- <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-opd"><i class="fa fa-plus"></i> Tambah OPD</button> -->
            </div>
            <div class="block-content">
                <div class=" table-responsive">  
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th style="text-align: left">Facebook</th> 
                                <th style="text-align: left">Twitter</th> 
                                <th style="text-align: left">Linked In</th> 
                                <th style="text-align: left">Dribbble</th>
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
<form id="form_sosmed" enctype="multipart/form-data">
<div class="modal fade" id="modal-sosmed" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Sosial Media</h3>
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
                        <label class="col-12" for="facebook">Facebook</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="facebook" name="facebook" placeholder="Masukkan link facebook">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="twitter">Twitter</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="twitter" name="twitter" placeholder="Masukkan link twitter">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="linkedin">Linked In</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Masukkan link linked in">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="dribbble">Dribble</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="dribbble" name="dribbble" placeholder="Masukkan link dribble">
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