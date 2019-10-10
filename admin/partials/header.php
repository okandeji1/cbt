<!-- Start session -->
<?php 
session_start();

if(!isset($_SESSION['email'])){
  $_SESSION['message'] = 'You must login first';
  header('location: ./login.php');
}

if(isset($_GET['./admin_logout.php'])){
  session_destroy();
  unset($_SESSION['email']);
  header('location: ./login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>CBT SYSTEM - Admin dashboard</title>
	
  <!-- Favicons-->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
	
  <!-- Bootstrap core CSS-->
  <link href="../public/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="../public/css/admin.css" rel="stylesheet">
  <!-- Plugin styles -->
  <link href="../public/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.eot" rel="stylesheet">	  
</head>

<body class="fixed-nav sticky-footer" id="page-top">
<!-- Navigation-->
<?php include('./partials/nav.php'); ?>
  <!-- /Navigation-->