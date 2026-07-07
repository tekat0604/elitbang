<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-website').on('shown.bs.modal', function (e) {
    $("#nama_sistem").focus();
});

$('#modal-website').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_opd(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/website/daftar_website',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].nama_sistem+'</td>'+
                        '<td style="text-align: left;">'+data[i].logo_header+'</td>'+
                        '<td style="text-align: left;">'+data[i].logo_footer+'</td>'+
                        '<td style="text-align: left;">'+data[i].alamat+'</td>'+
                        '<td style="text-align: left;">'+data[i].nomor_telpon+'</td>'+
                        '<td style="text-align: left;">'+data[i].email+'</td>'+
                        '<td style="text-align: left;">'+data[i].text_footer+'</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+data[i].id+'"><i class="fa fa-edit"></i></button> '+ 
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

function defaultForm() {
    daftar_opd();
    $("#nama_sistem").val("");
    $("#logo_header").val("");
    $("#logo_footer").val("");
    $("#alamat").val("");
    $("#nomor_telpon").val("");
    $("#email").val("");
    $("#text_footer").val(""); 
    $("#id").val("");
    // $("h3.block-title").html("Tambah Identitas Website");
}

$('#form_website').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/website/form_website',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){ 
            daftar_opd();
            Swal.fire({
                title : 'Sukses!',
                text : 'Data Website berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-website').modal('hide');
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/website/get_website')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){ 
            console.table(data);
            $("h3.block-title").html("Ubah Website");
            $('#modal-website').modal('show');
            $('[name="id"]').val(id);
            $('[name="nama_sistem"]').val(data.nama_sistem);  
            $('#logo_header').attr('src','<?= base_url('assets_frontend/assets/images/') ?>'+data.logo_header);  
            $('#logo_footer').attr('src','<?= base_url('assets_frontend/assets/images/') ?>'+data.logo_footer);  
            $('[name="text_footer"]').val(data.text_footer); 
            $('[name="alamat"]').val(data.alamat); 
            $('#nomor_telpon').val(data.nomor_telpon); 
            $('#email').val(data.email);  
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/referensi/hapus_website')?>",
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
                'Website yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

</script>