<?php

// Start session
session_start();
// Connect to the database
require '../config/config.php';
// Initialize variables
$email = "";
$errors = array();
$success = array();
// Login Student
if(isset($_POST['admin_auth'])){
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
      $query = "SELECT `email`, `password` FROM `admins` WHERE `email` = ?";
      $stmt = $mysqli->prepare($query);
    // Bind the statement
      $stmt->bind_param('s', $email);
    // Execute
      $stmt->execute() or die($mysqli->error);
      $user = $stmt->get_result();
      while($row = $user->fetch_assoc()){
          $pwd = $row['password'];
        // return true if password verified
            if(password_verify($password, $pwd)){
              $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are logged in";
                header('location: ./dashboard.php');
            }else {
              array_push($errors, 'Oops! Incorrect email or password');
            }
      }
  }else {
      array_push($mysqli->error);
  }
}
?>