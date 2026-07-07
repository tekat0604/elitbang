<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$( ".date_picker" ).datepicker(); 
	var base_url = "<?php echo base_url();?>"; 
	Load_Data();
	$("#filter_kategori" ).change(function() {
		Load_Data();
	});
	$("#filter_kecamatan" ).change(function() {
		Load_Data();
	});
	$("#filter_kelurahan" ).change(function() {
		Load_Data();
	});
	$(document).on('click','.hapus', function(){
		var ID = $(this).data('id'); 
		$("#id_hapus").val(ID);
		$('.modal-title').html('<i class="mdi mdi-alert-outline"></i> Konfirmasi');
	});
	$(document).on('click','#konfirmasi_hapus', function(q){
		q.preventDefault(); 
		var id_hapus = $("#id_hapus").val(); 
		$.ajax({
			url			: base_url+'admin/korban_bencana/prosesHapus', 
			method 		: "POST", 
			dataType 	: 'JSON',
			data 		: {id:id_hapus}, 
			success 	: function(res){
				if(res=="ok"){
					Swal.fire({
						title 	: 'Sukses!',
						text 	: 'Data berhasil di hapus.',
						type 	: 'success',
						timer 	: 1500
			        }); 
					$('#hapus_form')[0].reset(); 
					$('#konfirmasi_hapus_modal').modal('hide');
					Load_Data();
				}else{
					Swal.fire({
						icon    : 'error',
						title   : 'Gagal',
						text    : 'Data gagal di hapus.', 
						type    : 'error',
			        });
				}
			}
		});
	});

	$(document).on('click','.detail', function(){ 
		var get_id = $(this).attr("id"); 
		$.ajax({ 
			url			: base_url+'admin/korban_bencana/get_id', 
			method 		: "POST",
			data 		: {id:get_id}, 
			dataType 	: "JSON",
			success 	: function(data){  
				var src_img = base_url+'uploads/korban_bencana/small/'+data.image;  
				$('#ModalDetail').modal('show');  
				$('#detail_nik').text(data.nik);  
				$('#detail_nomor_kk').text(data.nomor_kk);  
                $('#detail_nama_lengkap').text(data.nama_lengkap); 
                $('#detail_jenis_kelamin').text(data.jenis_kelamin);  
                $('#detail_rt').text(data.rt); 
                $('#detail_rw').text(data.rw); 
                $('#detail_alamat_lengkap').text(data.alamat_lengkap);  
                $('#detail_kelurahan').text(data.kelurahan);  
                $('#detail_kecamatan').text(data.kecamatan);   
                $('#detail_kabupaten').text(data.kabupaten); 
                $('#detail_kategori_bencana').text(data.kategori_bencana);  
				$('#detail_keterangan').text(data.keterangan);   

				setTimeout(function(){ 
					if(data.image!='' && data.image!=null){
						$('#detail_foto').html(` <img src="`+src_img+`" style="width: 150px;vertical-align:middle"/>`);
					}else{
						$('#detail_foto').html('');
					}
					 
				}, 500);
			}
		});
	});

    //DATA FERERENSI UBAH KATEGORI
    $.ajax({
        url         : base_url+'admin/korban_bencana/select_kategori_bencana',
        type        : 'POST',
        dataType    : 'JSON',
        success     : function(data){
            
            var html = "<option>--- Silakan Pilih Kategori Bencana ---</option>";
         
            for (var i = 0; i < data.length; i++) { 
                html += "<option value='"+data[i].id+"'>"+data[i].nama_kategori_bencana+"</option>";
            }

            $("#ubah_id_kategori").html(html);
        }
    });


	function Load_Data(){
		var id_kategori 	= $('#filter_kategori').val();
		var id_kecamatan 	= $('#filter_kecamatan').val();
		var id_kelurahan 	= $('#filter_kelurahan').val();  
		table = $('#myTable').DataTable({
			destroy 		: true,
			pagingType		: "full_numbers",
			//columnDefs	: [ { orderable: true, targets: [ 4 ] } ],
			pageLength		: 10, 
			autoWidth		: false, 
			//ajax			: base_url+'admin/korban_bencana/get_data', 
			ajax			: {
				url 		: base_url+'admin/korban_bencana/get_data', 
				type 		: "POST",
				dataType 	: 'JSON',
        		data 		: {id_kategori: id_kategori, id_kecamatan: id_kecamatan, id_kelurahan: id_kelurahan},
			},
			columns: [
				{'data': (d)=>{
					return d.no;
				}}, 
				{'data': (d)=>{
					var profil = '';  
					profil = `
					<div class="d-flex align-items-center">
						<div style="width: 60px!important; float: left; "   > 
							<div class="circle_avatar">
								<span style=""> `+d.first_name+` </span> 
							</div>
						</div>
						<div style="width: 150px!important; float: left; background: #fff;">
							<h6 class="mb-0"> `+d.nama_lengkap+` </h6>
							<span class=""> `+d.nik+` </span> 
						</div>
					</div>`; 
					return profil;
				}},
				{'data': (d)=>{
					var img = '';  
					if(d.image==null || d.image==""){ 
						img += "";  
					}else{
						img += '<img src="'+d.image+'" style="width: 75px;">';  
					}
					return img;
				}}, 
				{'data': (d)=>{
					var alamat = '';  
					alamat = `
					<table style="padding: 0px;" cellspacing="0" cellpadding="0" >
						<tr style="background-color: rgba(255,255,255,0.9)!important;"> 
							<td style="width: 70px; padding: 0px; border: 0px;"> Kec./Kel. </td> 
							<td style="width: 10px; padding: 0px; border: 0px;"> : </td> 
							<td style="width: auto; padding: 0px; border: 0px;">`+d.kecamatan+`/`+d.kelurahan+` </td> 
						</tr>  
						<tr style="background-color: rgba(255,255,255,0.9)!important;"> 
							<td style="width: 70px; padding: 0px; border: 0px;"> Almt </td> 
							<td style="width: 10px; padding: 0px; border: 0px;"> : </td> 
							<td style="width: auto; padding: 0px; border: 0px;"> `+d.alamat_lengkap+` </td> 
						</tr> 
						<tr style="background-color: rgba(255,255,255,0.9)!important;"> 
							<td style="width: 70px; padding: 0px; border: 0px;"> RT/RW. </td> 
							<td style="width: 10px; padding: 0px; border: 0px;"> : </td> 
							<td style="width: auto; padding: 0px; border: 0px;"> `+d.rt+`/`+d.rw+` </td> 
						</tr> 
					</table>`; 
					return alamat;
				}},
				{'data': 'kategori_bencana'},
				{'data': (d)=>{
					var btn = '';  
					btn = ` 
					<div class="btn-group" role="group" aria-label="btnGroup2">
						<button type="button" class="btn btn-secondary detail" id="`+d.id+`"> 
							<i class="fa fa-eye"></i> 
						</button>
						<a href="`+base_url+`admin/korban_bencana/edit/`+d.id+`" class="btn btn-secondary"> <i class="fa fa-pencil"></i> </a>
						<button type="button" class="btn btn-secondary hapus" data-toggle="modal" data-id="`+d.id+`" 
						data-target="#konfirmasi_hapus_modal">
							<i class="fa fa-trash"></i>
						</button>
					</div>`; 
					return btn;
				}},
			],
			"aoColumnDefs" : [{
				"aTargets": [0],
				'bSortable': false,
				'sWidth': '30px',
				'sClass': 'text-center',
			},{
				"aTargets": [1],
				'bSortable': false,
				'sWidth': '170px',
				'sClass': 'text-left',
			},{
				"aTargets": [2],
				'bSortable': false,
				'sWidth': '100px',
				'sClass': 'text-center',
			},{
				"aTargets": [3],
				'bSortable': false,
				'sWidth': '100px',
				'sClass': 'text-left',
			},{
				"aTargets": [4],
				'bSortable': false,
				'sWidth': '100px',
				'sClass': 'text-left',
			},{
				"aTargets": [5],
				'bSortable': false,
				'sWidth': '150px',
				'sClass': 'text-center',
			}],
		}); 
	}	 
});
//DATA FERERENSI Ketegori Bencana
$.ajax({
    url         : base_url+'admin/korban_bencana/select_kategori_bencana',
    type        : 'POST',
    dataType    : 'JSON',
    success     : function(data){
        var html = "<option value=''>--- Pilih Kategori Bencana ---</option>";
        for (var i = 0; i < data.length; i++) { 
            html += "<option value='"+data[i].id+"'>"+data[i].nama_kategori_bencana+"</option>";
        }
        $("#filter_kategori").html(html);
    }
});


