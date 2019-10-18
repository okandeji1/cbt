<?php require '../config/config.php' ?>
<?php
// Check to see if score is set
  if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
  }
  if($_POST){
    $courseId = 2;
    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];
    $next = $number+1;

    /*
    * Get correct choice
    */
    $query = "SELECT * FROM `questions` WHERE `course_id` = '$courseId' AND `question_number` = '$number'";
    // Get result
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    // Get row
    $row = $result->fetch_assoc();
    // Get correct choice
    $correct_choice = $row['answer'];
    // Compare
    if($correct_choice === $selected_choice){
      // Answer is correct
      $_SESSION['score']++;
    }
    // Check last question
    if($number == $total){
      $scores = $_SESSION['score'];
      // Prepared statement to insert scores
      $sql = "INSERT INTO `results` (`user_id`, `course_id`, `score`)
      VALUES ('$userId', '$courseId', '$scores')";
      $stmt = $mysqli->query($sql) or die($mysqli->error.__LINE__);
      echo 'Successful';
      header('location: ../index.php');
    }else {
      header('location: ./exam.php/?n='.$next);
    }
  }








?>