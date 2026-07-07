<div class="row">
    <div class="col-md-8">
        <div style="border: 1px solid #eee; padding: 10px; height: 630px;">
            <div class="title">
                <h2> Unduhan</h2>
            </div><!-- end title -->
            <div class="widget">
                <div class="social_widget">
                    <?php
                    if (count($unduhan) > 0) {
                        foreach ($unduhan as $key => $value) {
                            if ($value['file'] != '' && $value['file'] != null) {
                                $btn_unduhan    = '<a href="' . base_url('uploads/menu/' . $value['file'] . '') . '" target="_blank" 
                                                  class="btn btn-primary"> <i class="fa fa-download"></i> Unduh</a>';
                                $file           = base_url('uploads/menu/' . $value['file'] . '');
                            } else {
                                $btn_unduhan    = '';
                                $file           = '';
                            }
                            echo '
                            <div class="social_like" style="padding-bottom: 9px; margin-bottom: 17px; border-bottom: 1px solid #eee;">
                                <div class="icon-container pull-left">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="social_count">
                                    <div class="unduhan-ket" style="max-width: 100% !important;">
                                    <a href="' . $file . '" target="_blank">' . substr($value['judul'], 0, 150) . ' ...</a>
                                    </div>
                                    <div class="social_button"> ' . $btn_unduhan . ' </div>
                                </div>
                            </div>
                            ';
                        };
                    } else {
                        echo '<p class="text-center"> Data Kosong  </p> ';
                    }
                    ?>

                </div><!-- end social-widget -->
                <div class="clearfix"></div>
                <div class="buttons text-center">
                    <a style="width: 100%;" href="<?php echo base_url('frontend/unduhan'); ?>" class="btn btn-primary btn-md" title=""> Selengkapnya <i class="fa fa-arrow-right"></i> </a>
                </div>
            </div><!-- end widget -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget" style="height: auto;">
            <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url('uploads/other/EVAKUASI_BPBD.png'); ?>" target="_blank">
                    <img src="<?php echo base_url('uploads/other/evakuasi_bpbd_small.png'); ?>" alt="" style="width: 100%;">
                </a>
            </div>
            <div class="text-center" style="margin-bottom: 10px;">
                <a href="<?php echo base_url('uploads/other/EVAKUASI_BPBD.png'); ?>" target="_blank" class="btn btn-success" style="width: 200px;">
                    Lihat Gambar Penuh <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
    </div>
</div>