<script type="text/javascript" language="javascript" >
$(document).ready(function(){ 
	var base_url = "<?php echo base_url();?>"; 
	Load_Data();
	$(document).on('click','.hapus', function(){
		var ID = $(this).data('id'); 
		$("#id_hapus").val(ID);
		$('.modal-title').html('<i class="mdi mdi-alert-outline"></i> Konfirmasi');
	});
	$(document).on('click','#konfirmasi_hapus', function(q){
		q.preventDefault(); 
		var id_hapus = $("#id_hapus").val(); 
		$.ajax({
			url			: base_url+'admin/frontend/profil_pegawai/prosesHapus', 
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
	$('#tambah_data').click(function(){
		$("#tambah_nip").focus();
		setTimeout(function(){
			$('#tambah_image_preview_container').html("");  
			$('#tambah_image_label').text("");   
		}, 500);  
		$('#submit_form_tambah')[0].reset();
	});
	
	$(document).on('click','.fileinput-exists', function(){
		setTimeout(function(){
			$('#tambah_image_preview_container').html("");  
			$('#tambah_image_label').text(""); 
			$('#ubah_image_preview_container').html("");  
			$('#ubah_image_label').text(""); 
		}, 100);
	});
	
	$(document).on('click','.update', function(){
		$('#ubah_image_label').text("");
		var get_id = $(this).attr("id"); 
		$.ajax({ 
			url			: base_url+'admin/frontend/profil_pegawai/get_id', 
			method 		: "POST",
			data 		: {id:get_id}, 
			dataType 	: "json",
			success 	: function(data){
				var src_img = base_url+'uploads/profil_anggota/small/'+data.image; 
				$('#formModalUbah').modal('show'); 
				$("#ubah_id").val(get_id); 
				setTimeout(function(){ 
					$("#ubah_nip").val(data.nip);
					$("#ubah_nama").val(data.nama); 
					$("#ubah_tempat_lahir").val(data.tempat_lahir);
					$("#ubah_tanggal_lahir").val(data.tanggal_lahir);
					$("#ubah_pangkat_golru").val(data.pangkat_golru);
					$("#ubah_tmt_pangkat").val(data.tmt_pangkat); 
					$("#ubah_jabatan").val(data.jabatan);
					$("#ubah_tmt_jabatan").val(data.tmt_jabatan);
					$("#ubah_formasi").val(data.formasi);
					$("#ubah_unit_kerja").val(data.unit_kerja);
					$("#ubah_pendidikan").val(data.pendidikan);
					$("#ubah_alamat").val(data.alamat);
					$("#ubah_link").val(data.link);
					if(data.image!=''){
						$('#ubah_image_preview_container').html(
							`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
								<img src="`+src_img+`" style="width: 100%; height: 100%;vertical-align:middle"/> 
								<div style="margin-top: 5px;">
									<button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="ubah_image"> 
									<i class="fa fa-remove"></i> Hapus </button>
								</div> 
							</div>
						`);
					}else{
						$('#ubah_image_preview_container').html('');
					} 
					$('#kosongkan_ubah_image').val(''); 
				}, 500);
			}
		});
	});

	$(document).on('submit','#submit_form_tambah', function(event){
		event.preventDefault();  
		var nip 		= $('#tambah_nip').val(); 
		var nama 		= $('#tambah_nama').val(); 
		var extension 	= $('#tambah_image').val().split('.').pop().toLowerCase();
		if(extension 	!= ''){
			$('.validasi').text(''); 
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ 
				Swal.fire({
					icon    : 'warning',
					title 	: 'Warning!',
					text 	: 'File Gambar tidak sesuai!',
					type 	: 'warning'
		        });
		        $('#tambah_image_preview_container').html(''); 
		        $('#tambah_image_label').text('Silahkan pilih file...'); 
		        $('#tambah_image').val(''); 
				return false;
			}
		}
		if(nip==""){
			$('.validasi').text(''); 
			$('#error_tambah_nip').html('<p class="text-danger"> <i class="fa fa-warning"></i> NIP tidak boleh kosong</p>'); 
			$('#tambah_nip').focus(); 
		}else if(nama==""){
			$('.validasi').text(''); 
			$('#error_tambah_nama').html('<p class="text-danger"> <i class="fa fa-warning"></i> Nama tidak boleh kosong</p>'); 
			$('#tambah_nama').focus(); 
		}else{
			$('.validasi').text(''); 
			$.ajax({ 
				url 		: base_url+'admin/frontend/profil_pegawai/prosesTambah', 
				method 		: "POST",
				data 		: new FormData(this),
				dataType 	: 'JSON',
				contentType : false,
				processData : false,
				success 	: function(res){
					if(res=="ok"){
						Swal.fire({
			                title 	: 'Sukses!',
			                text 	: 'Data berhasil disimpan!',
			                type 	: 'success',
			                timer 	: 1500
			            }); 
						$('#submit_form_tambah')[0].reset();
						$('#formModalTambah').modal('hide');
						Load_Data();
					}else{
						Swal.fire({
							icon    : 'error',
							title   : 'Gagal',
							text    : 'Data gagal di simpan.', 
							type    : 'error',
				        });
					}
				}
			});
		}
	});
	//Edit Kegiatan
	$(document).on('submit','#submit_form_ubah', function(event){
		event.preventDefault(); 
		var nip 		= $('#ubah_nip').val();   
		var nama 		= $('#ubah_nama').val();   
		var extension 	= $('#ubah_image').val().split('.').pop().toLowerCase();

		if(extension 	!= ''){
			$('.validasi').text(''); 
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ 
				Swal.fire({
					icon    : 'warning',
					title 	: 'Warning!',
					text 	: 'File Gambar tidak sesuai!',
					type 	: 'warning'
		        });
		        $('#ubah_image_preview_container').html(''); 
		        $('#ubah_image_label').text('Silahkan pilih file...'); 
		        $('#ubah_image').val(''); 
				return false;
			}
		}
		if(nip==""){
			$('.validasi').text(''); 
			$('#error_ubah_nip').html('<p class="text-danger"> <i class="fa fa-warning"></i> NIP tidak boleh kosong</p>'); 
			$('#ubah_nip').focus(); 
		}else if(nama==""){
			$('.validasi').text(''); 
			$('#error_ubah_nama').html('<p class="text-danger"> <i class="fa fa-warning"></i> Nama tidak boleh kosong</p>'); 
			$('#ubah_nama').focus(); 
		}else{
			$('.validasi').text(''); 
				$.ajax({ 
				url 		: base_url+'admin/frontend/profil_pegawai/prosesUbah', 
				method 		: "POST",
				data 		: new FormData(this),
				dataType 	: 'JSON',
				contentType : false,
				processData : false,
				success 	: function(res){ 
					if(res=="ok"){
						Swal.fire({
			                icon    : 'success',
			                title 	: 'Sukses!',
			                text 	: 'Data berhasil disimpan!',
			                type 	: 'success',
			                timer 	: 1500
			            }); 
						$('#submit_form_ubah')[0].reset();
						$('#formModalUbah').modal('hide');
						Load_Data();
					}else{
						Swal.fire({
			                icon    : 'error',
			                title   : 'Gagal',
			                text    : 'Data Gagal disimpan!', 
			                type    : 'error',
			            });
					}
				}
			});
		}
	});

	function Load_Data(){
		table = $('#myTable').DataTable({
			destroy 	: true,
			pagingType	: "full_numbers",
			//columnDefs	: [ { orderable: true, targets: [ 4 ] } ],
			pageLength	: 10, 
			autoWidth	: false, 
			ajax		: base_url+'admin/frontend/profil_pegawai/get_data', 
			columns: [
				{'data': (d)=>{
					return d.no;
				}},  
				{'data': (d)=>{
					var img = '';  
					if(d.image==null || d.image==""){ 
						img += "";  
					}else{
						img += '<img src="'+base_url+'uploads/profil_anggota/small/'+d.image+'" style="width: 80px;">';  
					}
					return img;
				}},
				{'data': 'nip'},
				{'data': 'nama'},
				{'data': (d)=>{
					var ttl = '';  
					ttl += ' '+d.tempat_lahir+', '+d.tanggal_lahir+' ';   
					return ttl;
				}}, 
				{'data': 'jabatan'},
				{'data': (d)=>{
					var btn = '';  
					btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 update" id="'+d.id+'">';  
					btn += '<i class="fa fa-edit"></i> Ubah </button> '; 
					btn += '<button type="button" class="btn btn-secondary mr-5 mb-5 hapus"';  
					btn +='data-toggle="modal" data-id="'+d.id+'" data-target="#konfirmasi_hapus_modal">';
					btn += '<i class="fa fa-trash"></i> Hapus </button>'; 
					return btn;
				}},
			],
			"aoColumnDefs" : [{
				"aTargets": [0],
				'bSortable': false,
				'sWidth': '50px',
				'sClass': 'text-center',
			},{
				"aTargets": [1],
				'bSortable': false,
				'sWidth': '90px',
				'sClass': 'text-center',
			},{
				"aTargets": [2],
				'bSortable': false,
				'sWidth': '110px',
				'sClass': 'text-left',
			},{
				"aTargets": [3],
				'bSortable': false,
				'sWidth': '200px',
				'sClass': 'text-left',
			},{
				"aTargets": [4],
				'bSortable': false,
				'sWidth': '200px',
				'sClass': 'text-left',
			},{
				"aTargets": [5],
				'bSortable': false,
				'sWidth': '100px',
				'sClass': 'text-left',
			},{
				"aTargets": [6],
				'bSortable': false,
				'sWidth': '150px',
				'sClass': 'text-center',
			}],
		}); 
	} 


	$('#tambah_image').change(function(e){ 
		var label_text = $(this).val();
		if(label_text.length > 50) label_text = label_text.substring(0,47)+'...';
		$('#tambah_image_label').text(label_text);
		file_preview(this,'tambah_image');
	});
	$('#ubah_image').change(function(e){
		var label_text = $(this).val();
		if(label_text.length > 50) label_text = label_text.substring(0,47)+'...';
		$('#ubah_image_label').text(label_text);
		file_preview(this,'ubah_image');
	});

	function file_preview(input,id_name){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) { 
				$('#'+id_name+'_preview').remove(); 
				$('#'+id_name+'_preview_container').html(
				`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
					<img src="`+e.target.result+`" 
					style="width: 100%; height: 100%;vertical-align:middle"/>
					<div style="margin-top: 5px;">
						<button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="`+id_name+`"> 
						<i class="fa fa-remove"></i> Hapus </button>
					</div>  
				</div>			
				`);
				if(id_name=="ubah_image"){
		        	$('#kosongkan_ubah_image').val(''); 
		        }
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).on('click','.hapus_image',function(){ 
		var id_name  = $(this).attr("id_name");  
		$('#'+id_name+'_preview_container').html(''); 
        $('#'+id_name+'_label').text('Silahkan pilih file...');
        $('#'+id_name+'').val('');
        if(id_name=="ubah_image"){
        	$('#kosongkan_ubah_image').val('1'); 
        }
    });

});
</script>