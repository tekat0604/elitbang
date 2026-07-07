
<!-- <script src="./Leaflet-1.0.3/leaflet.js"></script> -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<!-- <link rel="stylesheet" href="./Leaflet-1.0.3/leaflet.css"/> -->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.map"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>	
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.js"></script>
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.ajax.min.js"></script>
<!-- <script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet.ajax.js"></script> -->
<script src="https://egov.phicos.co.id/surakarta/sumur_dalam_ipal/assets/assets/js/leaflet/leaflet-esri.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>/assets/leaflet/leaflet.css" />
<script src="<?= base_url(); ?>/assets/leaflet/leaflet.js"></script>
<style>
#map { height: 500px; }
</style>

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="block block-themed">
            <div class="block-content">
                <div id="map"></div>
                <br>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deskripsi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5></h5>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <script type="text/javascript" src="<?= base_url('assets_frontend/new_assets/') ?>/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url('assets_frontend/new_assets/') ?>/js/theme-vendors.min.js"></script>
<!-- <script type="text/javascript" src="<?= base_url('assets_frontend/new_assets/') ?>/js/main.js"></script> -->

<script src="<?= base_url('assets_frontend/new_assets/') ?>/js/leaflet/leaflet.js"></script>
<script src="<?= base_url('assets_frontend/new_assets/') ?>/js/leaflet/leaflet-esri.js"></script>


    <!-- JS -->
    <script src="<?= base_url() ?>assets_front/js/leaflet.js"></script>
    <!-- <script src="<?= base_url() ?>assets_front/js/leaflet-providers.js"></script> -->
    <script src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js" integrity="sha512-1tScwpjXwwnm6tTva0l0/ZgM3rYNbdyMj5q6RSQMbNX6EUMhYDE3pMRGZaT41zHEvLoWEK7qFEJmZDOoDMU7/Q==" crossorigin=""></script>
    <!-- <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5PIDMAb-MrL21uaWwk0xFsRBPjnjixWE"></script> -->
    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/select2/i18n/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/codebase.js"></script> -->
    <?php include_once('index_js.php') ?>

    </body>
    </html>