<div id="custom_tab_cuaca" class="tabbable">
    <ul class="nav nav-tabs" style="padding: 0;">
        <?php $no=1; foreach($days as $row){?>
        <li style="padding: 0;" class="col-lg-4 <?= $no==1?'active':''?>"><a href="#cuaca<?= $no?>" data-toggle="tab"><i class="fa fa-calendar-alt" style="padding-right: 10px;"></i><?= tgl_indo($row)?></a></li>
        <?php $no++;} ?>
        <!--<li style="padding: 0;" class="col-lg-4"><a href="#cuaca2" data-toggle="tab"><i class="fa fa-calendar-alt" style="padding-right: 10px;"></i>Minggu, 21 April 2020</a></li>
        <li style="padding: 0;" class="col-lg-4"><a href="#cuaca3" data-toggle="tab"><i class="fa fa-calendar-alt" style="padding-right: 10px;"></i>Senin, 22 April 2020</a></li>-->
    </ul>
    <div class="tab-content" style="border: none;">
        <div class="tab-pane active" id="cuaca1" style="border: none;">
            <div class="row">
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                01:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/mist-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                04:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                07:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/light-bolt-2.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                10:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/rain.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="cuaca2" style="border: none;">

            <div class="row">
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                01:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/mist-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                04:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                07:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/light-bolt-2.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                10:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/rain.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="cuaca3" style="border: none;">

            <div class="row">
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                01:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/mist-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/malam.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                04:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-1.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                07:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/light-bolt-2.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="padding:10px">
                    <div class="card-cuaca" style="background-image: url(<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/siang.jpg);">
                        <div class="filter">
                        </div>
                        <div class="wrapper-cuaca">
                            <div class="jam-cuaca">
                                10:00 WIB
                            </div>
                            <div>
                                <img style="width: 40%; padding: 20px 0;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/rain.png" alt="">
                            </div>
                            <div class="status-cuaca">
                                Hujan
                            </div>
                            <div class="suhu-cuaca">
                                24 °C
                            </div>
                            <div class="lembab-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/drops.png" alt=""><span>65 %</span>
                            </div>
                            <div class="angin-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/wind-3.png" alt=""><span>25 km/jam</span>
                            </div>
                            <div class="arah-cuaca">
                                <img style="width: 10%; padding-right: 5px;" src="<?= base_url()?>assets_frontend/assets/custom/images/icon/cuaca/compass.png" alt=""><span>Barat Daya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end tab-content -->
</div>
