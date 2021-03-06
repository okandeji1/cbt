<!-- Create Conditional Statement -->
<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$title = "";
$lecturer = "";
$student = "";
$time = "";
$errors = array();
$success = array();
/* Conditional statement to add student
* we have select and insert query
* If post is set
*/
if (isset($_POST['addCourse'])){
  // get inputed values from the form
  $title = $mysqli->real_escape_string($_POST['title']);
  $lecturer = $mysqli->real_escape_string($_POST['lecturer']);
  $student = $mysqli->real_escape_string($_POST['student']);
  $time = $mysqli->real_escape_string($_POST['time']);

  // check if all field is not empty
  if(empty($title)){
      array_push($errors, "Course title is required");
      return;
  }

  if(empty($lecturer)){
    array_push($errors, "Course lecturer is required");
    return;
  }

  if(empty($student)){
    array_push($errors, "Student is required");
    return;
  }

  if(empty($time)){
    array_push($errors, "Time is required");
    return;
  }

//  Check if user already exist
$checkUserQuery = "SELECT * FROM `courses` WHERE `title`= '$title'";
$result = $mysqli->query($checkUserQuery) or die($mysqli->error);
$course = $result->fetch_assoc();

if($course){ // If course exists
    if($course['title'] === $title){
        array_push($errors, 'This Course already exists');
    }
}
// If no user found
if(count($errors) == 0){
    // Prepared statement
    $sql = "INSERT INTO `courses` (`title`, `lecturer`, `student`)
    VALUES (?,?,?)";
    $stmt = $mysqli->prepare($sql);
    // Bind the statement
    $stmt->bind_param('sssi', $title, $lecturer, $student, $time);
    // Execute
    $stmt->execute() or die($mysqli->error);

    if($stmt){        
        header('location: ./course.php');
        array_push($success, 'Course created successfully!');
    }else {
        array_push($errors, 'Error in connection'.$mysqli->error);
    }
  }else {
    echo $errors;
  }

}

/*
* Process delete API
*/
if(isset($_GET['n'])){
  $course_id = (int) $_GET['n'];
  $query = "DELETE FROM `courses` WHERE `id` = '$course_id'";
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

  if($result){
    header('location: ./course.php');
  }else {
    array_push($errors, 'Error in connection'.$mysqli->error);
  }
}
/*
* Update API
*/
if(isset($_POST['update'])){
  $course_id = $mysqli->real_escape_string($_POST['id']);
  $title = $mysqli->real_escape_string($_POST['title']);
  $lecturer = $mysqli->real_escape_string($_POST['lecturer']);
  $student = $mysqli->real_escape_string($_POST['student']);

  // Process update
  $update_query = "UPDATE `courses` SET `title` = '$title', `lecturer` = '$lecturer', `student` = '$student' WHERE `id` = '$course_id'";
  $update = $mysqli->query($update_query) or die($mysqli->error.__LINE__);
  // Check update
  if($update){
    header('location: ./course.php');
    echo '<div class="alert alert-success">
    <span>Data Updated Successfuly......!!</span></div>';
  }else {
    array_push($errors, 'Error in connection'.$mysqli->error);
  }
}
?>