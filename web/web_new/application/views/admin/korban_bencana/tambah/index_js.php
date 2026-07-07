<script type="text/javascript" language="javascript">
    setTimeout(function() {
        /*Swal.fire({
		title 	: 'Sukses!',
        text 	: 'Data berhasil di hapus.',
        type 	: 'success',
        timer 	: 1500
	}); 
    Swal.fire({
        icon    : 'error',
        title   : 'Gagal',
        text    : 'Data gagal di hapus.', 
        type    : 'error',
    });*/

    }, 1000);

    $(document).ready(function() {
        var base_url = "<?php echo base_url(); ?>";
    });
    //DATA FERERENSI Ketegori Bencana
    $.ajax({
        url: base_url + 'admin/korban_bencana/select_kategori_bencana',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option value=''>--- Silakan Pilih Kategori Bencana ---</option>";
            for (var i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].id + "'>" + data[i].nama_kategori_bencana + "</option>";
            }
            $("#tambah_id_kategori").html(html);
        }
    });

    //DATA FERERENSI KECAMATAN
    $.ajax({
        url: base_url + 'admin/korban_bencana/select_kecamatan',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            var html = "<option value=''>--- Silakan Pilih Kecamatan ---</option>";
            for (var i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].id_kecamatan + "'>" + data[i].nama + "</option>";
            }
            $("#tambah_id_kecamatan").html(html);
        }
    });

    function getKelurahan(selectObject) {
        var id_kecamatan = selectObject.value;
        loadKelurahan(id_kecamatan);
    }

    function loadKelurahan(id_kecamatan) {
        $.ajax({
            url: base_url + 'admin/korban_bencana/select_kelurahan_by_kec',
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
                $("#tambah_id_kelurahan").html(html);
            }
        });
    }
    $('#form_tambah_korban').submit(function(e) {
        e.preventDefault();
        var nik = $("#tambah_nik").val();
        var nama_lengkap = $("#tambah_nama_lengkap").val();
        var tempat_lahir = $("#tambah_tempat_lahir").val();
        var tanggal_lahir = $("#tambah_tanggal_lahir").val();
        var kategori_bencana = $("#tambah_id_kategori").val();
        $('.validasi').html('');
        if (nik == "") {
            $("#error_tambah_nik").html('<div class="text-danger">Nik harus di isi</div>');
            $("#tambah_nik").focus();
        } else if (nama_lengkap == "") {
            $("#error_tambah_nama_lengkap").html('<div class="text-danger">Nama Lengkap harus di isi</div>');
            $("#tambah_nama_lengkap").focus();
        } else if (kategori_bencana == "") {
            $("#error_tambah_id_kategori").html('<div class="text-danger">Kategori Bencana belum di pilih</div>');
            $("#tambah_id_kategori").focus();
        } else {
            $.ajax({
                url: base_url + 'admin/korban_bencana/prosesTambah',
                type: "POST",
                dataType: 'JSON',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data == "ok") {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data berhasil di simpan.',
                            type: 'success',
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.href = './';
                        }, 1600);

                    } else if (data == "duplikat_nik") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Nik sudah ada.',
                            type: 'warning',
                            timer: 1500
                        });
                        $("#nik").focus();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Data gagal di hapus.',
                            type: 'error',
                        });
                    }
                },
            });
        }
    });

    $('#tambah_image').change(function(e) {
        var label_text = $(this).val();
        if (label_text.length > 50) label_text = label_text.substring(0, 47) + '...';
        $('#tambah_image_label').text(label_text);
        file_preview(this, 'tambah_image');
    });

    function file_preview(input, id_name) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + id_name + '_preview').remove();
                $('#' + id_name + '_preview_container').html(
                    `<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
					<img src="` + e.target.result + `" 
					style="width: 100%; height: 100%;vertical-align:middle"/>
					<div style="margin-top: 5px;">
						<button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="` + id_name + `"> 
						<i class="fa fa-remove"></i> Hapus </button>
					</div>  
				</div>			
				`);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.hapus_image', function() {
        var id_name = $(this).attr("id_name");
        $('#' + id_name + '_preview_container').html('');
        $('#' + id_name + '_label').text('Silahkan pilih file...');
        $('#' + id_name + '').val('');
    });
</script>