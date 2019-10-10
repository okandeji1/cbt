<?php 
session_start();

if(!isset($_SESSION['matric_no'])){
  $_SESSION['message'] = 'You must login first';
  header('location: ../index.php');
}

if(isset($_GET['../logout.php'])){
  session_destroy();
  unset($_SESSION['matric_no']);
  header('location: ../index.php');
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
  <title>CBT SYSTEM</title>
	
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
  <!-- BASE CSS -->
    <link href="../public/css/style.css" rel="stylesheet">
	<link href="../public/css/vendors.css" rel="stylesheet">
    <link href="../public/css/all_icons.min.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.eot" rel="stylesheet">	  
</head>
<body>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h1>Instructions</h1>
              </div>
              <div class="card-body">
                <p>set of instructions...</p>
              </div>
              <div class="card-footer">
                <a href="#"><i class="fa fa-arrow-right">Proceed</i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Bootstrap core JavaScript-->
    <script src="../public/js/jquery-2.2.4.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>