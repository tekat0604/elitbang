<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	var base_url = "<?php echo base_url();?>";    
	var get_id = "<?php echo $this->uri->segment(4);?>"; 
	$(document).on('click','.fileinput-exists', function(){
		setTimeout(function(){
			$('#ubah_image_preview_container').html("");  
			$('#ubah_label_image').text(""); 
		}, 100);
	});
	$('#ubah_label_image').text(""); 
	$.ajax({  
		url			: base_url+'admin/korban_bencana/get_id', 
		method 		: "POST", 
		data 		: {id:get_id}, 
		dataType 	: "JSON",
		success 	: function(data){  
			var src_img = base_url+'uploads/korban_bencana/small/'+data.image; 
			setTimeout(function(){ 
				$('#ubah_id').val(data.id);  
				$('#ubah_nik').val(data.nik);  
				$('#ubah_nomor_kk').val(data.nomor_kk);  
				$('#ubah_nama_lengkap').val(data.nama_lengkap); 
				$('#ubah_jenis_kelamin').val(data.jenis_kelamin);  
				$('#ubah_tempat_lahir').val(data.tempat_lahir);  
				$('#ubah_tanggal_lahir').val(data.tanggal_lahir);  
				$('#ubah_rt').val(data.rt); 
				$('#ubah_rw').val(data.rw); 
				$('#ubah_alamat_lengkap').val(data.alamat_lengkap);
				$('#ubah_id_kecamatan').val(data.id_kecamatan);   
				$('#ubah_kabupaten').val(data.kabupaten); 
				$('#ubah_id_kategori').val(data.id_kategori);  
				$('#ubah_keterangan').val(data.keterangan);
				if(data.image!='' && data.image!=null){
					$('#ubah_image_preview_container').html(
						`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px; background: rgba(0,0,0,0.1);">
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
				loadKelurahan(data.id_kecamatan);
			}, 500);
			setTimeout(function(){ 
				$('#ubah_id_kelurahan').val(data.id_kelurahan);  
			}, 1200);
		}
	}); 
  
	$(document).on('submit','#submit_form_ubah', function(event){
		event.preventDefault(); 
		var nik 				= $('#ubah_nik').val();   
		var extension 			= $('#ubah_image').val().split('.').pop().toLowerCase();
		var nama_lengkap        = $("#ubah_nama_lengkap").val(); 
        var tempat_lahir        = $("#ubah_tempat_lahir").val(); 
        var tanggal_lahir       = $("#ubah_tanggal_lahir").val(); 
        var kategori_bencana    = $("#ubah_id_kategori").val();  

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
		        $('#ubah_label_image').text('Silahkan pilih file...'); 
		        $('#ubah_image').val(''); 
				return false;
			}
		}
		if(nik==""){
			$('.validasi').text(''); 
			$('#error_ubah_nik').html('<p class="text-danger"> <i class="fa fa-warning"></i> NIK tidak boleh kosong</p>'); 
			$('#ubah_nik').focus(); 
		}else if(nama_lengkap==""){ 
            $("#error_ubah_nama_lengkap").html('<div class="text-danger">Nama Lengkap harus di isi</div>');
            $("#ubah_nama_lengkap").focus();
        }else if(kategori_bencana==""){ 
            $("#error_ubah_id_kategori").html('<div class="text-danger">Kategori Bencana belum di pilih</div>');
            $("#ubah_id_kategori").focus();
        }else{
			$('.validasi').text(''); 
				$.ajax({  
				url			: base_url+'admin/korban_bencana/prosesUbah', 
				method 		: "POST",
				data 		: new FormData(this),
				dataType 	: 'JSON',
				contentType : false,
				processData : false,
				success 	: function(res){ 
                    //alert(res);
					if(res=="ok"){
						Swal.fire({
			                icon    : 'success',
			                title 	: 'Sukses!',
			                text 	: 'Data berhasil disimpan!',
			                type 	: 'success',
			                timer 	: 1500
			            });  
						setTimeout(function(){
                            window.location.href = '../';
                        },1600); 
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

//DATA FERERENSI Ketegori Bencana
$.ajax({
        url         : base_url+'admin/korban_bencana/select_kategori_bencana',
        type        : 'POST',
        dataType    : 'JSON',
        success     : function(data){
            var html = "<option value=''>--- Silakan Pilih Kategori Bencana ---</option>";
            for (var i = 0; i < data.length; i++) { 
                html += "<option value='"+data[i].id+"'>"+data[i].nama_kategori_bencana+"</option>";
            }
            $("#ubah_id_kategori").html(html);
        }
    });


//DATA FERERENSI KECAMATAN
$.ajax({
        url         : base_url+'admin/korban_bencana/select_kecamatan',
        type        : 'POST',
        dataType    : 'JSON',
        success     : function(data){
            var html = "<option value=''>--- Silakan Pilih Kecamatan ---</option>";
            for (var i = 0; i < data.length; i++) { 
                html += "<option value='"+data[i].kecamatan_id+"'>"+data[i].kecamatan_nama+"</option>";
            }
            $("#ubah_id_kecamatan").html(html);
        }
    });

    function getKelurahan(selectObject) {
        var kecamatan_id = selectObject.value;  
        loadKelurahan(kecamatan_id);
    }

    function loadKelurahan(kecamatan_id) {  
        $.ajax({ 
            url         : base_url+'admin/korban_bencana/select_kelurahan_by_kec',
            type        : 'POST',
            dataType    : 'JSON',
            data        : {kecamatan_id:kecamatan_id},
            success: function(data){
                var html = "<option value=''>--- Silakan Pilih Kelurahan ---</option>";
                for (var i = 0; i < data.length; i++) { 
                    html += "<option value='"+data[i].no_kelurahan+"'>"+data[i].kelurahan_nama+"</option>";
                }
                $("#ubah_id_kelurahan").html(html);
            }
        }); 
    }
</script>