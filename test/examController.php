<?php require '../config/config.php' ?>
<?php
// Check to see if score is set
  if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
  }

  if(isset($_POST['id'])){
    $courseId = $_POST['id'];
    // Number of records to display per page
    // Get questions
    $query = "SELECT * FROM `questions` WHERE `course_id` = '$courseId' ORDER BY RAND()";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    // Storing in array
    $arr = array();
    while($row = $result->fetch_assoc()){
      $arr[] = $row;
    }
    // returning response in JSON format
    echo json_encode($arr);
  }
  // if($_POST){
  //   $courseId = $_SESSION['course_id'];
  //   $number = $_SESSION['pageno'];
  //   $selected_choice = $_POST['choice'];
  //   $next = $number+1;

  //   /*
  //   * Get correct choice
  //   */
  //   $query = "SELECT * FROM `questions` WHERE `course_id` = '$courseId' AND `question_number` = '$number'";
  //   // Get result
  //   $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  //   // Get row
  //   $row = $result->fetch_assoc();
  //   // Get correct choice
  //   $correct_choice = $row['answer'];
  //   // Compare
  //   if($correct_choice === $selected_choice){
  //     // Answer is correct
  //     $_SESSION['score']++;
  //   }
  //   // Check last question
  //   if($number == $total){
  //     $scores = $_SESSION['score'];
  //     // Prepared statement to insert scores
  //     $sql = "INSERT INTO `results` (`user_id`, `course_id`, `score`)
  //     VALUES ('$userId', '$courseId', '$scores')";
  //     $stmt = $mysqli->query($sql) or die($mysqli->error.__LINE__);
  //     echo 'Successful';
  //     header('location: ../index.php');
  //   }else {
  //     header('location: ./exam.php/?n='.$next);
  //   }
  // }








?>