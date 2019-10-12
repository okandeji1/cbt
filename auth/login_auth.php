<?php
// Connect to the database
require './config/config.php';
// Initialize variables
$email = "";
$errors = array();
$success = array();
// Login Student
if(isset($_POST['login_user'])){
    // get inputed values from the form
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);

  // check if all field is not empty
  if(empty($email)){
      array_push($errors, "Email is required");
      return;
  }

  if(empty($password)){
    array_push($errors, "Password is required");
    return;
  }

  if(count($errors) == 0){
    // mysql prepare statement
      $query = "SELECT `email`, `password` FROM `students` WHERE `email` = ?";
      $stmt = $mysqli->prepare($query);
    // Bind the statement
      $stmt->bind_param('s', $email);
    // Execute statement
      $stmt->execute() or die($mysqli->error);
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){
          $pwd = $row['password'];
        // return true if password verified
            if(password_verify($password, $pwd)){
              // Start session
              session_start();
              $_SESSION['email'] = $email;
              $_SESSION['success'] = "You are logged in";
              header('location: ./test/instruction.php');
            }else {
              array_push($errors, 'Oops! Incorrect matric no or password');
            }
      }
  }else {
      array_push($mysqli->error);
  }
}
?>