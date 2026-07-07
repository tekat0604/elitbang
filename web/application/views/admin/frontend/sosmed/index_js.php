<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-sosmed').on('shown.bs.modal', function (e) {
    $("#facebook").focus();
});

$('#modal-sosmed').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_opd(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/sosmed/daftar_sosmed',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].facebook+'</td>'+
                        '<td style="text-align: left;">'+data[i].twitter+'</td>'+
                        '<td style="text-align: left;">'+data[i].linkedin+'</td>'+
                        '<td style="text-align: left;">'+data[i].dribbble+'</td>'+
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
    $("#facebook").val(""); 
    $("#twitter").val(""); 
    $("#linkedin").val(""); 
    $("#dribbble").val(""); 
    $("#id").val("");
    // $("h3.block-title").html("Tambah Identitas Sosial Media");
}

$('#form_sosmed').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/sosmed/form_sosmed',
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
                text : 'Data Sosial Media berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-sosmed').modal('hide');
        }
    });
    return false;
});

$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/sosmed/get_sosmed')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){ 
            console.table(data);
            $("h3.block-title").html("Ubah Sosial Media");
            $('#modal-sosmed').modal('show');
            $('[name="id"]').val(id);
            $('[name="facebook"]').val(data.facebook);  
            $('[name="twitter"]').val(data.twitter);  
            $('[name="linkedin"]').val(data.linkedin);  
            $('[name="dribbble"]').val(data.dribbble);
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/referensi/hapus_sosmed')?>",
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
                'Sosial Media yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});

</script>