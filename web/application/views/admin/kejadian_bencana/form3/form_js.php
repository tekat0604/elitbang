<script type="text/javascript" language="javascript">
    var link_url = "<?php echo base_url('admin/kejadian_bencana/form3/'); ?>";
    var id_kejadian = '<?= @$row->id ?>';
    var aksi = '<?= @$aksi ?>';
    if (id_kejadian != '') {
        loadForm1(<?= @$row->id_form_1 ?>);
    }

    if (id_kejadian != '') {
        loadForm2(<?= @$row->id_form_2 ?>);
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

    function get_select_from2(sel) {
        selectForm2(sel.value);
    }

    function selectForm2(id_pelapor) {

        $.ajax({
            url: link_url + 'select_form2_by_id_pelapor',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_pelapor: id_pelapor
            },
            success: function(data) {
                var html = "<option value=''>--- Silakan Pilih Form A2  ---</option>";
                for (var i = 0; i < data.length; i++) {
                    html += "<option value='" + data[i].id + "'>" + data[i].nomor_kejadian + "</option>";
                }
                $("select[name=id_form_2]").html(html);
            }
        });
    }

    function getForm2(sel) {
        loadForm2(sel.value);
    }

    function loadForm2(id_form2) {
        $.ajax({
            url: link_url + 'load_form2',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id_form2
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
                    $('#konten_form2').html(res.html);
                }
            }
        });
    }

    //multiple korban 
    function add_row_korban() {
        $('#konten_korban').append(`
            <tr class="atribut_table_korban">
                <td style="vertical-align: middle; padding-top: 5px;">
                    <div style="float: left; width: 200px;"> Rumah Sakit Rujukan  </div>
                    <div style="float: left; width: 600px;"> 
                        <input class="form-control atribut_korban" name="rs_rujukan_korban[]" > 
                    </div> <div style="clear: both; height: 10px;"></div>

                    <div style="float: left; width: 200px;"> Alamat </div>
                    <div style="float: left; width: 600px;">  
                        <input class="form-control atribut_korban" name="alamat_korban[]"> 
                    </div> <div style="clear: both; height: 10px;"></div>

                    <div style="float: left; width: 200px;"> Nama </div>
                    <div style="float: left; width: 600px;"> 
                    <input class="form-control atribut_korban" name="nama_korban[]"> 
                    </div> <div style="clear: both; height: 10px;"></div>

                    <div style="float: left; width: 200px;"> Jenis Identitas  </div>
                    <div style="float: left; width: 600px;"> 
                        <input class="form-control atribut_korban" name="jenis_identitas_korban[]"> 
                    </div> <div style="clear: both; height: 10px;"></div> 

                    <div style="float: left; width: 200px;"> Nomor Identitas  </div>
                    <div style="float: left; width: 600px;"> 
                        <input class="form-control atribut_korban" name="nomor_identitas_korban[]" > 
                    </div> <div style="clear: both; height: 10px;"></div>

                    <div style="float: left; width: 200px;"> Ciri-ciri   </div>
                    <div style="float: left; width: 600px;"> 
                        <input class="form-control atribut_korban" name="ciri_ciri_korban[]" > 
                    </div> <div style="clear: both; height: 10px;"></div> 
                </td> 
                <td style="text-align: center; vertical-align: middle; padding-top: 5px;">  
                    <span class="delete_row_korban" style="cursor: pointer;">
                        <i class="fa fa-remove text-danger " style="font-size: 18px;"></i>
                    </span>  
                </td>
            </tr>
        `);
    }

    $(document).on('click', '.delete_row_korban', function(ev) {
        ev.preventDefault();
        if (ev.type == 'click') {
            $(this).parents(".atribut_table_korban").fadeOut();
            $(this).parents(".atribut_table_korban").remove();
        }
    });

    function do_submit(dt) {
        var get_id = $("input[name=id]").val();
        $.ajax({
            type: "POST",
            url: link_url + 'do_submit',
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
<?php
/*
<input class="form-control atribut_korban" name="alamat_korban[]"> 
<input class="form-control atribut_korban" name="nama_korban[]"> 
<input class="form-control atribut_korban" name="jenis_identitas_korban[]"> 
<input class="form-control atribut_korban" name="nomor_identitas_korban[]"> 
<input class="form-control atribut_korban" name="ciri_ciri_korban[]"> 
*/

?>