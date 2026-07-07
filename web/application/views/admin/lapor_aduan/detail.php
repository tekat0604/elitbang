<style>
    .container-fluid {
        padding: 0px 0px 10px 0px;
    }
</style>

<!-- Main Container -->
<main id="main-container">
    <div class="content" style="padding-top: 0px;">
        <h2 class="content-heading" style="padding-top: 0px;padding-bottom: 0px;"><?= @$data->subjek ?></h2>
        <div class="block block-themed">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Kategori Bencana : <?= strtoupper(@$data->kategori_bencana) ?></h3>
                <div class="block-options">
                    <a href="<?= @$link_url ?>" class="btn btn-sm btn-alt-danger">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="block-content">
                <input type="hidden" name="id" value="<?= @$data->id; ?>">
                <div class="form-group row">
                    <label class="col-12" for="nama"><?= @$data->nama . ' - <small>' . @$data->no_hp . ', ' . @$data->email . '</small>' ?><br>
                        <small><i>(Kec.<?= @$data->kecamatan ?>, Kel.<?= @$data->kelurahan ?>, <?= @$data->detail_lokasi ?>)</i></small>
                    </label>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="pesan"> Image </label>
                    <div class="col-md-12">
                        <?php if (is_file('./uploads/lapor/' . $data->image)) { ?>
                            <img style="max-width: 300px;" src="<?= base_url('uploads/lapor/' . $data->image) ?>">
                        <?php } else { ?>
                            <small style="color: red;"><i>Pelapor tidak mengupload gambar.</i></small>
                        <?php } ?>
                    </div>
                </div>

                <div class="form-group row" hidden>
                    <label class="col-12"> Subjek </label>
                    <div class="col-md-12">
                        <?= @$data->pesan ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="pesan">Isi Pesan
                        <?= @$data->dibuat_pada != null ? '<small>(Diterima pada: ' . tgl_indo($data->dibuat_pada, true) . ')</small>' : '' ?>
                    </label>
                    <div class="col-md-12">
                        <textarea style="background-color: #fff;" class="form-control" id="pesan" cols="30" rows="5" readonly><?= @$data->pesan ?></textarea>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<!-- END Main Container -->