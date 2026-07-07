<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-slider').on('shown.bs.modal', function (e) {
    $("#judul").focus();
});

$('#modal-slider').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_slider(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/slider/daftar_slider',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i; var tombol_tampil = "";
            for(i=0; i<data.length; i++){

                // tombol tampil
                if (data[i].tampil === '1') {
                    tombol_tampil = '<button type="button" class="btn btn-sm btn-success mb-10 item_tampil_nonaktif" data="'+data[i].id+'"><i class="fa fa-check"></i></button> ';
                } else {
                    tombol_tampil = '<button type="button" class="btn btn-sm btn-danger mb-10 item_tampil_aktif" data="'+data[i].id+'"><i class="fa fa-times"></i></button> ';
                } 
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+ 
                        '<td style="text-align: left;">'+data[i].gambar+'</td>'+  
                        '<td style="text-align: center;">'+tombol_tampil+ 
                        '</td>'+ 
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id+'"><i class="fa fa-edit"></i></button> '+ 
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'+data[i].id+'"><i class="fa fa-trash"></i></button> '+ 
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

function defaultForm() {
    daftar_slider();
    $("#nama").val("");  

    $("#gambar").val("");
    $("#file").val("");
     
    $("#tampil_file").hide();  
    $("#detail_tampil_file").hide();

    $("h3.block-title").html("Tambah slider");
    $("#id").val("");
}

$('#form_slider').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/slider/form_slider',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){ 
            daftar_slider();
            Swal.fire({
                title : 'Sukses!',
                text : 'Data slider berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-slider').modal('hide');
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/slider/get_slider')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $("#tampil_file").show(); 
            $('#modal-slider').modal('show');

            $("h3.block-title").html("Ubah slider");

            $('[name="id"]').val(id);
            $('[name="file"]').val(data.file);  

            $('#tampil_file').attr('src','<?= base_url('assets_frontend/images/slider/') ?>'+data.file);
        }
    });
    return false;
});

function download(id){ 
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/slider/get_slider')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            window.location.href = "<?= base_url() ?>assets_frontend/images/file_slider/"+data.file; 
        }
    });
    window.location.href = "<?= base_url('admin/frontend/slider') ?>"; 
    return false;
}

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/slider/hapus_slider')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function aktif(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/slider/aktif_slider')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function nonaktif(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/slider/nonaktif_slider')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

$('#mydata').on('click','.item_hapus',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            hapus(id);
            Swal.fire(
                'Terhapus!',
                'slider yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});
 

$('#mydata').on('click','.item_tampil_aktif',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan menampilkan data ini ke publik",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aktif',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            aktif(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di tampilkan',
                'success'
            );
        }
    });
    
});

$('#mydata').on('click','.item_tampil_nonaktif',function(){
    var id = $(this).attr('data');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan menyembunyikan data ini dari publik",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aktif',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            nonaktif(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di nonaktifkan',
                'success'
            );
        }
    });
    
});

$('#mydata').on('click','.item_download',function(){
    var id = $(this).attr('data');
    download(id);    
});

</script>