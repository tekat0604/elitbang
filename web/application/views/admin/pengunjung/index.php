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
                <h3 class="block-title"> Data Pengunjung </h3>
            </div>
            <?php
            $sebelum_satu_bulan = date("d/m/Y", strtotime(date("d/m/Y", strtotime(date("d/m/Y"))) . "-1 month"));
            // $exp = explode('/',  $sebelum_satu_bulan);
            // $date_ori = '' . $exp[2] . '-' . $exp[1] . '-' . $exp[0] . '';
            // echo $date_ori;
            ?>
            <div class="block-content">
                <div class="row mb-2">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control date_picker" id="tanggal_mulai" value="<?= $sebelum_satu_bulan ?>">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control date_picker" id="tanggal_selesai" value="<?= date('d/m/Y') ?>">
                    </div>
                </div>
                <div class="table-responsive m-t-20">
                    <table id="table_data" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th> IP </th>
                                <th> Waktu </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->