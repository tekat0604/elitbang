<form onsubmit="event.preventDefault();do_submit(this);">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" hidden>
                <label> ID </label>
                <input type="text" name="id" autocomplete="off" class="form-control" value="<?= @$data->id ?>">
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label> Jenis Identitas </label>
                <select name="jenis_identitas" class="form-control js_select2">
                    <option value="ktp" <?= @$data->jenis_identitas == "ktp" ? " selected='' " : ""; ?>>KTP</option>
                    <option value="sim" <?= @$data->jenis_identitas == "sim" ? " selected='' " : ""; ?>>SIM</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nomor Identitas </label>
                <input type="text" name="nomor_identitas" autocomplete="off" placeholder="Tulis nomor_identitas " class="form-control" value="<?= @$data->nomor_identitas ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama </label>
                <input type="text" name="nama_pelapor" autocomplete="off" placeholder="Tulis Nama Pelapor " class="form-control" value="<?= @$data->nama_pelapor ?>">
            </div>
        </div>
        <div class="col-md-6">
            <label> Jenis Kelamin</label>
            <div class="form-group">
                <ul class="list-unstyled" style="margin-bottom: 0px; margin-left: 0;">
                    <li class="d-inline-block mr-1">
                        <fieldset>
                            <div class="radio radio-primary radio-glow">
                                <input type="radio" id="jenis_kelamin_pria" name="jenis_kelamin" value="laki_laki" <?= @$data->jenis_kelamin == "laki_laki" ? " checked='' " : ""; ?>>
                                <label for="jenis_kelamin_pria"> Laki-Laki </label>
                            </div>
                        </fieldset>
                    </li>
                    <li class="d-inline-block mr-1">
                        <fieldset>
                            <div class="radio radio-primary radio-glow">
                                <input type="radio" id="jenis_kelamin_wanita" name="jenis_kelamin" value="perempuan" <?= @$data->jenis_kelamin == "perempuan" ? " checked='' " : ""; ?>>
                                <label for="jenis_kelamin_wanita"> Perempuan </label>
                            </div>
                        </fieldset>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label> Pelapor Sebagai </label>
                <input type="text" name="pelapor_sebagai" autocomplete="off" placeholder="Tulis Pelapor Sebagai" class="form-control" value="<?= @$data->pelapor_sebagai ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nomor Telepon </label>
                <input type="text" name="nomor_telepon" autocomplete="off" placeholder="Tulis Nomor Telepon " class="form-control" value="<?= @$data->nomor_telepon ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label> Alamat </label>
                <textarea name="alamat_pelapor" autocomplete="off" placeholder="Masukkan Alamat" class="form-control" rows="3"><?= @$data->alamat_pelapor ?></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group ">
                <label> upload identitas <span class="text-danger"> * </span> </label>
                <div class="custom-file mb-3 box_image" style="padding: 5px;">
                    <input type="file" class="custom-file-input " id="upload_image" name="image">
                    <label class="custom-file-label image_label" for="upload_image"> Silahkan Pilih file </label>
                    <div style="font-size: 11px; line-height: 13px; font-style: Italic; margin-top: 5px; margin-bottom: 5px; text-align: left;" class="text-info">
                        (Format image .jpg/.jpeg/.png & Ukuran terbaik-nya 600 x 400 pixel)
                    </div>
                </div>
                <div id="image_preview" style="max-width: 300px;">
                    <div id="image_preview_container" class=" image_preview_container">
                        <?php
                        if (@$data->upload_identitas != '' && @$data->upload_identitas != NULL) {
                            $link_img = base_url('uploads/images/' . @$folder . '/' . @$data->upload_identitas . '');
                        ?>
                            <img src="<?= $link_img ?>" alt="" style="width: 100%;">
                            <div style="margin-top: 5px;">
                                <button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="` + id_name + `">
                                    <i class="fa fa-remove"></i> Hapus
                                </button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="kosongkan_file" id="kosongkan_ubah_image" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-alt-success">
                <i class="fa fa-check"></i> Simpan
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.js_select2').select2({
            width: '100%',
        });
    });
    $('#upload_image').change(function(e) {
        console.log(this);
        var label_text = $(this).val();
        if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
        $('.image_label').text(label_text);
        file_preview(this, 'image');
    });

    function file_preview(input, id_name) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                //$('#image_preview').remove();
                $('#image_preview_container').html('');
                $('#image_preview_container').html(
                    `<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
                <img src="` + e.target.result + `" 
                style="width: 100%; height: 100%;vertical-align:middle"/>
                <div style="margin-top: 5px;">
                    <button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="` + id_name + `"> 
                    <i class="fa fa-remove mr-1"></i>  Hapus </button>
                </div>  
            </div>
            `);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.hapus_image', function() {
        var id_name = $(this).attr("id_name");
        $('#image_preview_container').html('');
        $('#image_label').text('Silahkan pilih file...');
        $('#image').val('');
        $('#kosongkan_ubah_image').val('1');
    });
</script>