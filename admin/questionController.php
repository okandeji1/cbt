<!-- Create Conditional Statement -->
<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$courseTitle = "";
$question = "";
$optionA = "";
$optionB = "";
$optionC = "";
$optionD = "";
$errors = array();
$success = array();
/* Conditional statement to add student
* we have select and insert query
* If post is set
*/
if (isset($_POST['addQuestion'])){
  // get inputed values from the form
  $courseTitle = $mysqli->real_escape_string($_POST['course']);
  $question = $mysqli->real_escape_string($_POST['question']);
  $optionA = $mysqli->real_escape_string($_POST['optionA']);
  $optionB = $mysqli->real_escape_string($_POST['optionB']);
  $optionC = $mysqli->real_escape_string($_POST['optionC']);
  $optionD = $mysqli->real_escape_string($_POST['optionD']);
  $answer = $mysqli->real_escape_string($_POST['answer']);

  // check if all field is not empty
  if(empty($courseTitle)){
      array_push($errors, "Course Title is required");
      return;
  }

  if(empty($question)){
    array_push($errors, "Question is required");
    return;
  }

  if(empty($optionA)){
    array_push($errors, "Option A is required");
    return;
  }

  if(empty($optionB)){
        array_push($errors, "Option B is required");
        return;
 }

  if(empty($optionC)){
        array_push($errors, "Option C is required");
        return;
 }

 if(empty($optionD)){
    array_push($errors, "Option D is required");
    return;
}

if(empty($answer)){
    array_push($errors, "Provide a correct option");
    return;
}

//  Check if user already exist
$query = "SELECT `question` FROM `questions` WHERE `question`= '$question' LIMIT 1";
$result = $mysqli->query($query) or die($mysqli->error);
$row = $result->fetch_assoc();

if($row){ // If question exists
    if($row['question'] === $question){
        array_push($errors, 'This question has already been added');
    }
}
// If no row found
if(count($errors) == 0){
    // Get course by course title
    $courseQuery = "SELECT `title` FROM `courses` WHERE `title`= '$courseTitle' LIMIT 1";
    $result = $mysqli->query($courseQuery) or die($mysqli->error);
    $getResult = $result->fetch_assoc();
    if($getResult){
        // course id
        $courseId = $getResult['id'];
        // Prepared statement
        $sql = "INSERT INTO `questions` (`course_id`, `question`, `option_A`, `option_B`, `option_C`, `option_D`, `answer`)
        VALUES (?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        // Bind the statement
        $stmt->bind_param('issssss', $courseId, $question, $optionA, $optionB, $optionC, $optionD, $answer);
        // Execute
        $stmt->execute() or die($mysqli->error);

        if($stmt){     
            header('location: ./question.php');
            array_push($success, 'Question added successfully!');
        }else {
            array_push($errors, 'Error in connection'.$mysqli->error);
        }
    }else {
        array_push($errors, 'Error in connection'.$mysqli->error);
    }
  }else {
    array_push($errors, 'Error in connection'.$mysqli->error);
  }
    
}

?>