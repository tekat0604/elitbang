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
                <h3 class="block-title">Identitas Informasi</h3> 
            </div>
            <div class="block-content">
                <div class=" table-responsive">
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th style="text-align: left">Judul</th> 
                                <th style="text-align: left">Deskripsi</th>
                                <th style="text-align: center;width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
        <div class="block block-themed">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Atribut Informasi</h3> 
                <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-data-atribut"><i class="fa fa-plus"></i> Tambah Atribut</button>
            </div>
            <div class="block-content">
                <div class="row col-md-12">
                    <div class="table-responsive col-md-5">
                        <table class="table table-striped" id="mydata_atribut">
                            <thead>
                                <tr>
                                    <th style="width:10px;">No</th>
                                    <th style="text-align: left">Nama</th>
                                    <th style="text-align: center;width:100px;">Tampil</th>
                                    <th style="text-align: center;width:100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="show_data_atribut">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive col-md-7">
                        <div id="container" style="width:100%; height:400px;"></div>
                    </div>
                </div>
                
                
            </div>
        </div> 
        <div class="block block-themed">
            <div class="block-header bg-gd-sea">
                <h3 class="block-title">Detail Data Informasi</h3> 
                <button type="button" class="btn btn-secondary btn-square" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-data-detail"><i class="fa fa-plus"></i> Tambah Detail Data</button>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped" id="mydata_detail">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th style="text-align: left">Nama Atribut</th>
                                <th style="text-align: left">Tahun</th>
                                <th style="text-align: left">Nilai</th>
                                <th style="text-align: center;width:100px;">Tampil</th>
                                <th style="text-align: center;width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_data_detail">
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>        
    </div> 
</main>


<!-- END Main Container --> 

<!-- Pop In Modal -->
<form id="form_data_atribut" enctype="multipart/form-data">
<div class="modal fade" id="modal-data-atribut" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Atribut</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- content -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <input type="hidden" name="id_atribut">
                    <input type="hidden" name="id_data" value="<?= $this->uri->segment(5) ?>">
                    <div class="form-group row">
                        <label class="col-12" for="nama">Nama Atribut</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="nama_atribut" name="nama" placeholder="Masukkan nama atribut">
                        </div>
                    </div> 
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-data">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form> 
<!-- END Pop In Modal -->

<!-- Pop In Modal -->
<form id="form_data_detail" enctype="multipart/form-data">
<div class="modal fade" id="modal-data-detail" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Detail Data</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- content -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <input type="hidden" name="id_detail">
                    <div class="form-group row">
                        <label class="col-12" for="id_atribut">Atribut</label>
                        <div class="col-md-12">
                            <select required="" style="width: 100%" class="form-control" id="id_atribut" name="id_atribut"></select> 
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="tahun">Tahun</label>
                        <div class="col-md-12">
                            <input required type="number" class="form-control" id="tahun" name="tahun" min="0" max="2100">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-12" for="nilai">Nilai</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="nilai" name="nilai" min="0">
                        </div>
                    </div> 
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-data">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form> 
<!-- END Pop In Modal -->