//DATA FERERENSI KECAMATAN
$.ajax({
    url         : base_url+'admin/korban_bencana/select_kecamatan',
    type        : 'POST',
    dataType    : 'JSON',
    success     : function(data){
        var html = "<option value=''>--- Pilih Kecamatan ---</option>";
        for (var i = 0; i < data.length; i++) { 
            html += "<option value='"+data[i].kecamatan_id+"'>"+data[i].kecamatan_nama+"</option>";
        }
        $("#filter_kecamatan").html(html);
    }
});
function getKelurahan(selectObject) {
	var kecamatan_id = selectObject.value;  
    $.ajax({ 
        url         : base_url+'admin/korban_bencana/select_kelurahan_by_kec',
        type        : 'POST',
        dataType    : 'JSON',
        data        : {kecamatan_id:kecamatan_id},
        success: function(data){
            var html = "<option value=''>--- Pilih Kelurahan ---</option>";
            for (var i = 0; i < data.length; i++) { 
                html += "<option value='"+data[i].no_kelurahan+"'>"+data[i].kelurahan_nama+"</option>";
			}
            $("#filter_kelurahan").html(html);
         }
    }); 
}
jumlah_korban();
function jumlah_korban(){
		//DATA FERERENSI UBAH KATEGORI
		$.ajax({
        url         : base_url+'admin/korban_bencana/jumlah_korban',
        type        : 'POST',
        dataType    : 'JSON',
        success     : function(data){
			// alert(data.data_korban.length); 
			// console.log(data.data_korban);
			var html_total_korban = `
				<div class="col-6 col-xl-4">
					<a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
						<div class="block-content block-content-full clearfix">
							<div class="float-right mt-15 d-none d-sm-block">
								<i class="si si-users fa-2x text-primary-light"></i>
							</div>
							<div class="font-size-h3 font-w600 js-count-to-enabled" 
							style="color: #42a5f5!important;" data-toggle="countTo" data-speed="1000" data-to="1500">
								`+data.data_semua_korban+`
							</div>
							<div class="font-size-sm font-w600 text-uppercase text-muted"> Semua Korban</div>
                        </div>
                    </a>
                </div> `;
            var html = "";
            for (var i = 0; i < data.data_korban.length; i++) {  
                html += `<div class="col-6 col-xl-4">
                            <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-right mt-15 d-none d-sm-block">
                                        <i class="si si-users fa-2x text-elegance-light"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-elegance">
										<span data-toggle="countTo" data-speed="1000" data-to="`+data.data_semua_korban+`" 
										class="js-count-to-enabled">
										`+data.data_korban[i].total_korban+` 
										</span>
									</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted"> 
									`+data.data_korban[i].kategori+` 
									</div>
                                </div>
                            </a>
                        </div>` ;
            }
			$("#data_jumlah_semua_korban_bencana").html(html_total_korban);
			$("#data_jumlah_kategori_bencana").html(html);
        }
    });
}
</script>