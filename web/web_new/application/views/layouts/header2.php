            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section" style="width: 210px">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button> 

                        <select id="rubah_session_periode" style="width: 140px; margin-left: 30px;">
                        <?php
                            $sql = "SELECT * FROM ref_periode WHERE aktif='1' ORDER BY periode DESC";
                            $data_periode = $this->db->query($sql)->result_array();
                            foreach ($data_periode as $tampil_periode) {
                                $selected = "";
                                if ($this->session->userdata('id_periode') == $tampil_periode['id']) {
                                    $selected = "selected";
                                }
                                echo '<option value="'.$tampil_periode['id'].'" '.$selected.'> 
                                '.$tampil_periode['periode'].'</option>';
                            }
                            ?>
                        </select>
                    </div> 
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                    <a href="<?php echo base_url(); ?>" target="_blank" class="btn btn-link" style="margin-top: 2px;"> 
                    <i class="fa fa-arrow-left"></i> Lihat Website</a>
                         
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $this->session->userdata('nama'); ?><i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                                <a class="dropdown-item" href="<?= base_url('admin/profil');?>">
                                    <i class="si si-user mr-5"></i> Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/login/out');?>">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->  

                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>