<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Data PPID</h3>
                <button type="button" class="btn btn-secondary" id="tambah_data" style="margin-bottom:10px;" data-toggle="modal" data-target="#formModalTambah">
                    <i class="fa fa-plus"></i> Tambah PPID</button>
            </div>
            <div class="block-content">
                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th> File </th>
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