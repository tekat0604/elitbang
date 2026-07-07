<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }

    .table_custom thead tr th {
        vertical-align: middle;
        padding: 2px 5px 2px 5px;
    }

    .table_custom tbody tr td {
        vertical-align: middle;
        padding: 2px 5px 2px 5px;
    }
</style>
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title"> Rekap Data Kejadian Bencana </h3>
                <a href="https://api.whatsapp.com/send?text=<?= $link_url ?>excel" target="_blank" class="btn btn-info" style="margin-bottom:10px; margin-right:10px;">
                    <i class="fa fa-share"></i> Share WA
                </a>
                <a href="<?= $link_url ?>excel" class="btn btn-success" style="margin-bottom:10px;">
                    <i class="fa fa-print"></i> Export Rekap
                </a>
            </div>
            <div class="block-content">
                <div class="table-responsive m-t-20">
                    <table class="table table-bordered table-striped table_custom" style="width:  1000000px!important;">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;"> No </th>
                                <th colspan="6" class="text-center"> PELAPOR </th>
                                <th colspan="10" class="text-center"> KEJADIAN BENCANA </th>
                                <th colspan="4" class="text-center"> DAMPAK BENCANA </th>
                                <th colspan="3" class="text-center"> KORBAN BENCANA (Orang)</th>
                                <th class="text-center"> DATA KORBAN BENCANA </th>
                                <th colspan="2" class="text-center"> NEXT </th>
                            </tr>
                            <tr>
                                <th style="min-width: 150px;"> Jenis Identitas </th>
                                <th style="min-width: 150px;"> Nomor Identitas </th>
                                <th style="min-width: 150px;"> Nama Pelapor </th>
                                <th style="min-width: 150px;"> Jenis Kelamin </th>
                                <th style="min-width: 150px;"> Alamat </th>
                                <th style="min-width: 150px;"> Nomor Telepon </th>

                                <th style="min-width: 150px;"> Jenis Kejadian </th>
                                <th style="min-width: 150px;"> Nomor Kejadian </th>
                                <th style="min-width: 150px;"> Kecamatan </th>
                                <th style="min-width: 150px;"> Kelurahan </th>
                                <th style="min-width: 150px;"> Alamat </th>
                                <th style="min-width: 150px;"> Hari </th>
                                <th style="min-width: 150px;"> Tanggal </th>
                                <th style="min-width: 190px;"> Jam Kejadian (WIB) </th>
                                <th style="min-width: 190px;"> Jam Laporan (WIB) </th>
                                <th style="min-width: 190px;"> Kronologi Kejadian </th>

                                <th style="min-width: 150px;"> Rusak Ringan </th>
                                <th style="min-width: 150px;"> Rusak Sedang </th>
                                <th style="min-width: 150px;"> Rusak Berat </th>
                                <th style="min-width: 150px;"> Kerugian </th>

                                <th style="min-width: 150px;"> Luka Ringan </th>
                                <th style="min-width: 150px;"> Luka Berat </th>
                                <th style="min-width: 150px;"> Meninggal Dunia </th>

                                <th>
                                    <div style="width: 500px;"></div>
                                </th>

                                <th style="min-width: 200px;"> Dampak Kejadiaan </th>
                                <th style="min-width: 200px;"> Hambatan </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $no = 0;
                            foreach ($data as $dt_row) {
                                $no++;
                                $form1 = $dt_row->form1;
                                $form2 = $dt_row->form2;
                                $form3 = $dt_row;
                            ?>
                                <tr>
                                    <td> <?= $no ?> </td>
                                    <td> <?= $form1->jenis_identitas ?> </td>
                                    <td> <?= $form1->nomor_identitas ?> </td>
                                    <td> <?= $form1->nama_pelapor ?> </td>
                                    <td> <?= $form1->jenis_kelamin ?> </td>
                                    <td> <?= $form1->alamat_pelapor ?> </td>
                                    <td> <?= $form1->nomor_telepon ?> </td>
                                    <td> <?= $form2->jenis_kejadian ?> </td>
                                    <td> <?= $form2->nomor_kejadian ?> </td>
                                    <td> <?= $form2->kecamatan ?> </td>
                                    <td> <?= $form2->kelurahan ?> </td>
                                    <td> <?= $form2->alamat_kejadian ?> </td>
                                    <td> <?= $form2->hari_kejadian ?> </td>
                                    <td> <?= $form2->alamat_kejadian ?> </td>
                                    <td> <?= $form2->jam_kejadian ?> </td>
                                    <td> <?= $form2->jam_laporan ?> </td>
                                    <td> <?= $form2->kronologi_kejadian ?> </td>
                                    <td> <?= $form2->rusak_ringan ?> </td>
                                    <td> <?= $form2->rusak_sedang ?> </td>
                                    <td> <?= $form2->rusak_berat ?> </td>
                                    <td> <?= $form3->kerugian ?> </td>
                                    <td> <?= $form2->luka_ringan ?> </td>
                                    <td> <?= $form2->luka_berat ?> </td>
                                    <td> <?= $form2->meninggal_dunia ?> </td>
                                    <td>
                                        <?php if ($dt_row->count_kb_has_korban > 0) { ?>
                                            <table>
                                                <tr>
                                                    <td style="min-width: 40px; background: #fff!important; font-weight: bold; "> No </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Rs Tujuan </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Alamat </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Nama </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Jenis Identitas </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Nomor Identitas </td>
                                                    <td style="min-width: 150px; background: #fff!important; font-weight: bold; "> Ciri-ciri </td>
                                                </tr>
                                                <?php
                                                $no_kb = 0;
                                                foreach ($dt_row->kb_has_korban as $dt_korban) :
                                                    $no_kb++;
                                                ?>
                                                    <tr>
                                                        <td style="background: #fff!important; "> <?= $no_kb ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->rs_rujukan ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->alamat ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->nama ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->jenis_identitas ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->nomor_identitas ?> </td>
                                                        <td style="background: #fff!important; "> <?= $dt_korban->ciri_ciri ?> </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        <?php } ?>


                                    </td>
                                    <td> <?= $form2->dampak_kejadian ?> </td>
                                    <td> <?= $form2->hambatan ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>