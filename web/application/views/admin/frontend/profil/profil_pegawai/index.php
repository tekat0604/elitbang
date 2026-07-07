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
                <h3 class="block-title">Data Profil Pegawai</h3>
                <button type="button" class="btn btn-secondary" id="tambah_data" 
                style="margin-bottom:10px;" data-toggle="modal" data-target="#formModalTambah">
                <i class="fa fa-plus"></i> Tambah Informasi Profil Pegawai</button>  
            </div>  
            <div class="block-content">
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th> 
                                <th>NIP</th> 
                                <th>Nama</th>  
                                <th>Tempat & Tgl Lahir</th>  
                                <th>Jabatan</th>  
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>  
                    </table>
                </div>
            	
            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->