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
                <div class=" text-center">
                    <h1><?= @$row->judul ?></h1>
                </div>
                <div>
                    <img style="width: 100%;  " src="<?= is_file('./uploads/menu/' . @$row->image) ? base_url('uploads/menu/' . @$row->image) : base_url('assets_frontend/assets/custom/images/struktur-org.png') ?>" alt="">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>