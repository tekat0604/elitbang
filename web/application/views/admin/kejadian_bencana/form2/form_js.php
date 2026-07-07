<script type="text/javascript" language="javascript">
    var link_url = "<?php echo base_url('admin/kejadian_bencana/form2/'); ?>";
    var id_kejadian = '<?= @$row->id ?>';
    var aksi = '<?= @$aksi ?>';
    if (id_kejadian != '') {
        loadForm1(<?= @$row->id_pelapor ?>);
    }

    $('.select2').select2({
        width: '100%',
    });

    function getForm1(sel) {
        loadForm1(sel.value);
    }

    function loadForm1(id_form1) {
        $.ajax({
            url: link_url + 'load_form1',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id_form1
            },
            beforeSend: function(res) {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<i style="font-size:25px;" class="fa fa-sync fa-spin"></i>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            complete: function(res) {
                Swal.close();
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#konten_form1').html(res.html);
                }
            }
        });
    }

    function getKelurahan(sel) {
        loadKelurahan(sel.value);
    }

    function loadKelurahan(id_kecamatan) {
        $.ajax({
            url: link_url + 'select_kelurahan_by_kec',
            type: 'POST',
            dataType: 'JSON',
            data: {
                kecamatan_id: id_kecamatan
            },
            success: function(data) {
                var html = "<option value=''>--- Silakan Pilih Kelurahan ---</option>";
                for (var i = 0; i < data.length; i++) {
                    html += "<option value='" + data[i].id_kelurahan + "'>" + data[i].nama + "</option>";
                }
                $("select[name=id_kelurahan_kejadian]").html(html);
            }
        });
    }

    //multiple personil 
    function add_row_personil() {
        $('#konten_personil').append(
            `<tr class="atribut_table_personil">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_personil" name="personil[]" > 

            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_personil" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_personil', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_personil").fadeOut();
            $(this).parents(".atribut_table_personil").remove();
        }
    });

    //multiple backup_mako  
    function add_row_backup_mako() {
        $('#konten_backup_mako').append(
            `<tr class="atribut_table_backup_mako">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_backup_mako" name="backup_mako[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_backup_mako" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger" style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_backup_mako', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_backup_mako").fadeOut();
            $(this).parents(".atribut_table_backup_mako").remove();
        }
    });


    //multiple_peralatan 
    function add_row_peralatan() {
        $('#konten_peralatan').append(
            `<tr class="atribut_table_peralatan">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_peralatan" name=jenis_peralatan[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_peralatan" name=jumlah_peralatan[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_peralatan" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_peralatan', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_peralatan").fadeOut();
            $(this).parents(".atribut_table_peralatan").remove();
        }
    });


    //multiple_logistik 
    function add_row_logistik() {
        $('#konten_logistik').append(
            `<tr class="atribut_table_logistik">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_logistik" name=jenis_logistik[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_logistik" name=jumlah_logistik[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_logistik" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_logistik', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_logistik").fadeOut();
            $(this).parents(".atribut_table_logistik").remove();
        }
    });


    //multiple_bantuan_personil 
    function add_row_bantuan_personil() {
        $('#konten_bantuan_personil').append(
            `<tr class="atribut_table_bantuan_personil">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_personil" name=nama_bantuan_personil[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_personil" name=jumlah_bantuan_personil[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_bantuan_personil" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_bantuan_personil', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_bantuan_personil").fadeOut();
            $(this).parents(".atribut_table_bantuan_personil").remove();
        }
    });




    //multiple_bantuan_peralatan 
    function add_row_bantuan_peralatan() {
        $('#konten_bantuan_peralatan').append(
            `<tr class="atribut_table_bantuan_peralatan">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_peralatan" name=jenis_bantuan_peralatan[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_peralatan" name=jumlah_bantuan_peralatan[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_bantuan_peralatan" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }

    $(document).on('click', '.delete_row_bantuan_peralatan', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_bantuan_peralatan").fadeOut();
            $(this).parents(".atribut_table_bantuan_peralatan").remove();
        }
    });

    //multiple_bantuan_logistik 
    function add_row_bantuan_logistik() {
        $('#konten_bantuan_logistik').append(
            `<tr class="atribut_table_bantuan_logistik">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_logistik" name=jenis_bantuan_logistik[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_bantuan_logistik" name=jumlah_bantuan_logistik[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_bantuan_logistik" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_bantuan_logistik', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_bantuan_logistik").fadeOut();
            $(this).parents(".atribut_table_bantuan_logistik").remove();
        }
    });


    //multiple_aparat_relawan 
    function add_row_aparat_relawan() {
        $('#konten_aparat_relawan').append(
            `<tr class="atribut_table_aparat_relawan">
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_aparat_relawan" name=nama_aparat_relawan[]" > 
            </td> 
            <td style="vertical-align: middle; padding-top: 5px;">
                <input class="form-control atribut_aparat_relawan" name=jumlah_aparat_relawan[]" > 
            </td> 
            <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                <span class="delete_row_aparat_relawan" style="cursor: pointer;">
                    <i class="fa fa-remove text-danger " style="font-size: 18px; "></i>
                </span>  
            </td>
        </tr>`
        );
    }
    $(document).on('click', '.delete_row_aparat_relawan', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_aparat_relawan").fadeOut();
            $(this).parents(".atribut_table_aparat_relawan").remove();
        }
    });


    function do_submit(dt) {
        var get_id = $("input[name=id]").val();
        if (aksi == "tambah") {
            save_url = link_url + 'do_submit';
        } else if (aksi == "ubah") {
            save_url = link_url + 'do_update';
        } else {
            save_url = link_url + 'do_submit';
        }

        $.ajax({
            type: "POST",
            url: save_url,
            data: new FormData(dt),
            dataType: "JSON",
            contentType: false,
            processData: false,
            beforeSend: function(res) {
                Swal.fire({
                    title: 'Loading ...',
                    html: '<i style="font-size:25px;" class="fa fa-sync fa-spin"></i>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            complete: function(res) {
                //Swal.close();
            },
            success: function(res) {
                if (res.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil disimpan',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        html: '<i  class="fa fa-check text-success" style="font-size: 36px;"></i>',
                    });
                    setTimeout(function() {
                        Swal.close();
                        window.location.href = link_url;
                    }, 1000);
                }
            }
        });
    }
</script>