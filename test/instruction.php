<?php
// set session
ob_start();
session_start();
// Session user
if (!isset($_SESSION['email'])){
  header ('location: ../index.php');
} else {
  // set session for sessioned data
  $email = $_SESSION['email'];
}
// Logout from session
if(isset($_GET['../logout.php'])){
  session_destroy();
  unset($_SESSION['email']);
  header('location: ../index.php');
  exit();
}
require '../config/config.php';
$qry = "SELECT * FROM `students` WHERE `email` = '$email' LIMIT 1";
$qrycheck=$mysqli->query($qry) or die($mysqli->error);
if ($qrycheck->num_rows > 0){
    while($fetch = $qrycheck->fetch_assoc()){
        $surname=$fetch['surname'];
        $firstname=$fetch['firstname'];
        $dept=$fetch['department'];
        $id=$fetch['id'];
        $matricNo=$fetch['matric_no'];
    }
}
// Set course title
$course_title = (string) $_GET['title'];
/*
* Get course title
*
*/
$query = "SELECT * FROM `courses` WHERE `title` = '$course_title'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if ($result->num_rows > 0){
    while($fetch = $result->fetch_assoc()){
        $courseId = $fetch['id'];
    }
}
// Store course Id in session
$_SESSION['course_id'] = $courseId;
/*
    * Get total question
    */
    $sql = "SELECT * FROM `questions` WHERE `course_id` = '$courseId'";
    // result
    $results = $mysqli->query($sql) or die($mysqli->error.__LINE__);
    // Total
    $total = $results->num_rows;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8" />
<title>CBT System</title>
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
<link href="../public/css/custom.css" rel="stylesheet">
<link href="../public/css/vendors.css" rel="stylesheet">
<link href="../public/css/all_icons.min.css" rel="stylesheet">
<!-- Icon fonts-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.eot" rel="stylesheet">	    
<style type="text/css">
hr { 
  height: 30px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 1px 0 0 0; 
  border-radius: 20px; 
} 
hr { 
  display: block; 
  content: ""; 
  height: 30px; 
  margin-top: 15px; 
  border-style: solid; 
  border-color: #8c8b8b; 
  border-width: 0 0 1px 0; 
  border-radius: 20px; 
}
</style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 header">
      <h2 class="headtext">Computer Base Test System</h2>
    </div>
</div>
<section id="callaction" class="home-section paddingtop-20">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="callaction bg-gray">
              <div class="row">
                <div class="col-md-8">
                    <div class="cta-text">
                      <h2>Welcome <?php echo  $surname. " " . $firstname; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cta-btn">
                      <a href="../logout.php" class="btn btn-info">Log Out</a>
                      
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="callaction" class="home-section paddingtop-20">
      <div class="col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <h4 style="text-decoration: underline;"><?php echo "Course Title: " . " " . $course_title; ?></h4>
              <p>Total Number of Questions: <?php echo $total; ?></p>
              <p>Total time given: 2 minutes</p>
              <p style="color: #880000; font-size: 16px;">Course Instructions:</p> 
              <p>Attempts all Questions within the limited time provided. You have 2mins for this session.</p>
            </div>
            <div class="col-md-4">
              <div class="cta-btn">
                <div class="btn btn-danger">Time Remaining <span id="timer">0h:2m:00s</span></div>
              </div>
            </div>
          </div>
           <center><div class="row">
            <div class="col-md-12">
              <a href="./exam.php?n=1" class="btn btn-info">START EXAM</a>
            </div>
          </div></center>
        </div>
      </div>
    </section>
    <div class="col-md-6">
      <div class="copy">© 2019 CBT SYSTEM | Made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://kandesoft.herokuapp.com" target="_blank">Okandeji</a></div>
   </div>
    </div>
<script src="../public/js/jquery-2.2.4.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>