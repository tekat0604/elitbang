<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	var base_url = "<?php echo base_url();?>";    
	setTimeout(function(){
         $('#ubah_konten').summernote({
            toolbar:[
                 ['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ],                  
            height: 300,  
            focus: true 
         }); 
    }, 500); 
	   
	$.ajax({ 
		url			: base_url+'admin/frontend/profil/get_data_tugas_fungsi', 
		method 		: "POST", 
		dataType 	: "json",
		success 	: function(data){   
			setTimeout(function(){ 
				$("#ubah_konten").summernote("code",data.konten);  
			}, 500);
		}
	}); 
  
	$(document).on('submit','#submit_form_ubah', function(event){
		event.preventDefault(); 
		 
		$.ajax({ 
			url 		: base_url+'admin/frontend/profil/proses_ubah_tugas_fungsi', 
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
					$('#submit_form_ubah')[0].reset(); 
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