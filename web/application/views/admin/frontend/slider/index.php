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
                <h3 class="block-title">Data Slider</h3>
                <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-slider"><i class="fa fa-plus"></i> Tambah Slider</button>
            </div>
            <div class="block-content">
                <div class=" table-responsive">  
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th> 
                                <th style="text-align: left">File</th>  
                                <th style="text-align: center;width:100px;">Tampil</th>
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
<form id="form_slider" enctype="multipart/form-data">
<div class="modal fade" id="modal-slider" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Slider</h3>
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
                        <label class="col-12" for="file">File</label>
                        <div class="col-md-12">
                            <img src="" id="tampil_file" style="width: 30%">
                            <input class="form-control" type="file" id="file" name="file"> 
                        </div>
                    </div>
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-slider">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form>
 
<!-- END Pop In Modal -->