<?php require '../config/config.php' ?>
<?php

  // Load questions to the page
  if(isset($_POST['id'])){
    $courseId = $_POST['id'];
    // Number of records to display per page
    // Get questions
    $query = "SELECT * FROM `questions` WHERE `course_id` = '$courseId' ORDER BY RAND()";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    // Storing in array
    $arr = array();
    // Loop through the data
    while($row = $result->fetch_assoc()){
      $arr[] = $row;
    }
    // returning response in JSON format
    echo json_encode($arr);
  }

  // Post score
  if($_POST['score']){
    $courseId = $_SESSION['course_id'];
    $score = $_POST['score'];
    
    // Prepared statement to insert scores
    $sql = "INSERT INTO `results` (`user_id`, `course_id`, `score`)
    VALUES ('$userId', '$courseId', '$scores')";
    $stmt = $mysqli->query($sql) or die($mysqli->error.__LINE__);
    echo 'Successful';
    header('location: ../index.php');
  }








?>