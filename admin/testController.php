<!-- Create Conditional Statement -->
<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$courseTitle = "";
$time = "";
$errors = array();
/* Conditional statement to add Test
* we have select and insert query
* If post is set
*/
if (isset($_POST['addTest'])){
  // get inputed values from the form
  $courseTitle = $mysqli->real_escape_string($_POST['course']);
  $time = $mysqli->real_escape_string($_POST['time']);

  // check if all field is not empty
  if(empty($courseTitle)){
      array_push($errors, "Course Title is required");
      return;
  }

  if(empty($time)){
    array_push($errors, "Time is required");
    return;
  }

    //  Get course ID with course title
    $query = "SELECT * FROM `courses` WHERE `title`= '$courseTitle' LIMIT 1";
    $result = $mysqli->query($query) or die($mysqli->error);
    $row = $result->fetch_assoc();

    if($row){ // If Course title exists
        // Get id
        $courseId = $row['id'];
        // Query test with course id
        $courseQuery = "SELECT `course_id` FROM `tests` WHERE `course_id`= '$courseId' LIMIT 1";
        $result = $mysqli->query($courseQuery) or die($mysqli->error);
        $getResult = $result->fetch_assoc();
        // Check if course id already exist
        if($getResult['course_id'] === $courseId){
            array_push($errors, 'This course already exist!');
        }else if(count($errors) == 0){           
            // Prepared statement
            $sql = "INSERT INTO `tests` (`course_id`, `time`)
            VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            // Bind the statement
            $stmt->bind_param('is', $courseId, $time);
            // Execute
            $stmt->execute() or die($mysqli->error);
        }else {
            array_push($errors, 'Error in connection'.$mysqli->error);
        }
    }else {
        array_push($errors, 'Error in connection'.$mysqli->error);
    }              
}
?>