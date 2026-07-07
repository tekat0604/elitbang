<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"> Data Kejadian Bencana Form A3 </h3>
                <a href="<?= $link_url ?>tambah" class="btn btn-secondary" style="margin-bottom:10px;">
                    <i class="fa fa-plus"></i> Tambah Data Form A3
                </a>
            </div>
            <div class="block-content">
                <div class="table-responsive m-t-20">
                    <table id="table_data" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th style="width: 250px;"> Pelapor </th>
                                <th style="width: 300px;"> Kejadian </th>
                                <th style="width: 330px;"> Waktu Kejadian </th>
                                <th style="text-align: center;"> Aksi </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>