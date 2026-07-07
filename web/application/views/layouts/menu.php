<!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a href="<?= base_url(); ?>admin/beranda" class="<?= $this->uri->segment(2) == 'beranda'  ||  $this->uri->segment(2) == 'grafik' ? "active" : "" ?>">
                <i class="si si-home"></i><span class="sidebar-mini-hide"> Dashbord </span>
            </a>
        </li>

        <li class="nav-main-heading">
            <span class="sidebar-mini-visible">UI</span>
            <span class="sidebar-mini-hidden">Data</span>
        </li>
        <li class="<?= $this->uri->segment(2) == 'kejadian_bencana' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(2) == 'kejadian_bencana' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-book-open"></i><span class="sidebar-mini-hide"> Kejadian Bencana </span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/kejadian_bencana/form1" class="<?= $this->uri->segment(2) == 'kejadian_bencana' && $this->uri->segment(3) == 'form1' ? "active" : "" ?>">
                        Form 1
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kejadian_bencana/form2" class="<?= $this->uri->segment(2) == 'kejadian_bencana' && $this->uri->segment(3) == 'form2' ? "active" : "" ?>">
                        Form 2
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kejadian_bencana/form3" class="<?= $this->uri->segment(2) == 'kejadian_bencana' && $this->uri->segment(3) == 'form3' ? "active" : "" ?>">
                        Form 3
                    </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kejadian_bencana/rekap" class="<?= $this->uri->segment(2) == 'kejadian_bencana' && $this->uri->segment(3) == 'rekap' ? "active" : "" ?>">
                        Rekap
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/pengunjung" class="<?= $this->uri->segment(2) == 'pengunjung' ? "active" : "" ?>">
                <i class="si si-user"></i><span class="sidebar-mini-hide"> Pengunjung</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/lapor_aduan" class="<?= $this->uri->segment(2) == 'lapor_aduan' ? "active" : "" ?>">
                <i class="fa fa-bullhorn"></i> <span class="sidebar-mini-hide"> lapor aduan</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/korban_bencana" class="<?= $this->uri->segment(2) == 'korban_bencana' ? "active" : "" ?>">
                <i class="si si-user"></i><span class="sidebar-mini-hide"> Korban Bencana</span>
            </a>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-list"></i><span class="sidebar-mini-hide">Referensi</span></a>
            <ul>
                <li hidden>
                    <a href="<?= base_url(); ?>admin/referensi/opd">OPD</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/referensi/periode">Periode</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/ref/kategori_bencana">Kategori Bencana</a>
                </li>
            </ul>
        </li>
        <li class="nav-main-heading">
            <span class="sidebar-mini-visible">UI</span>
            <span class="sidebar-mini-hidden">Manajement Website </span>
        </li>
        <li class="<?= $this->uri->segment(3) == 'layanan' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(3) == 'layanan' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-book-open"></i><span class="sidebar-mini-hide"> Portal </span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/portal/layanan" class="<?= $this->uri->segment(2) == 'portal' && $this->uri->segment(3) == 'layanan' ? "active" : "" ?>"> Layanan </a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->uri->segment(3) == 'home' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(3) == 'home' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-book-open"></i><span class="sidebar-mini-hide">Beranda</span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/slider" class="<?= $this->uri->segment(3) == 'home' && $this->uri->segment(4) == 'slider' ? "active" : "" ?>"> Slider</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/pesan_singkat" class="<?= $this->uri->segment(3) == 'home' && $this->uri->segment(4) == 'pesan_singkat' ? "active" : "" ?>"> Pesan Singkat </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/grid_dua" class="<?= $this->uri->segment(3) == 'home' && $this->uri->segment(4) == 'grid_dua' ? "active" : "" ?>"> Grid 2</a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->uri->segment(3) == 'profil' || $this->uri->segment(3) == 'profil_pejabat' || $this->uri->segment(3) == 'profil_pegawai' || $this->uri->segment(3) == 'agenda_pimpinan' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(3) == 'profil' || $this->uri->segment(3) == 'profil_pejabat' || $this->uri->segment(3) == 'profil_pegawai' || $this->uri->segment(3) == 'agenda_pimpinan' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-flag"></i> <span class="sidebar-mini-hide">Profil</span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil/profil_kami"> Profil Kami </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil/tugas_fungsi"> Tugas & Fungsi </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil/visi_misi"> Visi & Misi </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil/struktur_organisasi"> Struktur Organisasi </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil_pejabat"> Profil Pejabat </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/profil_pegawai"> Profil Pegawai </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/agenda_pimpinan"> Agenda Pimpinan </a>
                </li>
            </ul>
        </li>

        <li class="<?= $this->uri->segment(3) == 'kategori_berita' || $this->uri->segment(3) == 'berita' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(3) == 'kategori_berita' || $this->uri->segment(3) == 'berita' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-bulb"></i>
                <span class="sidebar-mini-hide">Berita</span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/kategori_berita" class="<?= $this->uri->segment(3) == 'kategori_berita' ? "active" : "" ?>"> Kategori </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/berita" class="<?= $this->uri->segment(3) == 'berita' ? "active" : "" ?>"> Berita </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/agenda_kegiatan" class="<?= $this->uri->segment(3) == 'agenda_kegiatan' ? "active" : "" ?>"><i class="si si-bell"></i>
                <span class="sidebar-mini-hide"> Agenda Kegiatan</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/informasi_kebencanaan" class="<?= $this->uri->segment(3) == 'informasi_kebencanaan' ? "active" : "" ?>"><i class="si si-bell"></i>
                <span class="sidebar-mini-hide"> Informasi Kebencanaan</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/unduhan" class="<?= $this->uri->segment(3) == 'unduhan' ? "active" : "" ?>"><i class="si si-cloud-download"></i>
                <span class="sidebar-mini-hide"> Unduhan </span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/galeri" class="<?= $this->uri->segment(3) == 'galeri' ? "active" : "" ?>"><i class="si si-picture"></i>
                <span class="sidebar-mini-hide"> Galeri </span></a>
        </li>
        <li class="<?= $this->uri->segment(2) == 'page_ppid' || $this->uri->segment(2) == 'kategori_ppid'  || $this->uri->segment(2) == 'ppid' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(2) == 'page_ppid' || $this->uri->segment(2) == 'kategori_ppid'  || $this->uri->segment(2) == 'ppid' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-bulb"></i>
                <span class="sidebar-mini-hide"> PPID </span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/page_ppid" class="<?= $this->uri->segment(2) == 'page_ppid' ? "active" : "" ?>">Page Ppid </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kategori_ppid" class="<?= $this->uri->segment(2) == 'kategori_ppid' ? "active" : "" ?>"> Kategori </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/ppid" class="<?= $this->uri->segment(2) == 'ppid' ? "active" : "" ?>"> PPID </a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->uri->segment(2) == 'page_pelayanan_publik' || $this->uri->segment(2) == 'kategori_pelayanan_publik'  || $this->uri->segment(2) == 'pelayanan_publik' ? "open" : "" ?>">
            <a class="nav-submenu <?= $this->uri->segment(2) == 'page_pelayanan_publik' || $this->uri->segment(2) == 'kategori_pelayanan_publik'  || $this->uri->segment(2) == 'pelayanan_publik' ? "active" : "" ?>" data-toggle="nav-submenu" href="#">
                <i class="si si-bulb"></i>
                <span class="sidebar-mini-hide"> Pelayanan Publik </span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/page_pelayanan_publik" class="<?= $this->uri->segment(2) == 'page_pelayanan_publik' ? "active" : "" ?>">Page Pelayanan Publik </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kategori_pelayanan_publik" class="<?= $this->uri->segment(2) == 'kategori_pelayanan_publik' ? "active" : "" ?>"> Kategori </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/pelayanan_publik" class="<?= $this->uri->segment(2) == 'pelayanan_publik' ? "active" : "" ?>"> Pelayanan Publik </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/profil_website"><i class="si si-globe"></i>
                <span class="sidebar-mini-hide"> Profil Website </span></a>
        </li>

        <?php
        /*
        <li class="nav-main-heading" hidden>
            <span class="sidebar-mini-visible">UI</span>
            <span class="sidebar-mini-hidden"> Peta</span>
        </li>
        <li hidden>
            <a href="<?= base_url(); ?>admin/peta">
                <i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span>
            </a>
        </li>
        <li hidden>
            <a href="<?= base_url(); ?>peta" target="_blank">
                <i class="fa fa-map-marker"></i><span class="sidebar-mini-hide">Peta</span>
            </a>
        </li> 
        <li hidden>
            <a class="<?= @$li_lapor ?>" href="<?= base_url(); ?>admin/lapor"><i class="si si-bubbles"></i><span class="sidebar-mini-hide">Lapor</span>
                <span class="badge badge-danger" id="notif-msg-belum-dibaca"><?= count_message()->belum_dibaca ?></span>
                <span class="badge badge-warning" id="notif-msg-belum-dibalas"><?= count_message()->belum_dibalas ?></span>
            </a>
        </li>
        */
        ?>
    </ul>
</div>
<!-- END Side Navigation -->
</div>
<!-- Sidebar Content -->
</div>
<!-- END Sidebar Scroll Container -->
</nav>