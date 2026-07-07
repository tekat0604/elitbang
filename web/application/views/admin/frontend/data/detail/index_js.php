<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
var id = '<?= $this->uri->segment(5) ?>';
var id_atribut = '';
$("#id_atribut").select2();  

$.ajax({
    url: '<?= base_url('admin/frontend/data/select_atribut/')?>'+id,
    type: 'POST',
    dataType: 'JSON',
    success: function(data){
        console.table(data);
        var html = "<option>--- Silakan Pilih Atribut ---</option>";
     
        for (var i = 0; i < data.length; i++) {
            var selected = "";
            // if(id_atribut == data[i].id){
            //     selected = "selected";
            // }
            html += "<option value='"+data[i].id+"'>"+data[i].nama+"</option>";
        }

        $("#id_atribut").html(html);
    }
});

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
    table_data = $('#mydata').DataTable();
    table_data.destroy();
    table_data.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/data/daftar_detail_data/'+id,
        async : false,
        dataType : 'json', 
        success : function(response){ 
            var html = '';
            var i; var tombol_tampil = "";
            for(i=0; i<response.length; i++){ 
                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+response[i].judul+'</td>'+  
                        '<td style="text-align: left;">'+response[i].deskripsi+'</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'+response[i].id+'"><i class="fa fa-pencil"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }
    });
    $('#mydata').DataTable();
}

function daftar_atribut(){
    table_atribut = $('#mydata_atribut').DataTable();
    table_atribut.destroy();
    table_atribut.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/data/daftar_atribut_data/'+id,
        async : false,
        dataType : 'json', 
        success : function(data){ 
            var html = '';
            var i; var tombol_atribut_tampil = "";
            for(i=0; i<data.length; i++){ 
                // tombol tampil
                if (data[i].tampil == '0') {
                    tombol_atribut_tampil = '<button type="button" class="btn btn-sm btn-danger mb-10 item_atribut_tampil_aktif" data="'+data[i].id+'"><i class="fa fa-times"></i></button> ';
                } else {
                    tombol_atribut_tampil = '<button type="button" class="btn btn-sm btn-success mb-10 item_atribut_tampil_nonaktif" data="'+data[i].id+'"><i class="fa fa-check"></i></button> ';
                }

                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].nama+'</td>'+                        
                        '<td style="text-align: center;">'+tombol_atribut_tampil+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit_atribut" data="'+data[i].id+'"><i class="fa fa-pencil"></i></button> '+
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus_atribut" data="'+data[i].id+'"><i class="fa fa-trash"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data_atribut').html(html);
        }
    });
    $('#mydata_atribut').DataTable();
}

function daftar_detail(){
    table_atribut = $('#mydata_detail').DataTable();
    table_atribut.destroy();
    table_atribut.draw();
    $.ajax({
        type  : 'ajax',
        url   : '<?php echo base_url()?>admin/frontend/data/daftar_detail/'+id,
        async : false,
        dataType : 'json', 
        success : function(data){ 
            var html = '';
            var i; var tombol_detail_tampil = "";
            for(i=0; i<data.length; i++){ 
                // tombol tampil
                if (data[i].tampil == '0') {
                    tombol_detail_tampil = '<button type="button" class="btn btn-sm btn-danger mb-10 item_detail_tampil_aktif" data="'+data[i].id+'"><i class="fa fa-times"></i></button> ';
                } else {
                    tombol_detail_tampil = '<button type="button" class="btn btn-sm btn-success mb-10 item_detail_tampil_nonaktif" data="'+data[i].id+'"><i class="fa fa-check"></i></button> ';
                }

                html += '<tr>'+
                        '<td style="text-align: center;">'+(i+1)+'.</td>'+
                        '<td style="text-align: left;">'+data[i].nama_atribut+'</td>'+ 
                        '<td style="text-align: left;">'+data[i].tahun+'</td>'+ 
                        '<td style="text-align: left;">'+data[i].nilai+'</td>'+ 
                        '<td style="text-align: center;">'+tombol_detail_tampil+
                        '</td>'+
                        '<td style="text-align: center;">'+
                            '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit_detail" data="'+data[i].id+'"><i class="fa fa-pencil"></i></button> '+
                            '<button type="button" class="btn btn-sm btn-danger mb-10 item_hapus_detail" data="'+data[i].id+'"><i class="fa fa-trash"></i></button> '+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data_detail').html(html);
        }
    });
    $('#mydata_detail').DataTable();
}

function defaultForm() {
    daftar_data();
    daftar_atribut();
    daftar_detail();
    grafik();
    
    id_atribut = '';

    $("#nama_atribut").val(""); 

    $("#tahun").val(""); 
    $("#nilai").val(""); 

    $("#id_atribut").val("");
    $("#id_detail").val("");
}

function grafik() {
    $.ajax({
        type  : 'ajax', 
        url:'<?php echo base_url();?>admin/frontend/data/data_detail_grafik/'+id,
        async : false,
        dataType : 'json',
        success: function(response){
            console.log(response[0].res);
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Detail Data'
                }, 
                xAxis: {
                    categories: response[0].kategori
                },
                yAxis: {
                    title: {
                        text: 'Nilai'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: response[0].res
                //  series: [{
                //     name: 'Tokyo',
                //     data: ["7.0", "6.9", "9.5"]
                // }, {
                //     name: 'London',
                //     data: ["3.9", "4.2", "5.75"]
                // }]
            }); 
        }
    });
    return false;
    
}

