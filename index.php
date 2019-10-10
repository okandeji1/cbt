<?php include('./auth/login_auth.php') ?>

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
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">
	<link href="./public/css/vendors.css" rel="stylesheet">
	<link href="./public/css/all_icons.min.css" rel="stylesheet">
	<!-- Icon fonts-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.eot" rel="stylesheet">	

</head>

<body id="login_bg">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<div id="login">
		<aside>
			
			  <form action="index.php" method="POST">
              <?php include('./errors.php'); ?>
				<div class="form-group">
					<span class="input">
					<input class="input_field" type="text" autocomplete="off" name="matric_no">
						<label class="input_label">
						<span class="input__label-content">Your Matric/Reg No</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="password" autocomplete="new-password" name="password">
						<label class="input_label">
						<span class="input__label-content">Your password</span>
					</label>
					</span>
				</div>
				<button type="submit" class="btn_1 rounded full-width add_top_60" name="login_user">Login</button>
			</form>
			<div class="copy">© 2019 CBT SYSTEM | Made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a
                    href="https://kandesoft.herokuapp.com" target="_blank">Okandeji</a></div> 
		</aside>
	</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
    <script src="./public/js/jquery-2.2.4.min.js"></script>
    <script src="./public/js/common_scripts.js"></script>
    <script src="./public/js/main.js"></script>
	<script src="./public/js/validate.js"></script>	
  
</body>
</html>