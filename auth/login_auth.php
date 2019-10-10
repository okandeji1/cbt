<?php

// Start session
session_start();
// Connect to the database
require '../config/config.php';
// Initialize variables
$matricNo = "";
$errors = array();
// Login Student
if(isset($_POST['login_user'])){
    // get inputed values from the form
  $matricNo = $mysqli->real_escape_string($_POST['matric_no']);
  $password = $mysqli->real_escape_string($_POST['password']);

  // check if all field is not empty
  if(empty($email)){
      array_push($errors, "Matric/Reg no is required");
      return;
  }

  if(empty($password)){
    array_push($errors, "Password is required");
    return;
  }

  if(count($errors) == 0){
      $query = "SELECT `matric_no`, `password` FROM `students` WHERE `matric_no` = ?";
      $stmt = $mysqli->prepare($query);
    // Bind the statement
      $stmt->bind_param('s', $email);
    // Execute
      $stmt->execute() or die($mysqli->error);
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()){
          $pwd = $row['password'];
        // return true if password verified
            if(password_verify($password, $pwd)){
              $_SESSION['matric_no'] = $matricNo;
                $_SESSION['success'] = "You are logged in";
                header('location: ./instruction.php');
            }else {
              array_push($errors, 'Oops! Incorrect matric no or password');
            }
      }
  }else {
      array_push($errors);
  }
}
?>