$('#form_data_atribut').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/data/form_data_atribut',
        type:"post",
        data:new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(response){ 
            console.table(response.name);
            // menambah satu data di select2 tanpa refresh
            var sel = document.getElementById("id_atribut");
            var opt = document.createElement("option");
            opt.value = response.id;
            opt.text = response.nama;
            sel.add(opt, null); 

            daftar_data();
            Swal.fire({
                title : 'Sukses!',
                text : 'Data Data berhasil disimpan!',
                type: 'success',
                timer: 1500
            });
            defaultForm();
            $('#modal-data-atribut').modal('hide');

            window.location.href = "<?php echo base_url('admin/frontend/data/detail_data/'); ?>"+id;
        }
    });
    return false;
});

$('#form_data_detail').submit(function(e){
    e.preventDefault();
    $.ajax({
        url:'<?php echo base_url();?>admin/frontend/data/form_data_detail',
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
            $('#modal-data-detail').modal('hide');
        }
    });
    return false;
});

$('#show_data_atribut').on('click','.item_edit_atribut',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/data/get_atribut_data')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){ 
            $('#modal-data-atribut').modal('show');

            $("h3.block-title").html("Ubah Data Atribut");

            $('[name="id_atribut"]').val(id);
            $('#nama_atribut').val(data.nama);  
        }
    });
    return false;
});

$('#show_data_detail').on('click','.item_edit_detail',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "GET",
        url  : "<?php echo base_url('admin/frontend/data/get_detail_data')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){ 
            $('#modal-data-detail').modal('show');

            $("h3.block-title").html("Ubah Data Atribut");
            $("#id_atribut").val(data.id_ref_atribut_data).trigger('change');
            $('[name="id_detail"]').val(id);
            $('[name="tahun"]').val(data.tahun);  
            $('[name="nilai"]').val(data.nilai);  
        }
    });
    return false;
});

function hapus_atribut(id_atribut){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/hapus_data_atribut')?>",
    dataType : "JSON",
            data : {id_atribut: id_atribut, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
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

function hapus_detail(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/hapus_data_detail')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function aktif_atribut(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/aktif_data_atribut')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function nonaktif_atribut(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/nonaktif_data_atribut')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function aktif_detail(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/aktif_data_detail')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
}

function nonaktif_detail(id){
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('admin/frontend/data/nonaktif_data_detail')?>",
    dataType : "JSON",
            data : {id: id, '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function(data){
                defaultForm();
            }
        });
    return false;
} 

$('#mydata').on('click','.item_kelola',function(){
    var id = $(this).attr('data');
    window.location.href = "<?= base_url('admin/frontend/data/detail_data/') ?>"+id; 
    
}); 

$('#mydata_atribut').on('click','.item_hapus_atribut',function(){
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
            hapus_atribut(id); 
        }
    });
    
});

$('#mydata_detail').on('click','.item_hapus_detail',function(){
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
            hapus_detail(id);
            Swal.fire(
                'Terhapus!',
                'Atribut yang dipilih telah dihapus!',
                'success'
            );
        }
    });
    
});


$('#mydata_atribut').on('click','.item_atribut_tampil_aktif',function(){
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
            aktif_atribut(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di tampilkan',
                'success'
            );
        }
    });
    
});

$('#mydata_atribut').on('click','.item_atribut_tampil_nonaktif',function(){
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
            nonaktif_atribut(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di nonaktifkan',
                'success'
            );
        }
    });
    
});

$('#mydata_detail').on('click','.item_detail_tampil_aktif',function(){
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
            aktif_detail(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di tampilkan',
                'success'
            );
        }
    });
    
});

$('#mydata_detail').on('click','.item_detail_tampil_nonaktif',function(){
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
            nonaktif_detail(id);
            Swal.fire(
                'Berhasil!',
                'Data berhasil di nonaktifkan',
                'success'
            );
        }
    });
    
});
</script>