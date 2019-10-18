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
// Fetch database
require '../config/config.php';// Get user with email
$qry="SELECT * FROM `students` WHERE `email` = '$email' LIMIT 1";
$qrycheck=$mysqli->query($qry) or die($mysqli->error);
if ($qrycheck->num_rows > 0){

    while($fetch = $qrycheck->fetch_assoc()){
        $userId = $fetch['id'];
    }
} else {
    echo "No user data found";
}

// Set question number
$number = (int) $_GET['n'];
              
$query="SELECT * FROM `results` WHERE `user_id` = '$userId' LIMIT 1";
$result = $mysqli->query($query) or die($mysqli->error);
$row = $result->fetch_assoc();
if ($row['user_id'] == $userId){
  header('location: ../index.php');
}
  $courseId = 2;
// Prepared statement to get question
$questionQuery = "SELECT * FROM `questions` WHERE `course_id`= '$courseId' AND `question_number` = '$number'";
$question = $mysqli->query($questionQuery) or die($mysqli->error.__LINE__);
    /*
    * Get total question
    */
    $qry = "SELECT * FROM `questions` WHERE `course_id` = '$courseId'";
    // result
    $results = $mysqli->query($qry) or die($mysqli->error.__LINE__);
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
            <?php while($row = $question->fetch_assoc()){ ?>
              <p>Question <?php echo $row['question_number']; ?> of <?php echo $total; ?></p>
              <div class="form-group">
                <label for="" > <?php echo $row['question']; ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choice" value="optionA"> <?php echo $row['option_A']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choice" value="optionB"> <?php echo $row['option_B']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choice" value="optionC"> <?php echo $row['option_C']; ?>
              </div>
              <div class="form-group">
                <input type="checkbox" name="choice" value="optionD"> <?php echo $row['option_D']; ?>
              </div>
            <?php } ?>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Next">
                <input type="hidden" name="number" value="<?php echo $number; ?>">
              </div>
            </form>
          </div>
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
<script>

var upgradeTime = 6300;
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

$(document).ready(function() {
    $('input[type="checkbox"]').change(function(){ 
        var $this =  $(this).parents('#quiz-options').find('input[type="checkbox"]');
        $this.not(this).prop('checked', false);
        // ADDED THIS script
        // WILL DISABLE THE HIDDEN INPUT IF ANY OF THE CHECKBOX IS SELECTED
        var $nextthis = $(this).parents('#quiz-options').find('.null');
        $nextthis.attr('disabled', true);
    });
});

$('.cont').addClass('hide');
    count=$('.questions').length;
     $('#question'+1).removeClass('hide');

     $(document).on('click', '.next',function(){
         element=$(this).attr('id');
         last = parseInt(element.substr(element.length - 1));
         nex=last+1;
         $('#question'+last).addClass('hide');

         $('#question'+nex).removeClass('hide');
     });

     $(document).on('click', '.previous',function(){
         element=$(this).attr('id');
         last = parseInt(element.substr(element.length - 1));
         pre=last-1;
         $('#question'+last).addClass('hide');

         $('#question'+pre).removeClass('hide');
     });

</script>