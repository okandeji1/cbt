<?php
// set session
session_start();
// Session user
if (!isset($_SESSION['email'])){
  header ('location: ../index.php');
} else {
  // set session for sessioned data
  $email = $_SESSION['email'];
  $time = 6300;
  $_SESSION['time'] = $time;
}
// Logout from session
if(isset($_GET['../logout.php'])){
  session_destroy();
  unset($_SESSION['email']);
  header('location: ../index.php');
  exit();
}
// Fetch database
require '../config/config.php';// Get user with email
$qry = "SELECT * FROM `students` WHERE `email` = '$email' LIMIT 1";
$qrycheck = $mysqli->query($qry) or die($mysqli->error);
if ($qrycheck->num_rows > 0){

    while($fetch = $qrycheck->fetch_assoc()){
        $userId = $fetch['id'];
    }
}              
$query="SELECT * FROM `results` WHERE `user_id` = '$userId' LIMIT 1";
$result = $mysqli->query($query) or die($mysqli->error);
$row = $result->fetch_assoc();
if ($row['user_id'] === $userId){
  echo 'Sorry you have already write this exam! hence you have been logged out';
  header('location: ../index.php');
}
    // Retrieve course id from session
    $courseId = $_SESSION['course_id'];
    // Get page number
    if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
    } else {
      $pageno = 1;
    }
    // Number of records to display per page
    $no_of_records_per_page = 1;
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    $total_pages_sql = "SELECT COUNT(*) FROM `questions` WHERE `course_id` = '$courseId'";
    $result = $mysqli->query($total_pages_sql);
    $total_rows = $result->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    // Get questions
    $query="SELECT * FROM `questions` WHERE `course_id` = '$courseId' ORDER BY RAND() LIMIT $offset, $no_of_records_per_page";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    /*
    * Get total question
    */
    $sql = "SELECT * FROM `questions` WHERE `course_id` = '$courseId'";
    // result
    $results = $mysqli->query($sql) or die($mysqli->error.__LINE__);
    // Total
    $total = $results->num_rows;
?>
<?php include('./examController.php') ?>
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
.hide {
  display: none;
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
                      <input type="hidden" id="time" value='<?php echo $_SESSION['time']; ?>'>
                      <h2>Time Left: <span id="countdown"></span></h2>
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
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <form action="exam.php" method="post">
            <?php while($row = $result->fetch_assoc()){ ?>
              <p>Question <?php echo $pageno; ?> of <?php echo $total; ?></p>
              <div class="form-group">
                <label for="" > <?php echo $row['question']; ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choices" value="optionA" id="choices"> <?php echo $row['option_A']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choices" value="optionB" id="choices"> <?php echo $row['option_B']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choices" value="optionC" id="choices"> <?php echo $row['option_C']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choices" value="optionD" id="choices"> <?php echo $row['option_D']; ?>
              </div>
              <div class="form-group">
                <input type="hidden" name="choices" value="<?php echo $row['answer']; ?>" id="answer">
              </div>
            <?php } ?>
            <?php if($pageno <= 1){ ?> 
              <div class="form-group">
                <a href="<?php if($pageno <= 1){ echo "?pageno=".($pageno + 1); } ?>" type="button" class="btn btn-primary next">Next</a>
              </div>
            <?php }else if($pageno >= $total_pages){ ?>
              <div class="form-group">
              <a href="<?php if($pageno >= $total_pages){ echo '#'; }else { echo "?pageno=".($pageno + 1); } ?>" type="button" class="btn btn-primary submit">Submit</a>
              </div>
            <?php }else { ?>
              <div class="form-group">
              <a href="<?php echo "?pageno=".($pageno + 1); ?>" type="button" class="btn btn-primary next">Next</a>
              </div>
            <?php } ?>
            </form>
          </div>
        </div>
      </div>
      <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
          <li class="page-item">
            <a class="page-link" href="?pageno=1" tabindex="-1">First</a>
          </li>
          <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a></li>
          <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a></li>
          <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
		  </nav>  
    </section>
    <div class="col-md-6">
      <div class="copy">© 2019 CBT SYSTEM | Made with <i class="fa fa-fw fa-heart text-danger" aria-hidden="true"></i> by <a href="https://kandesoft.herokuapp.com" target="_blank">Okandeji</a></div>
   </div>
    </div>
<script src="../public/js/jquery-2.2.4.min.js"></script>
<script src="../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script>

var upgradeTime = document.getElementById('time').value;
var seconds = upgradeTime;
function timer(){
    var hours = Math.floor(seconds / 3600);
    var minutesLeft = Math.floor((seconds) - (hours * 3600));
    var minutes = Math.floor(minutesLeft / 60);
    var remainingSeconds = seconds % 60;
    function pad(n){
        return (n < 10 ? "0" + n : n);
    }
    document.getElementById('countdown').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
    if(seconds == 0){
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = 'Completed';
        window.location = '../index.php'
    }else {
        seconds--;
    }
}
var countdowntimer = setInterval('timer()', 1000);

$(document).ready(()=> {
  $('.next').on('click', (e) => {
    e.preventDefault();
    let choices = $('#choices')
    let choice;
    for(var i = 0; i<choices.length; i++){
      if(choices[i].checked){
         choice = choices[i].value;
      }
    }
    let answer = $('#answer').val();
      console.log(choice + answer);
    return
  })
})

</script>