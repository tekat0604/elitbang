<style>
    table.table_custom tr td {
        padding: 3px 5px 3px 5px;
    }
</style>
<table class="table table_custom" style="margin-top: 5px; margin-bottom: 5px; ">
    <tr>
        <td style="width: 100px;"> Jenis Identitas </td>
        <td style="width: 10px;"> : </td>
        <td style="width: 250px;"> <?= @$row->jenis_identitas ?> </td>
    </tr>
    <tr>
        <td> Nomor Identitas </td>
        <td> : </td>
        <td> <?= @$row->nomor_identitas ?> </td>
    </tr>
    <tr>
        <td> Nama </td>
        <td> : </td>
        <td> <?= @$row->nama_pelapor ?> </td>
    </tr>
    <tr>
        <td> Nomor Telepon </td>
        <td> : </td>
        <td> <?= @$row->nomor_telepon ?> </td>
    </tr>
    <tr>
        <td> Identitas</td>
        <td> : </td>
        <td>
            <?php
            if (@$row->upload_identitas != '' && @$row->upload_identitas != NULL) {
                $link_img = base_url('uploads/images/kejadian_bencana/' . @$row->upload_identitas . '');
            ?>
                <img src="<?= @$link_img ?>" style="width: 100px;">
            <?php } ?>
        </td>
    </tr>
</table>