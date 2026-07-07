<script>

$(document).ready(function(){
    defaultForm();   //pemanggilan fungsi tampil barang.
});

$('#modal-periode').on('shown.bs.modal', function (e) {
    $("#periode").focus();
});

$('#modal-periode').on('hidden.bs.modal', function (e) {
    defaultForm();
});

function daftar_periode(){
    table = $('#mydata').DataTable();
    table.destroy();
    table.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/referensi/daftar_periode',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].periode+'</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-md btn-secondary mb-10 mr-5 item_edit" data="'+data[i].id+'"><i class="fa fa-edit"></i> Ubah </button> '+
                            '<button hidden type="button" class="btn btn-md btn-secondary mb-10 item_hapus" data="'+data[i].id+'"><i class="fa fa-trash"></i> Hapus </button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable({
        "columnDefs"    : [
            { "className": "text-center",   "width": "5%",  "targets": [ 0 ] },
            { "className": "text-left",     "width": "60%", "targets": [ 1 ] },
            { "className": "text-center",   "width": "30%", "targets": [ 2 ], "orderable": false },
        ],
    });
}

function defaultForm() {
    daftar_periode();
    $("#periode").val("");
    $("#id_periode").val("");
    $("h3.label_from").html("Tambah Periode");
}

$('#form_periode').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/referensi/form_periode',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){  
            Swal.fire({
                title : 'Sukses!',
                text : 'Data periode berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-periode').modal('hide');
        }
    });
    return false;
});
$('#show_data').on('click','.item_edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('admin/referensi/get_periode')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $.each(data,function(nama){
                $("h3.label_from").html("Ubah Periode");
                $('#modal-periode').modal('show');
                $('[name="id_periode"]').val(id);
                $('[name="periode"]').val(data.periode);
            });
        }
    });
    return false;
});

function hapus(id){
    $.ajax({
        type        : "POST",
        url         : "<?php echo base_url('admin/referensi/hapus_periode')?>",
        dataType    : "JSON",
        data        : {
            id: id 
        },
        success     : function(data){
            alert(data);
            defaultForm();
        }
    });
    return false;
}
$('#mydata').on('click','.item_hapus',function(){
    var id = $(this).attr('data');
    alert(id);
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#222',
        cancelButtonColor: '#999',
        confirmButtonText: 'Hapus sekarang!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            hapus(id);
            Swal.fire(
                'Terhapus!',
                'periode yang dipilih telah dihapus!',
                'success'
            );
        }
    });    
});
</script>