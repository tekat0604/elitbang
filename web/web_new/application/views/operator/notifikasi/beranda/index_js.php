<script type="text/javascript" language="javascript">	
	function Load_Data() {
		table = $('#myTable').DataTable({
			destroy: true,
			pagingType: "full_numbers",
			//columnDefs	: [ { orderable: true, targets: [ 4 ] } ],
			pageLength: 5,
			autoWidth: false,
			"ajax": {
					"url": base_url + 'operator/notifikasi/get_data',
					"dataSrc": "result"
				},		
			columns: [
				{
					render: (data, type, row)=>{
						console.log(row)
						let btn='';
						const edit = $('<p/>', {
							html: row.name+'<br>'+row.tgl_sug +' '+ row.jam_sug+'<br>'+row.mail +' - '+ row.telp+'<br>'+row.address,
							class: 'mr-1 mb-md-1 mb-2',
							id: 'item_edit',
							style: `font-size: 11px;`
						})
						btn += edit.prop('outerHTML');
						return btn;   
					},
				},
				{
					render: (data, type, row)=>{
						let btn='';
						const edit = $('<p/>', {
							html: row.title + '<br>'+row.cat+'' ,
							class: 'mr-1 mb-md-1 mb-2',
							id: 'item_edit',
							style: `font-size: 11px;`
						})
						btn += edit.prop('outerHTML');
						return btn;   
					},
				},					
				{
					'data': (d) => {							
						var btn = '';
						btn += '<a href="<?= base_url(); ?>operator/Pengungsian" class="btn btn-secondary mr-5 mb-5 click" id="btn" data-id="'+ d.id +'">';
						btn += '<i class="fa fa-edit"></i> Assesment </a> ';
						btn += '<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary mr-5 mb-5 clicks btns" data-id="'+ d.id +'" data-cat="'+ d.cat +'"  data-jam="'+ d.jam_sug +'" data-tgl="'+ d.tgl_sug +'" data-mail="'+ d.mail +'" data-name="'+ d.name +'" data-status="'+ d.status +'" data-telp="'+ d.telp +'" data-unit="'+ d.unit_del +'" data-title="' + d.title + '" data-content="'+d.content+'">';
						btn += '<i class="fa fa-eye"></i> Detail </button> ';
						return btn;
					}
				},
			],
			"aoColumnDefs": [{
				"aTargets": [0],
				'bSortable': false,
				'sWidth': '450px',
				'sClass': 'text-center',
			}, {
				"aTargets": [1],
				'bSortable': false,
				'sWidth': '150px',
				'sClass': 'text-left',
			}
		],
		});
	}
	$('#myTable').on('click','.btns',function(){
        var id = $(this).data('id');	
		var cat = $(this).data('cat');	
		var jam = $(this).data('jam');	
		var tgl = $(this).data('tgl');	
		var mail = $(this).data('mail');	
		var name = $(this).data('name');	
		var status = $(this).data('status');	
		var telp = $(this).data('telp');	
		var unit_del = $(this).data('unit')	
		var title = $(this).data('title');	
		var content = $(this).data('content');	
		console.log(content)
		$("#title").html('<b>Judul : </b>' + title);
		$("#cat").html('<b>Kategori : </b>' + cat);
		$("#jam").html('<b>Jam : </b>' + jam);
		$("#tgl").html('<b>Tanggal : </b>' + tgl);
		$("#mail").html('<b>Email : </b>' + mail);
		$("#name").html('<b>Nama : </b>' + name);
		if (status == 'Process') {
			$("#status").html('<b>Status : </b><p class="text-warning">' + status +'</p>');		
		} else {		
			$("#status").html('<b>Status : </b><p class="text-success">' + status +'</p>');		
		}
		$("#telp").html('<b>Telepon : </b>' + telp);
		$("#unit_del").html('<b>Unit : </b>' + unit_del);
		$("#content").html('<b>Deskripsi : </b>' + content);

    });


	// var channel = pusher.subscribe('bpbd-surakarta');
	// channel.bind('load-notification-table', function(data) {
	// 	Load_Data();
	// });
	$(document).ready(function() {
		$(".date_picker").datepicker();
		var base_url = "<?php echo base_url(); ?>";
		Load_Data();
		$(document).on('click', '.hapus', function() {
			var ID = $(this).data('id');
			$("#id_hapus").val(ID);
			$('.modal-title').html('<i class="mdi mdi-alert-outline"></i> Konfirmasi');
		});
		$(document).on('click', '#konfirmasi_hapus', function(q) {
			q.preventDefault();
			var id_hapus = $("#id_hapus").val();
			$.ajax({
				url: base_url + 'admin/page_ppid/prosesHapus',
				method: "POST",
				dataType: 'JSON',
				data: {
					id: id_hapus
				},
				success: function(res) {
					if (res == "ok") {
						Swal.fire({
							title: 'Sukses!',
							text: 'Data berhasil di hapus.',
							type: 'success',
							timer: 1500
						});
						$('#hapus_form')[0].reset();
						$('#konfirmasi_hapus_modal').modal('hide');
						Load_Data();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Gagal',
							text: 'Data gagal di hapus.',
							type: 'error',
						});
					}
				}
			});
		});
		setTimeout(function() {
			$('#tambah_konten').summernote({
				toolbar: [
					['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
					['para', ['ul', 'ol', 'paragraph']],
					['view', ['codeview']]
				],
				height: 300,
				focus: true
			});
			$('#ubah_konten').summernote({
				toolbar: [
					['font', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
					['para', ['ul', 'ol', 'paragraph']],
					['view', ['codeview']]
				],
				height: 300,
				focus: true
			});
		}, 500);
		$('#tambah_data').click(function() {
			$("#tambah_judul").focus();
			setTimeout(function() {
				$('#tambah_image_preview_container').html("");
				$('#tambah_image_label').text("");
				$("#tambah_konten").summernote("code", "");
			}, 500);
			$('#submit_form_tambah')[0].reset();
		});

		$(document).on('click', '.fileinput-exists', function() {
			setTimeout(function() {
				$('#tambah_image_preview_container').html("");
				$('#tambah_image_label').text("");
				$('#ubah_image_preview_container').html("");
				$('#ubah_image_label').text("");
			}, 100);
		});

		$(document).on('click', '.update', function() {
			$('#ubah_image_label').text("");
			var get_id = $(this).attr("id");
			$.ajax({
				url: base_url + 'admin/page_ppid/get_id',
				method: "POST",
				data: {
					id: get_id
				},
				dataType: "json",
				success: function(data) {
					var src_img = base_url + 'uploads/menu/small/' + data.image;
					$('#formModalUbah').modal('show');
					$("#ubah_judul").val(data.judul);
					$("#ubah_tanggal").val(data.tanggal);
					$("#ubah_id").val(get_id);
					setTimeout(function() {
						if (data.image != '') {
							$('#ubah_image_preview_container').html(
								`<div style="border: 1px solid #ccc; border-style: dashed; padding: 5px;">
								<img src="` + src_img + `" style="width: 100%; height: 100%;vertical-align:middle"/> 
								<div style="margin-top: 5px;">
									<button type="button" class="btn btn-sm btn-block btn-danger hapus_image" id_name="ubah_image"> 
									<i class="fa fa-remove"></i> Hapus </button>
								</div> 
							</div>
						`);
						} else {
							$('#ubah_image_preview_container').html('');
						}
						$("#ubah_konten").summernote("code", data.konten);
						$('#kosongkan_ubah_image').val('');
					}, 500);
				}
			});
		});

		$(document).on('submit', '#submit_form_tambah', function(event) {
			event.preventDefault();
			var judul = $('#tambah_judul').val();
			var extension = $('#tambah_image').val().split('.').pop().toLowerCase();
			if (extension != '') {
				$('.validasi').text('');
				if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
					Swal.fire({
						icon: 'warning',
						title: 'Warning!',
						text: 'File Gambar tidak sesuai!',
						type: 'warning'
					});
					$('#tambah_image_preview_container').html('');
					$('#tambah_image_label').text('Silahkan pilih file...');
					$('#tambah_image').val('');
					return false;
				}
			}
			if (judul == "") {
				$('.validasi').text('');
				$('#error_tambah_judul').html('<p class="text-danger"> <i class="fa fa-warning"></i> Judul tidak boleh kosong</p>');
				$('#tambah_judul').focus();
			} else {
				$('.validasi').text('');
				$.ajax({
					url: base_url + 'admin/page_ppid/prosesTambah',
					method: "POST",
					data: new FormData(this),
					dataType: 'JSON',
					contentType: false,
					processData: false,
					success: function(res) {
						if (res == "ok") {
							Swal.fire({
								title: 'Sukses!',
								text: 'Data berhasil disimpan!',
								type: 'success',
								timer: 1500
							});
							$('#submit_form_tambah')[0].reset();
							$('#formModalTambah').modal('hide');
							Load_Data();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: 'Data gagal di simpan.',
								type: 'error',
							});
						}
					}
				});
			}
		});

		

	});
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '5de90021-1dd3-45fb-94cb-aa8434f62c0f',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
	
</script>