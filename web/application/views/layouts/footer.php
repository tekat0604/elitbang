            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-right">
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="#"></a> &copy; Sistem BPBD Kota Surakarta
                    </div>
                </div>
            </footer>
            <audio style="visibility: hidden;" id="notif-sound" muted="muted" src="<?= base_url('assets/message_notification.mp3') ?>" type="audio/mpeg" controls></audio>
            <!-- END Footer -->
            </div>
            <!-- END Page Container -->

            <!-- Codebase Core JS -->
            <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/codebase.js"></script>

            <!-- Page JS Plugins -->
            <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/chartjs/Chart.bundle.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/select2/i18n/id.js"></script>
            <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2/new.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
            <script src="<?= base_url() ?>assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

            <!-- Page JS Code -->
            <script src="<?= base_url(); ?>assets/js/pages/be_pages_dashboard.js"></script>

            <!-- JS Pusher -->
            <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {

                })

                var base_url = "<?php echo base_url(); ?>";
                $('#rubah_session_periode').change(function() {
                    var id_periode = $(this).val();
                    $.ajax({
                        url: base_url + 'session_periode/rubah_session',
                        method: "POST",
                        data: {
                            id_periode: id_periode
                        },
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            location.reload();
                        }
                    });
                });


                // Set pusher logging to false
                Pusher.logToConsole = false;

                var pusher = new Pusher('ab681d538e4ccc533525', {
                    cluster: 'ap1',
                    forceTLS: true
                });

                var channel = pusher.subscribe('bpbd');
                channel.bind('my-event', function(data) {
                    //$('#notif-sound').get(0).play();
                    $('#notif-msg-belum-dibaca').html(data.belum_dibaca);
                    $('#notif-msg-belum-dibalas').html(data.belum_dibalas);
                });
            </script>


            <script>
                jQuery(function() {
                    // Init page helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins)
                    Codebase.helpers(['colorpicker']);
                });
            </script>
            <?php
            if (isset($modal)) {
                foreach ($modal as $include_modal) {
                    echo $include_modal;
                }
            }
            //
            if (isset($extra_js)) {
                echo $extra_js;
            }
            ?>
            </body>

            </html>