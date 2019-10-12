<!-- Create Conditional Statement -->
<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$title = "";
$lecturer = "";
$student = "";
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

//  Check if user already exist
$checkUserQuery = "SELECT * FROM `courses` WHERE `title`= '$title' LIMIT 1";
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
    $stmt->bind_param('sss', $title, $lecturer, $student);
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

?>