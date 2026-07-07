
                <div class="rad-10 bg-white box-shadow-medium p-5">
                        <div class="text-extra-dark-gray font-weight-600 border-bottom border-color-light-gray mb-1">Agenda Kegiatan BPBD</div>
                        <div class="widget-kegiatan">
                            <ul class="timeline">

                            <?php
                    if(count($agenda_kegiatan) > 0){ 
                        foreach ($agenda_kegiatan as $key => $value) {  
                            $link_agenda = base_url('agenda_kegiatan/detail/'.$value['tanggal'].'/'.$value['id']); 
                            if($value['image']!='' && $value['image']!=null){
                                $image        = '<img src="'.base_url('uploads/menu/small/'.$value['image'].'').'" alt="">' ;
                            }else{
                                $image        = '<img src="'.base_url('assets/img/image_not_found.png').'" alt="">';
                            }
                        ?> 

                                <li>
                                    <div class="">
                                        <i class="feather icon-feather-calendar bg-info p-1 text-white rad-25"></i>
                                    </div>
                                    <div class="timeline-item ps-2">
                                        <div class="timeline-header">
                                            <a href="<?php echo $link_agenda; ?>"><?php echo $image;?> <?php echo $value['judul']; ?> </a>
                                            <a class="readmore" href="<?php echo $link_agenda; ?>">
                                            <div class="timestamp">
                                                <i class="feather icon-feather-calendar"></i> <?php echo validateDate($value['tanggal']) ? tgl_indo($value['tanggal']) : '-'; ?> 
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                        };
                    }else{
                        echo"<p> Data Kosong</p>";
                    }
                    ?>
                            </ul>
                            <div class="btn-link mt-3">
                                <a class="w-100 btn btn-fancy btn-large btn-round-edge-small btn-gradient-magenta-orange-2 section-link" get="_BLANK" href="<?php echo base_url('agenda_kegiatan');?>">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
