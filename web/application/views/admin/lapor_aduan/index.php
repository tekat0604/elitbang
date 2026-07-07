<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>
<main id="main-container">
    <div class="content">

        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Data <?= @$title ?> </h3>
            </div>

            <div class="block-content">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="filter_kategori" id="filter_kategori" class="form-control select2">
                            <option value="">All Kategori </option>
                            <?php
                            foreach ($kategori as $dt_kategori) {
                                echo '<option value="' . $dt_kategori->id . '"> ' . $dt_kategori->nama_kategori_bencana . ' </option> ';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="filter_kecamatan" id="filter_kecamatan" class="form-control select2">
                            <option value="">All Kecamatan </option>
                            <?php
                            foreach ($kecamatan as $dt_kecamatan) {
                                echo '<option value="' . $dt_kecamatan->id_kecamatan . '"> ' . $dt_kecamatan->nama . ' </option> ';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table-responsive m-t-20">
                            <table id="table_data" class="table table-bordered table-striped " style="width: 1000px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Subjek </th>
                                        <th> Nama </th>
                                        <th> Lokasi</th>
                                        <th> Kontak </th>
                                        <th style="text-align: center;"> Aksi </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>