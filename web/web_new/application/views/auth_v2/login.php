<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login BPBD Kota Surakarta</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url('assets_frontend/assets/') ?>custom/images/bpbd-solo.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets_frontend/login/') ?>css/main.css">
	<!--===============================================================================================-->
</head>
<style>
	.box {
		max-width: 100%;
		padding: 32px 35px 35px 35px;
		border: 1px solid #EEE;
	}

	#captcha_img img {
		width: 100% !important;
	}
</style>

<body>
	<?php
	$get_profil_website = get_profil_website();
	if (is_file('./uploads/logo/' . $get_profil_website->image)) {
		$logo = '<img src="' . base_url('uploads/logo/' . $get_profil_website->image) . '" alt="" style="width: 100%;">';
	} else {
		$logo = '
		<img src="' . base_url('assets_frontend/assets/custom/images/bpbd-solo-text-white.png') . '" style="width: 100%;">
		';
	}
	$logo_ori = '
		<img src="' . base_url('assets_frontend/assets/custom/images/bpbd-solo.png') . '" >
		';
	?>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?= base_url('assets_frontend/assets/') ?>custom/images/himawari.png');">
			<div class="wrap-login100 p-b-30">
				<form method="post" action="<?php echo base_url('login_v2/auth') ?>" class="login100-form validate-form" id="login-form">
					<div class="login100-form-avatar">
						<?php echo $logo_ori; ?>
					</div>
					<span class="login100-form-title p-t-20 p-b-45">
						BPBD Kota Surakarta
					</span>

					<?php echo ($this->session->flashdata('msg') == '' ? '' : '<span class="text-center" style="color: #fff;"><strong>' . $this->session->flashdata('msg') . '</strong></span>'); ?>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
						<input class="input100" type='text' name='username' id='username' placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
						<input class="input100" type='password' name='password' id='password' placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div style="width:40%;" class="wrap-input100 validate-input m-b-10">
						<p id="captcha_img" style="border-radius:25px 0 0 25px"><?= @$image; ?></p>
					</div>

					<div style="width:60%" class="wrap-input100 validate-input m-b-10" data-validate="Captcha is required">
						<input style="border-radius:0 25px 25px 0" class="input100" type='text' name='captcha' id='captcha' placeholder="Kode Captcha" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-code"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" class="login100-form-btn" id="btn-submit">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="<?= base_url('assets_frontend/login/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets_frontend/login/') ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('assets_frontend/login/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets_frontend/login/') ?>vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('assets_frontend/login/') ?>js/main.js"></script>

	<script type="text/javascript">
		$("#login-form").submit(function(event) {
			$("#btn-submit").prop('disabled', true);
		});
	</script>
</body>

</html>