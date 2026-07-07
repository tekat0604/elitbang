<!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a href="<?= base_url(); ?>admin/beranda"><i class="si si-home"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li class="nav-main-heading" hidden>
            <span class="sidebar-mini-visible">UI</span>
            <span class="sidebar-mini-hidden"> Peta</span>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/peta">
                <i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>peta" target="_blank">
                <i class="fa fa-map-marker"></i><span class="sidebar-mini-hide">Peta</span>
            </a>
        </li>
        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Data</span></li>
        <li hidden>
            <a class="<?= @$li_lapor ?>" href="<?= base_url(); ?>admin/lapor"><i class="si si-bubbles"></i><span class="sidebar-mini-hide">Lapor</span>
                <span class="badge badge-danger" id="notif-msg-belum-dibaca"><?= count_message()->belum_dibaca ?></span>
                <span class="badge badge-warning" id="notif-msg-belum-dibalas"><?= count_message()->belum_dibalas ?></span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/korban_bencana"><i class="si si-user"></i><span class="sidebar-mini-hide"> Korban Bencana</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/Pengungsian"><i class="si si-user"></i><span class="sidebar-mini-hide">Data Pengungsian</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/Data_relawan"><i class="si si-support"></i><span class="sidebar-mini-hide">Data Relawan</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/Korban_jiwa"><i class="si si-user-follow"></i><span class="sidebar-mini-hide">Data Korban Jiwa</span></a>
        </li>                   
        <li>
            <a href="<?= base_url(); ?>admin/Kerusakan_fasilitas"><i class="si si-shield"></i><span class="sidebar-mini-hide">Data Kerusakan Fasilitas</span></a>
        </li>
        <li hidden>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-list"></i><span class="sidebar-mini-hide">Rekapitulasi</span></a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/rekapitulasi/"> Korban Bencana </a>
                </li>
            </ul>
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
        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Manajement Website </span></li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-book-open"></i><span class="sidebar-mini-hide">Beranda</span></a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/slider"> Slider</a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/pesan_singkat"> Pesan Singkat </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/home/grid_dua"> Grid 2</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-flag"></i><span class="sidebar-mini-hide">Profil</span></a>
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

        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Berita</span></a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/kategori_berita"> Kategori </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/frontend/berita"> Berita </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/agenda_kegiatan"><i class="si si-bell"></i>
                <span class="sidebar-mini-hide"> Agenda Kegiatan</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/informasi_kebencanaan"><i class="si si-bell"></i>
                <span class="sidebar-mini-hide"> Informasi Kebencanaan</span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/unduhan"><i class="si si-cloud-download"></i>
                <span class="sidebar-mini-hide"> Unduhan </span></a>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/galeri"><i class="si si-picture"></i>
                <span class="sidebar-mini-hide"> Galeri </span></a>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide"> PPID </span></a>
            <ul>
                <li>
                    <a href="<?= base_url(); ?>admin/page_ppid">Page Ppid </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/kategori_ppid"> Kategori </a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>admin/ppid"> PPID </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?= base_url(); ?>admin/frontend/profil_website"><i class="si si-globe"></i>
                <span class="sidebar-mini-hide"> Profil Website </span></a>
        </li>
    </ul>
</div>
<!-- END Side Navigation -->
</div>
<!-- Sidebar Content -->
</div>
<!-- END Sidebar Scroll Container -->
</nav>