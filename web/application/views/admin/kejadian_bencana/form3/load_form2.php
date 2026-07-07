<div> &nbsp; </div>
<div class="row mb-2">
    <div class="col-lg-6 col-md-12 col-sm-12 ">
        <div class="row mb-1 ">
            <div class="col-md-4">
                <label>Jenis Kejadian</label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->jenis_kejadian ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label>Nomor Kejadian</label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->nomor_kejadian ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Kecamatan </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->kecamatan ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Kelurahan </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->kelurahan ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Alamat </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->alamat_kejadian ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12 ">
        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Hari </label>
            </div>
            <div class="col-md-8">
                <?= @$row->hari_kejadian ?>
            </div>
        </div>
        <div class="row mb-1 ">
            <div class="col-md-4">
                <label>Tanggal </label>
            </div>
            <div class="col-md-8  ">
                <?= @$row->tanggal_kejadian ?>
            </div>
        </div>
        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Jam Kejadian (WIB) </label>
            </div>
            <div class="col-md-8">
                <?= @$row->jam_kejadian ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Jam Laporan (WIB) </label>
            </div>
            <div class="col-md-8">
                <?= @$row->jam_laporan ?>
            </div>
        </div>

        <div class="row mb-1 ">
            <div class="col-md-4">
                <label> Kronologi Kejadian </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->kronologi_kejadian ?>
            </div>
        </div>
    </div>
</div>
<div> &nbsp; </div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-1">
            <h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
                <i class="fa fa-user"></i> DAMPAK BENCANA
            </h3>
        </div>
        <div class="row mb-1">
            <div class="col-md-4">
                <label> Rusak Ringan </label>
            </div>
            <div class="col-md-8">
                <?= @$row->rusak_ringan ?>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-4">
                <label> Rusak Sedang </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->rusak_sedang ?>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-4">
                <label> Rusak Berat </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->rusak_berat ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-1">
            <h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
                <i class="fa fa-user"></i> DATA KORBAN BENCANA (Orang)
            </h3>
        </div>
        <div class="row mb-1">
            <div class="col-md-4">
                <label> Luka Ringan </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->luka_ringan ?>
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-4">
                <label> Luka Berat </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->luka_berat ?>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-4">
                <label> Meninggal Dunia </label>
            </div>
            <div class="col-md-8 ">
                <?= @$row->meninggal_dunia ?>
            </div>
        </div>
    </div>
</div>
<div> &nbsp; </div>

