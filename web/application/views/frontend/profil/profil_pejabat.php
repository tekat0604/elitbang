<section class="post-wrapper-top jt-shadow clearfix">
    <div class="container">
        <div class="col-lg-12">
            <h2> Profil </h2>
            <ul class="breadcrumb pull-right">
                <li>
                    <a href="<?php echo base_url('./'); ?>"> <?php echo @$row->judul; ?> </a>
                </li>
                <li>Detail</li>
            </ul>
        </div>
    </div>
</section>

<section class="blog-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div> &nbsp; </div>
                <?php
                if (count($data) > 0) {
                    foreach ($data as $key => $value) {
                        if ($value->image != '' && $value->image != null) {
                            $image        = '<img src="' . base_url('uploads/profil_anggota/medium/' . $value->image . '') . '" alt="" class="img-responsive" >';
                        } else {
                            $image        = '<img src="' . base_url('assets/img/image_not_found.png') . '" alt="" class="img-responsive" >';
                        }
                        if ($value->link != '' && $value->link != null) {
                            $link_pejabat = ' <a href="http://' . $value->link . '" target="_blank" class="btn btn-warning btn-md"> Lihat <i class="fa fa-arrow-right"></i> </a>';
                        } else {
                            $link_pejabat = '';
                        }
                ?>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 first">
                                <div class="team_member">
                                    <div class="entry"> <?php echo $image; ?> </div><!-- end entry -->
                                </div><!-- end team_member -->
                            </div><!-- end col-lg-3 -->
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="team_member">
                                    <div class="widget">
                                        <div style="margin:0 15px">
                                            <h1 style="margin:10px 0 0 0"><?php echo $value->nama ?> <span></h1>
                                        </div>
                                        <div id="skills" class="skills_bar" style="margin:0">
                                            <div class="col-lg-6">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">NIP</small>
                                                    <div class="profil-desc"><?php echo $value->nip ?></div>
                                                </div>
                                                <div class="profil-point">
                                                    <small style="font-style:italic">Nama</small>
                                                    <div class="profil-desc"><?php echo $value->nama ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">Tempat, Tanggal Lahir</small>
                                                    <div class="profil-desc">
                                                        <?php echo $value->tempat_lahir . ', ' . $value->tanggal_lahir . ''; ?>
                                                    </div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">

                                                <div class="profil-point">
                                                    <small style="font-style:italic">Pangkat (Golru) </small>
                                                    <div class="profil-desc"><?php echo $value->pangkat_golru ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">TMT Pangkat</small>
                                                    <div class="profil-desc"><?php echo $value->tmt_pangkat ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">Jabatan</small>
                                                    <div class="profil-desc"><?php echo $value->jabatan ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">TMT Jabatan</small>
                                                    <div class="profil-desc"><?php echo $value->tmt_jabatan ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">Formasi</small>
                                                    <div class="profil-desc"><?php echo $value->formasi ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">

                                                <div class="profil-point">
                                                    <small style="font-style:italic">Unit Kerja </small>
                                                    <div class="profil-desc">
                                                        <?php echo $value->unit_kerja ?>
                                                    </div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">

                                                <div class="profil-point">
                                                    <small style="font-style:italic">Pendidikan </small>
                                                    <div class="profil-desc"><?php echo $value->pendidikan ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">

                                                <div class="profil-point">
                                                    <small style="font-style:italic">Alamat </small>
                                                    <div class="profil-desc"><?php echo $value->alamat ?></div>
                                                </div>
                                                <hr style="margin: 0;border-color:#ffb080">
                                                <div class="profil-point">
                                                    <small style="font-style:italic">LHKPN</small>
                                                    <div class="profil-desc"><?php echo $link_pejabat; ?></div>
                                                </div>
                                            </div>
                                        </div><!-- end skills_bar -->
                                    </div><!-- end widget -->
                                </div><!-- end team_member -->
                            </div><!-- end col-lg-8 -->
                            <div class="clearfix"></div>
                            <hr class="row" style="border-color:#ffb080;border-style:dashed">
                        </div>
                <?php
                    };
                } else {
                    echo ' <div class="row"> <div class="col-md-12"> Data Kosong </div> </div>';
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>