<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-data').on('shown.bs.modal', function (e) {
    $("#judul").focus();
});

$('#modal-data').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_data(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/data/daftar_data',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i; var tombol_tampil = "";
            for(i=0; i<data.length; i++){ 
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].judul+'</td>'+  
                        '<td style="text-align: left;">'+data[i].deskripsi+'</td>'+  
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-primary mb-10 item_kelola" data="'+data[i].id+'"><i class="fa fa-database"></i></button> '+ 
                        '</td>'+ 
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id+'"><i class="fa fa-pencil"></i></button> '+ 
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
    daftar_data();
    $("#judul").val(""); 
    $("#deskripsi").val("");

    $("h3.block-title").html("Tambah Data");
    $("#id").val("");
}

$('#form_data').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/data/form_data',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){ 
            daftar_data();
            Swal.fire({
                title : 'Sukses!',
                text : 'Data Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-data').modal('hide');
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/data/get_data')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){ 
            $('#modal-data').modal('show');

            $("h3.block-title").html("Ubah Data");

            $('[name="id"]').val(id);
            $('[name="judul"]').val(data.judul); 
            $('[name="deskripsi"]').val(data.deskripsi);
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/hapus_data')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                if (data.status == '0') {
                    Swal.fire(
                        'Maaf!',
                        data.data,
                        'danger'
                    );
                } else {
                    defaultForm();
                } 
            }
        });
    return false;
}

// function aktif(id){
//     $.ajax({
//     type : "POST",
//     url  : "<?php echo base_url('admin/frontend/data/aktif_data')?>",
//     dataType : "JSON",
//             data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
//             success: function(data){
//                 defaultForm();
//             }
//         });
//     return false;
// }

// function nonaktif(id){
//     $.ajax({
//     type : "POST",
//     url  : "<?php echo base_url('admin/frontend/data/nonaktif_data')?>",
//     dataType : "JSON",
//             data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
//             success: function(data){
//                 defaultForm();
//             }
//         });
//     return false;
// }

// function download(id){ 
//     $.ajax({
//         type : "GET",
//         url  : "<?php echo base_url('admin/frontend/data/get_data')?>",
//         dataType : "JSON",
//         data : {id:id},
//         success: function(data){
//             window.location.href = "<?= base_url() ?>assets_frontend/images/file_data/"+data.file; 
//         }
//     });
//     window.location.href = "<?= base_url('admin/frontend/kajian') ?>"; 
//     return false;
// }

$('#mydata').on('click','.item_kelola',function(){
    var id = $(this).attr('data');
    window.location.href = "<?= base_url('admin/frontend/data/detail_data/') ?>"+id; 
    
}); 

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
                'kajian yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});


$('#mydata').on('click','.item_download',function(){
    var id = $(this).attr('data');
    download(id);    
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

</script>