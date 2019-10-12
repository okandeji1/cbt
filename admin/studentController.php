<!-- Create Conditional Statement -->
<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$surname = "";
$firstname = "";
$othername = "";
$email = "";
$matric = "";
$dept = "";
$errors = array();
$success = array();
/* Conditional statement to add student
* we have select and insert query
* If post is set
*/
if (isset($_POST['add_std'])){
  // get inputed values from the form
  $surname = $mysqli->real_escape_string($_POST['surname']);
  $firstname = $mysqli->real_escape_string($_POST['firstname']);
  $othername = $mysqli->real_escape_string($_POST['other_name']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $matric = $mysqli->real_escape_string($_POST['matric_no']);
  $dept = $mysqli->real_escape_string($_POST['dept']);

  // check if all field is not empty
  if(empty($surname)){
      array_push($errors, "Surname is required");
      return;
  }

  if(empty($firstname)){
    array_push($errors, "First name is required");
    return;
  }

  if(empty($othername)){
    array_push($errors, "Other name is required");
    return;
  }

  if(empty($email)){
        array_push($errors, "Email is required");
        return;
 }

  if(empty($password)){
        array_push($errors, "Password is required");
        return;
 }

 if(empty($matric)){
    array_push($errors, "Matric No is required");
    return;
}

if(empty($dept)){
    array_push($errors, "Department is required");
    return;
}

//  Check if user already exist
$checkUserQuery = "SELECT * FROM `students` WHERE `matric_no`= '".$matric."' LIMIT 1";
$result = $mysqli->query($checkUserQuery) or die($mysqli->error);
$user = $result->fetch_assoc();

if($user){ // If user exists
    if($user['matric_no'] === $matric){
        array_push($errors, 'This Matric No already exists');
    }
}
// If no user found
if(count($errors) == 0){
    $hashPassword = password_hash($password, PASSWORD_BCRYPT); // Encript password
    // Prepared statement
    $sql = "INSERT INTO `students` (`surname`, `firstname`, `othername`, `email`, `password`, `matric_no`, `department`)
    VALUES (?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    // Bind the statement
    $stmt->bind_param('sssssss', $surname, $firstname, $othername, $email, $hashPassword, $matric, $dept);
    // Execute
    $stmt->execute() or die($mysqli->error);

    if($stmt){        
        header('location: ./std_page.php');
        array_push($success, 'Student created successfully!');
    }else {
        array_push($errors, 'Error in connection'.$mysqli->error);
    }
}else {
    echo $errors;
}
}

?>