<div class="mb-1">
    <h3 class="block-title" style="padding-bottom: 5px; border-bottom: 1px solid #ddd;">
        <i class="fa fa-user"></i> ANALISA SWOT ASSESMENT BENCANA
    </h3>
    <div style="font-weight: 800;"> INTERNAL </div>
    <div style="font-weight: 700; color: #444;"> Strenght (Analisis Kekuatan) </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Personil Yang Bertugas </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Nama </th>
                            </tr>
                        </thead>
                        <tbody id="konten_personil">
                            <?php if (@$row->kb_has_personil) {
                                $no = 0;
                                foreach (@$row->kb_has_personil as $dt_item) {
                                    $no++; ?>
                                    <tr class="atribut_table_personil">
                                        <td style="vertical-align: middle; padding-top: 5px;"> <?= $no ?> </td>
                                        <td style="vertical-align: middle; padding-top: 5px;"> <?= @$dt_item->nama ?> </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Backup Mako </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Nama </th>
                            </tr>
                        </thead>
                        <tbody id="konten_backup_mako">
                            <?php if (@$row->kb_has_backup_mako) {
                                $no = 0;
                                foreach (@$row->kb_has_backup_mako as $dt_item) {
                                    $no++; ?>
                                    <tr class="atribut_table_backup_mako">
                                        <td style="text-align: center; vertical-align: middle; padding-top: 5px;">
                                            <?= $no ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->nama ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div> &nbsp; </div>

<div class="row">
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Peralatan yang akan digunakan </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Jenis </th>
                                <th style="width: 100px;" class="text-center"> Jumlah </th>
                            </tr>
                        </thead>
                        <tbody id="konten_peralatan">
                            <?php if (@$row->kb_has_peralatan) {
                                $no = 0;
                                foreach (@$row->kb_has_peralatan as $dt_item) {
                                    $no++;
                            ?>
                                    <tr class="atribut_table_peralatan">
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $no  ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->nama ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->jumlah ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Logistik yang akan digunakan </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">

                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Jenis </th>
                                <th style="width: 100px;" class="text-center"> Jumlah </th>
                            </tr>
                        </thead>
                        <tbody id="konten_logistik">
                            <?php if (@$row->kb_has_logistik) {
                                $no = 0;
                                foreach (@$row->kb_has_logistik as $dt_item) {
                                    $no++;
                            ?>
                                    <tr class="atribut_table_logistik">
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $no  ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->nama ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->jumlah ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div> &nbsp; </div>
<div class="row mb-1">
    <div class="col-md-12">
        <table>
            <tr>
                <td style="width: 220px;">
                    <span style="font-weight: 600;"> Keahlian yang akan digunakan : </span>
                </td>
                <td style="width: auto;"> <?= @$row->keahlian ?> </td>
            </tr>
        </table>
    </div>
</div>

<div class="row mt-3 mb-1">
    <div class="col-md-12">
        <div style="font-weight: 700; color: #444;"> Weakness (Analisis Kelemahan) </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Butuh Bantuan personil </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Instansi Asal </th>
                                <th style="width: 100px;" class="text-center"> Jumlah </th>
                            </tr>
                        </thead>
                        <tbody id="konten_bantuan_personil">
                            <?php if (@$row->kb_has_bantuan_personil) {
                                $no = 0;
                                foreach (@$row->kb_has_bantuan_personil as $dt_item) {
                                    $no++;
                            ?>
                                    <tr class="atribut_table_bantuan_personil">
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $no ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->nama ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->jumlah ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Butuh Bantuan Peralatan</label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Jenis Peralatan </th>
                                <th style="width: 100px;" class="text-center"> Jumlah </th>
                            </tr>
                        </thead>
                        <tbody id="konten_bantuan_peralatan">
                            <?php if (@$row->kb_has_bantuan_peralatan) {
                                $no = 0;
                                foreach (@$row->kb_has_bantuan_peralatan as $dt_item) {
                                    $no++;
                            ?>
                                    <tr class="atribut_table_bantuan_peralatan">
                                        <td style="text-align: center; vertical-align: middle; padding-top: 5px;">
                                            <?= $no ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->nama ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->jumlah ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div> &nbsp; </div>

<div class="row">
    <div class="col-md-6">
        <div class="box_list_mutliple">
            <div class="row mb-1">
                <div class="col-md-12">
                    <label> Butuh Bantuan logistik </label>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-12">
                    <table class="table table-bordered table_custom_for_multiple" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"> No </th>
                                <th style="width: auto;" class="text-center"> Nama Barang </th>
                                <th style="width: 100px;" class="text-center"> Jumlah </th>

                            </tr>
                        </thead>
                        <tbody id="konten_bantuan_logistik">
                            <?php if (@$row->kb_has_bantuan_logistik) {
                                $no = 0;
                                foreach (@$row->kb_has_bantuan_logistik as $dt_item) {
                                    $no++; ?>
                                    <tr class="atribut_table_bantuan_logistik">
                                        <td style="text-align: center; vertical-align: middle; padding-top: 5px;">
                                            <?= $no; ?>
                                        </td>
                                        <td style="vertical-align: middle; padding-top: 5px;"> <?= $dt_item->nama ?> </td>
                                        <td style="vertical-align: middle; padding-top: 5px;">
                                            <?= $dt_item->jumlah ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>