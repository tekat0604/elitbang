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
                <h3 class="block-title">Data Korban Bencana</h3>
                <a href="<?php echo base_url('admin/korban_bencana/tambah');?>" class="btn btn-secondary" style="margin-bottom:10px; color: #333;" >
                <i class="fa fa-plus"></i> Tambah Korban Bencana</a>
            </div>  
            <div class="block-content">
                <div class="row mb-3">
                    <div class="col-md-3 mb-2">
                        <select class="select2-size-lg form-control" name="id_kategori" id="filter_kategori" >
                            <option value="">Kategori Bencana</option> 
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                    <select class="select2-size-lg form-control" name="id_kecamatan" id="filter_kecamatan" onchange="getKelurahan(this)">
                            <option value="">Pilih Kecamatan</option> 
                        </select>      
                    </div>
                    <div class="col-md-3 mb-2">
                        <select class="select2-size-lg form-control" name="id_kelurahan" id="filter_kelurahan" >
                            <option value="">Pilih Keluaran</option> 
                        </select>      
                    </div>
                    <div class="col-md-3 mb-2">
                        <button class="btn btn-success" style="display: none; ">Cetak</button>
                    </div>
                </div>
                 
                <div class="row js-appear-enabled animated fadeIn" data-toggle="appear" 
                id="data_jumlah_semua_korban_bencana">
                </div>
                <div class="row js-appear-enabled animated fadeIn" data-toggle="appear" 
                id="data_jumlah_kategori_bencana">
                </div>
                
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Profil</th> 
                                <th>Thumbnail</th> 
                                <th>Alamat</th> 
                                <th>Kategori</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->