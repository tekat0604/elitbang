                        
                        <!-- Side Navigation -->
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                <a href="<?= base_url(); ?>operator/beranda"><i class="si si-home"></i><span class="sidebar-mini-hide">Beranda</span></a>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-map"></i><span class="sidebar-mini-hide">Penanganan Pengaduan Bencana</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('operator/peta')?>">Peta</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('operator/notifikasi')?>">Notifikasi</a>
                                        </li>
                                    </ul>
                                </li> 

                                <?php 
                                if (!empty($this->session->userdata('id_pengaduan'))) { ?>
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Assesment Bencana</span></li>
                                <li>
                                    <a href="<?= base_url(); ?>operator/Pengungsian"><i class="si si-user"></i><span class="sidebar-mini-hide">Data Pengungsian</span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>operator/Data_relawan"><i class="si si-support"></i><span class="sidebar-mini-hide">Data Relawan</span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>operator/Korban_jiwa"><i class="si si-user-follow"></i><span class="sidebar-mini-hide">Data Korban Jiwa</span></a>
                                </li>                   
                                <li>
                                    <a href="<?= base_url(); ?>operator/Kerusakan_fasilitas"><i class="si si-shield"></i><span class="sidebar-mini-hide">Data Kerusakan Fasilitas</span></a>
                                </li>
                                
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>