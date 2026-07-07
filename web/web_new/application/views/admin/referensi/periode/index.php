<style>
.container-fluid{
    padding:0px 0px 10px 0px;
}
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content"> 
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Referensi Periode</h3>
                <button type="button" class="btn btn-secondary tambah_periode" style="margin-bottom:10px;" data-toggle="modal" data-target="#modal-periode"><i class="fa fa-plus"></i> Tambah Periode</button>
            </div>
            <div class="block-content">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th style="width:10px;">No</th>
                            <th style="text-align: center">Periode</th>
                            <th style="text-align: center;width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->
<!-- Pop In Modal -->
<form id="form_periode">
<div class="modal fade" id="modal-periode" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title label_from">Tambah Periode</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- content --> 
                    <input type="hidden" id="id_periode" name="id_periode">
                    <div class="form-group row">
                        <label class="col-12" for="periode">Periode</label>
                        <div class="col-md-12">
                            <input required type="text" class="form-control" id="periode" name="periode" placeholder="Masukkan Tahun/Periode">
                        </div>
                    </div>
                    <!-- end content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-alt-success btn-ubah-periode">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- END Pop In Modal -->