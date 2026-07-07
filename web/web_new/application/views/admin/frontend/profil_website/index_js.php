<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	var base_url = "<?php echo base_url();?>";    
	$(document).on('click','.fileinput-exists', function(){
		setTimeout(function(){
			$('#ubah_image_preview_container').html("");  
			$('#ubah_label_image').text(""); 
		}, 100);
	});
	 
	$('#ubah_label_image').text(""); 
		$.ajax({ 
			url			: base_url+'admin/frontend/profil_website/get_data_profil', 
			method 		: "POST", 
			dataType 	: "json",
			success 	: function(data){ 
				var src_img = base_url+'uploads/logo/'+data.image;
				setTimeout(function(){ 
					$("#ubah_judul").val(data.judul);     
					$("#ubah_alamat").val(data.alamat);    
					$("#ubah_telepon").val(data.telepon);    
					$("#ubah_email").val(data.email);    
					$("#ubah_facebook").val(data.facebook);    
					$("#ubah_twitter").val(data.twitter);    
					$("#ubah_google_plus").val(data.google_plus);    
					$("#ubah_linkedin").val(data.linkedin);    
					$("#ubah_dribbble").val(data.dribbble);    
					$("#ubah_whatsapp").val(data.whatsapp);    
					$("#ubah_lokasi").val(data.lokasi);   
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
				}, 500);
			}
	}); 
  
	$(document).on('submit','#submit_form_ubah', function(event){
		event.preventDefault(); 
		var judul 		= $('#ubah_judul').val();   
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
		        $('#ubah_label_image').text('Silahkan pilih file...'); 
		        $('#ubah_image').val(''); 
				return false;
			}
		}
		if(judul==""){
			$('.validasi').text(''); 
			$('#error_ubah_judul').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>'); 
			$('#ubah_judul').focus(); 
		}else{
			$('.validasi').text(''); 
				$.ajax({ 
				url 		: base_url+'admin/frontend/profil_website/proses_ubah_profil', 
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
</script>