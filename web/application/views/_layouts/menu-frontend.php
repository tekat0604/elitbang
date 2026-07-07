<?php $get_profil_website = get_profil_website(); ?>
<header id="header-style-1">
    <div class="container">
        <div class="navbar yamm navbar-default">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a href="index.html" class="navbar-brand">Jollyany</a> -->
                <a href="<?php echo base_url(); ?>">

                    <?php if (is_file('./uploads/logo/' . $get_profil_website->image)) { ?>
                        <img class="logo-utama" src="<?= base_url('uploads/logo/' . $get_profil_website->image) ?>" alt="">
                    <?php } else { ?>
                        <img src="<?= base_url('assets_frontend/assets/') ?>custom/images/bpbd-solo-text-white.png" class="logo-utama">
                    <?php
                    } ?>
                </a>
            </div><!-- end navbar-header -->

            <div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="<?= @$li_beranda ?>"><a href="<?= base_url('frontend') ?>">Beranda</a></li>
                    <li class="dropdown <?= @$li_profil ?>">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> profil </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= base_url('profil/tugas_fungsi') ?>"> Tugas & Fungsi </a></li>
                            <li><a href="<?= base_url('profil/visi_misi') ?>"> Visi Misi & Strategi </a></li>
                            <li><a href="<?= base_url('profil/struktur_organisasi') ?>"> Struktur Organisasi </a></li>
                            <li><a href="<?= base_url('profil/profil_pejabat') ?>"> Profil Pejabat </a></li>
                            <li><a href="<?= base_url('profil/profil_pegawai') ?>"> Profil Pegawai </a></li>
                            <li><a href="<?= base_url('profil/agenda_pimpinan') ?>"> Agenda Pimpinan </a></li>
                        </ul>
                    </li>
                    <li class="<?= @$li_cuaca ?>"><a href="<?= base_url('cuaca') ?>">Info Cuaca</a></li>
                    <li class="<?= @$li_berita ?>"><a href="<?= base_url('berita') ?>">Berita</a></li>
                    <li class="<?= @$li_galeri ?>"><a href="<?= base_url('frontend/galeri') ?>">Galeri</a></li>
                    <li class="<?= @$li_unduhan ?>"><a href="<?= base_url('frontend/unduhan') ?>">Unduhan</a></li>
                    <li class="<?= @$li_lapor ?>"><a href="<?= base_url('lapor/lapor') ?>"> Pengaduan</a></li>
                    <li class="dropdown <?= @$li_ppid ?>">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color: #ff6600;">PPID </a>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            foreach (get_page_ppid() as $row) {
                                echo '<li><a href="' . base_url('ppid/page/' . $row->id . '') . '"> ' . $row->judul . ' </a></li>';
                            }
                            ?>
                            <?php
                            foreach (get_kategori_ppid() as $row) {
                                echo '<li><a href="' . base_url('ppid/kategori/' . $row->id . '') . '"> ' . $row->nama_kategori . ' </a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="dropdown <?= @$li_ppid ?>">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Pelayanan Publik </a>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            foreach (get_page_pelayanan_publik() as $row) {
                                echo '<li><a href="' . base_url('pelayanan_publik/page/' . $row->id . '') . '"> ' . $row->judul . ' </a></li>';
                            }
                            ?>
                            <?php
                            foreach (get_kategori_pelayanan_publik() as $row) {
                                echo '<li><a href="' . base_url('pelayanan_publik/kategori/' . $row->id . '') . '"> ' . $row->nama_kategori . ' </a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="<?= @$li_peta ?>" style="display: none;"><a href="<?= base_url('peta') ?>">Peta</a></li>
                </ul><!-- end navbar-nav -->
            </div><!-- #navbar-collapse-1 -->
        </div><!-- end navbar yamm navbar-default -->
    </div><!-- end container -->
</header><!-- end header-style-1 -->