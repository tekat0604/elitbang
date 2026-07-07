									
					</section>
				</div>
			</div>
		</div>
		<footer class="footer footer-static footer-light">
			<p class="clearfix mb-0">
				<span class="float-left d-inline-block">2020 &copy; DPMPTSP</span>
			</p>
		</footer>
		<script type="text/javascript">
			var BASE_URL = "<?= base_url('assets2/')?>";
		</script>
		<script src="<?php echo base_url() ?>assets2/app-assets/vendors/js/extensions/swiper.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/vendors.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/scripts/configs/vertical-menu-light.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/core/app-menu.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/core/app.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/scripts/components.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/scripts/footer.js"></script>
    	<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/js/scripts/datatables/datatable.js"></script>
		<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
		<!-- <script src="https://phppot.com/demo/responsive-datatables-with-automatic-column-hiding/vendor/DataTables/datatables.min.js"></script> -->
    	<script src="<?php echo base_url()?>assets2/app-assets/js/scripts/forms/select/form-select2.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
		<script src="<?php echo base_url()?>assets2/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="<?php echo base_url('assets2/alertifyjs/alertify.min.js'); ?>"></script>
	    <script src="<?php echo base_url()?>assets2/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
	    <script src="<?php echo base_url()?>assets2/app-assets/vendors/js/extensions/polyfill.min.js"></script>
	    <script src="<?php echo base_url()?>assets2/app-assets/js/scripts/extensions/sweet-alerts.js"></script>

		<script type="text/javascript">
		    function show_loading(isi=null) {
		        $('.se-pre-con').show();
		        if (isi!=null) {
		        	$('#text-loading').html(isi);
		        }
		    }

			$("#basicSelect").change(function() {
					var thn = $(this).val();
                    $.ajax({
                    url : "<?= base_url('dashboard/sess_tahun/')?>" + $(this).val(),
                    type: 'GET',
                    dataType:'json',
                    cache: false,
                    success : function(data) {
                        if (data.success) {
                            Swal.fire({
						      title: "Berhasil!",
						      text: data.msg,
						      type: "success",
						      confirmButtonClass: 'btn btn-success',
						      buttonsStyling: false,
						    }).then(function() {
							    location.reload();
							});
                        }
                        else
                        {
                            alert("Error!!");
                        }

                    }
                });
            });
			$(".basicSelect_bulan").change(function() {
					var bln = $(this).val();
                    $.ajax({
                    url : "<?= base_url('dashboard/sess_bulan/')?>" + $(this).val(),
                    type: 'GET',
                    dataType:'json',
                    cache: false,
                    success : function(data) {
                        if (data.success) {
                            Swal.fire({
						      title: "Berhasil!",
						      text: data.msg,
						      type: "success",
						      confirmButtonClass: 'btn btn-success',
						      buttonsStyling: false,
						    }).then(function() {
							    location.reload();
							});
                        }
                        else
                        {
                            alert("Error!!");
                        }

                    }
                });
            });

            var datePickerOption = {
	            changeMonth: false,
	            showMonthAfterYear: false,
	            startView: 3,
	            minViewMode: 2,
	            format: 'yyyy',
	            autoclose: 'true',
	        };

	        $(function () {
	            $("#tahun_top").pickadate(datePickerOption)
	            .on( "changeDate", function(dateText) {
	            	console.log(dateText.dates[0].getFullYear());
	              	window.location.href = "<?= site_url('login/sess_tahun/')?>" + dateText.dates[0].getFullYear();
	                //console.log(dateText.dates[0].getFullYear());
	            });
	        });
		</script>
		<?php isset($scriptExtra) ? $this->load->view($scriptExtra) : ''; ?>
		<?php echo isset($javascript) ? $javascript : ''; ?>
	</body>
</html>