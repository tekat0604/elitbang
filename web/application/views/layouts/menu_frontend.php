                        
                        <!-- Side Navigation -->
                        <div class="content-side content-side-full">
                            <ul class="nav-main">
                                <li>
                                    <a href="<?= base_url(); ?>admin/beranda"><i class="si si-home"></i><span class="sidebar-mini-hide">Beranda</span></a>
                                </li>
                                <!-- <li>
                                    <a href="<?= base_url(); ?>admin/peta"><i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span></a>
                                </li> -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('admin/peta')?>">Manajemen Peta</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?= base_url('admin/layer_rtrw')?>">Manajemen Layer RTRW</a>
                                        </li> -->
                                    </ul>
                                </li> 
                                <!-- <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Rekomendasi</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('admin/perijinan')?>">Rekomendasi RTR</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('admin/perijinan_kkr')?>">Rekomendasi KKR</a>
                                        </li>
                                    </ul>
                                </li>     -->
                                <!-- <li>
                                    <a href="<?= base_url(); ?>admin/rekap"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rekap</span></a>
                                </li>   -->
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Referensi</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/opd">OPD</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/icon">Ikon Peta</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/koordinat">Koordinat Peta</a>
                                        </li>
                                        <!-- <li>
                                            <a href="<?= base_url(); ?>admin/referensi/rpr">Rencana Penggunaan Ruang</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/st">Status Tanah</a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="be_forms_premade.html">Peta Rencana Struktur Ruang</a>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/rencana_struktur_ruang">Peta Rencana Struktur Ruang</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url(); ?>admin/referensi/rencana_pola_ruang">Peta Rencana Pola Ruang</a>
                                        </li>
                                        <li>
                                            <a href="be_forms_premade.html">Peta Penetapan Kawasan Strategis</a>
                                        </li> -->
                                    </ul>
                                </li> 
                                <li>
                                    <a href="<?= base_url(); ?>admin/user"><i class="si si-users"></i><span class="sidebar-mini-hide">Manajemen User</span></a>
                                </li> 

                                <li>
                                    <a href="<?= base_url(); ?>admin/api"><i class="si si-link"></i><span class="sidebar-mini-hide">API Layer Peta</span></a>
                                </li>

                                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Website</span></li>
                                <!-- <li>
                                    <a href="<?= base_url(); ?>admin/website/profil"><i class="si si-cup"></i><span class="sidebar-mini-hide">Profil</span></a>
                                </li> -->
                                <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Berita </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?= base_url(); ?>admin/website/berita">Bencana</a></li>
                                        <li><a href="<?= base_url(); ?>admin/website/berita">Kebakaran</a></li>
                                        <li><a href="<?= base_url(); ?>admin/website/berita">Umum</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>admin/website/layanan"><i class="si si-cup"></i><span class="sidebar-mini-hide">Layanan</span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>admin/website/regulasi"><i class="si si-cup"></i><span class="sidebar-mini-hide">Regulasi</span></a>
                                </li>                   
                                <li>
                                    <a href="<?= base_url(); ?>admin/website/album"><i class="si si-cup"></i><span class="sidebar-mini-hide">Album Peta</span></a>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>