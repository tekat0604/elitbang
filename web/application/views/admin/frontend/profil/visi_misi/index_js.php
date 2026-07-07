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
		url			: base_url+'admin/frontend/profil/get_data_visi_misi', 
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
			url 		: base_url+'admin/frontend/profil/proses_ubah_visi_misi', 
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

});
</script>