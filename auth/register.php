<?php include('./reg_auth.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Udema a modern educational site template">
    <meta name="author" content="Ansonika">
    <title>CBT System</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/style.css" rel="stylesheet">
	<link href="../public/css/vendors.css" rel="stylesheet">
	<link href="../public/css/all_icons.min.css" rel="stylesheet">
	<!-- Icon fonts-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.eot" rel="stylesheet">	
	
	<style>
		.d-none {
			display: none;
		}
	</style>

</head>

<body id="register_bg">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<div id="login">
		<aside>
			<figure>
				<a href="#"><img src="img/logo.png" width="149" height="42" data-retina="true" alt=""></a>
			</figure>
			<form autocomplete="off" action="register.php" method="post">
			<?php include('../errors.php'); ?>
				<div class="form-group">

					<span class="input">
					<input class="input_field" type="text" name="firstname" id="firstname">
						<label class="input_label">
						<span class="input__label-content">Your First Name</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="text" name="lastname" id="lastname">
						<label class="input_label">
						<span class="input__label-content">Your Last Name</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="email" name="email" id="email">
						<label class="input_label">
						<span class="input__label-content">Your Email</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="password" id="password1" name="password">
						<label class="input_label">
						<span class="input__label-content">Your password</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="password" id="password2" name="cpassword">
						<label class="input_label">
						<span class="input__label-content">Confirm password</span>
					</label>
					</span>
					<div class="alert alert-danger d-none" id="msg"></div>		
					<div id="pass-info" class="clearfix"></div>
				</div>
				<button type="submit" name="reg_user" class="btn_1 rounded full-width add_top_30 validate">Register</button>
				<div class="text-center add_top_10">Already have an acccount? <strong><a href="../index.php">Sign In</a></strong></div>
			</form>
			<div class="copy">© 2019 CBT SYSTEM | Made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a
                    href="https://kandesoft.herokuapp.com" target="_blank">Okandeji</a></div>
		</aside>
	</div>
	<!-- /login -->
	
	<!-- COMMON SCRIPTS -->
    <script src="../public/js/jquery-2.2.4.min.js"></script>
    <script src="../public/js/common_scripts.js"></script>
    <script src="../public/js/main.js"></script>
	<script src="../public/js/validate.js"></script>
	
	<!-- SPECIFIC SCRIPTS -->  
</body>
</html>