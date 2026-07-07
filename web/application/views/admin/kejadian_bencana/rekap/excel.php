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
<table class=" table_custom" border="1">
    <thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle;"> &nbsp; No &nbsp; </th>
            <th colspan="6" class="text-center"> &nbsp; PELAPOR &nbsp; </th>
            <th colspan="10" class="text-center"> &nbsp; KEJADIAN BENCANA &nbsp; </th>
            <th colspan="4" class="text-center"> &nbsp; DAMPAK BENCANA &nbsp; </th>
            <th colspan="3" class="text-center"> &nbsp; KORBAN BENCANA (Orang)&nbsp; </th>
            <th class="text-center" rowspan="2"> &nbsp; DATA KORBAN BENCANA &nbsp; </th>
            <th rowspan="2" style="min-width: 200px;"> &nbsp; DAMPAK KEJADIAN &nbsp; </th>
            <th rowspan="2" style="min-width: 200px;"> &nbsp; HAMBATAN &nbsp; </th>
        </tr>
        <tr>
            <th style="min-width: 150px;"> &nbsp; Jenis Identitas &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Nomor Identitas &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Nama Pelapor &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Jenis Kelamin &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Alamat &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Nomor Telepon &nbsp; </th>

            <th style="min-width: 150px;"> &nbsp; Jenis Kejadian &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Nomor Kejadian &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Kecamatan &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Kelurahan &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Alamat &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Hari &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Tanggal &nbsp; </th>
            <th style="min-width: 190px;"> &nbsp; Jam Kejadian (WIB) &nbsp; </th>
            <th style="min-width: 190px;"> &nbsp; Jam Laporan (WIB) &nbsp; </th>
            <th style="min-width: 250px;"> &nbsp; Kronologi Kejadian &nbsp; </th>

            <th style="min-width: 150px;"> &nbsp; Rusak Ringan &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Rusak Sedang &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Rusak Berat &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Kerugian &nbsp; </th>

            <th style="min-width: 150px;"> &nbsp; Luka Ringan &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Luka Berat &nbsp; </th>
            <th style="min-width: 150px;"> &nbsp; Meninggal Dunia &nbsp; </th>
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
                <td style="vertical-align: middle;"> &nbsp; <?= $no ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->jenis_identitas ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->nomor_identitas ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->nama_pelapor ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->jenis_kelamin ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->alamat_pelapor ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form1->nomor_telepon ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->jenis_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->nomor_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->kecamatan ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->kelurahan ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->alamat_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->hari_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->alamat_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->jam_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->jam_laporan ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->kronologi_kejadian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->rusak_ringan ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->rusak_sedang ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->rusak_berat ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form3->kerugian ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->luka_ringan ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->luka_berat ?> &nbsp; </td>
                <td style="vertical-align: middle;"> &nbsp; <?= $form2->meninggal_dunia ?> &nbsp; </td>
                <td style="vertical-align: middle;">
                    <?php if ($dt_row->count_kb_has_korban > 0) { ?>
                        <table border="1">
                            <tr>
                                <td style="min-width: 40px; font-weight: bold; "> &nbsp; No &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Rs Tujuan &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Alamat &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Nama &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Jenis Identitas &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Nomor Identitas &nbsp; </td>
                                <td style="min-width: 150px; font-weight: bold; "> &nbsp; Ciri-ciri &nbsp; </td>
                            </tr>
                            <?php
                            $no_kb = 0;
                            foreach ($dt_row->kb_has_korban as $dt_korban) :
                                $no_kb++;
                            ?>
                                <tr>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $no_kb ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->rs_rujukan ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->alamat ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->nama ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->jenis_identitas ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->nomor_identitas ?> &nbsp; </td>
                                    <td style="vertical-align: middle;"> &nbsp; <?= $dt_korban->ciri_ciri ?> &nbsp; </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php } ?>


                </td>
                <td> &nbsp; <?= $form2->dampak_kejadian ?> &nbsp; </td>
                <td> &nbsp; <?= $form2->hambatan ?> &nbsp; </td>
            </tr>
        <?php } ?>
    </tbody>
</table>