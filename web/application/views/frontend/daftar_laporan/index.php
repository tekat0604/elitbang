   <section class="post-wrapper-top jt-shadow clearfix">
       <div class="container">
           <div class="col-lg-12">
               <h2>Daftar Laporan</h2>
               <ul class="breadcrumb pull-right mobile_none">
                   <li><a href="<?= base_url('frontend/lapor') ?>">Lapor</a></li>
                   <li class="">Daftar Laporan</li>
               </ul>
           </div>
       </div>
   </section>

   <section class="blog-wrapper">
       <div class="container">
           <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="row">
                   <div class="blog-masonry">

                       <?php foreach ($lapor as $row) {
                            $explode_datetime = explode(' ', $row->created);
                            $date = tgl_indo($explode_datetime[0]);
                            $time = substr($explode_datetime[1], 0, 5);
                        ?>
                           <div class="col-lg-4">
                               <div class="box" onclick="go_to('<?= base_url('daftar_laporan/detail/' . custom_id($row->id_lapor)) ?>')">
                                   <div class="box-konten">
                                       <div class="row" style="margin: 0;">
                                           <span class="pull-left"><i class="fa fa-user" style="padding-right: 10px;"></i>
                                               <?= $row->nama ?>
                                           </span>
                                           <span class="pull-right">
                                               <?= $date ?>
                                               <i class="fa fa-calendar-alt" style="padding-left: 10px;"></i>
                                           </span>
                                       </div>

                                       <div class="row" style="margin: 0;">
                                           <span class="pull-left"><i class="fa fa-mobile-alt" style="padding-right: 10px;"></i>
                                               <?= substr($row->no_hp, 0, 9) . 'xxx' ?>
                                           </span>
                                           <span class="pull-right">
                                               <?= $time ?> WIB
                                               <i class="fa fa-clock" style="padding-left: 10px;"></i>
                                           </span>
                                       </div>
                                   </div>

                                   <div class="clearfix"></div>

                                   <div class="konten-lapor">
                                       <span class="judul-lapor"><?= $row->kategori ?></span>
                                       <!-- <span class="pull-right"></span> -->
                                       <div class="row konteks-lapor">
                                           <?= '<b>' . $row->subjek . '</b> - ' . $row->pesan ?>
                                       </div>
                                       <div class="row lapor-lengkap">
                                           <a class="pull-right" href="<?= base_url('daftar_laporan/detail/' . custom_id($row->id_lapor)) ?>">Selengkapnya..</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       <?php } ?>

                   </div>
               </div>
           </div>

           <div class="clearfix"></div>
           <hr>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="next_prev text-center">
                   <ul class="pager">
                       <li class="previous">
                           <a href="<?= base_url('lapor') ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                       </li>
                       <!--<li class="next">
                            <a href="#">Laporan Selanjutnya →</a>
                        </li>-->
                   </ul>
               </div>
           </div>

           <div style="text-align: center;" class="pagination_wrapper">
               <?= @$pagging ?>
           </div>
       </div>
   </section>