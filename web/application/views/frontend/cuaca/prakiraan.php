<div id="custom_tab_cuaca" class="tabbable">
    <ul class="nav nav-tabs" style="padding: 0;">
        <?php $no = 0;
        foreach ($days as $row) { ?>
            <li style="padding: 0;" class="col-lg-4 col-xs-12 <?= $no == 0 ? 'active' : '' ?>">
                <a href="#cuaca<?= $no ?>" data-toggle="tab" style="background: none; ">
                    <i class="fa fa-calendar-alt" style="padding-right: 10px; "></i>
                    <?= tgl_indo($row) ?></a>
            </li>
        <?php $no++;
        } ?>
    </ul>

    <div class="tab-content" style="border: none; margin-top: 20px;">
        <?php $datetime = '';
        $no = 0;
        foreach ($cuaca as $row) {
            if (substr($row['datetime'], 0, 8) != $datetime) {
                echo ($no != 0 ? '</div>' : '');
        ?>
                <div class="tab-pane <?= $no == 0 ? 'active' : '' ?>" id="cuaca<?= $no ?>" style="border: none;">

                <?php
                $datetime = substr($row['datetime'], 0, 8);
                $no++;
            } ?>
                <div class="col-lg-3" style="padding:10px">
                    <?php $bg = in_array(substr($row['datetime'], 8), ['0000', '1800']) ? 'malam' : 'siang'; ?>
                    <div class="card-cuaca" style="background-image: url(<?= base_url() ?>assets_frontend/assets/custom/images/icon/cuaca/<?= $bg ?>.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                <?= substr($row['datetime'], 8, 2) . ':' . substr($row['datetime'], 10, 2) ?> WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= get_cuaca($row['weather'][0])['img'] ?>" alt="">
                            </div>
                            <div class="status-cuaca">
                                <?= get_cuaca($row['weather'][0])['ket'] ?>
                            </div>
                            <div class="suhu-cuaca">
                                <?= $row['temp_c'][0] ?> °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url() ?>assets_frontend/cuaca/kelembaban-udara.png" alt=""><span><?= $row['humidity'][0] ?> %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url() ?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span><?= $row['wind_speed'][0] ?> km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url() ?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span><?= $row['wind_direction'][0] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (substr($row['datetime'], 0, 8) != $datetime) { ?>
                </div>
    </div>
<?php }
            } ?>

</div>

</div>