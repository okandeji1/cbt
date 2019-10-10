<?php

// Connect to the database
require '../config/config.php';
// Initialize variables
$firstname = "";
$lastname = "";
$email = "";
$errors = array();

if (isset($_POST['reg_user'])){
  // get inputed values from the form
  $firstname = $mysqli->real_escape_string($_POST['firstname']);
  $lastname = $mysqli->real_escape_string($_POST['lastname']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $cpassword = $mysqli->real_escape_string($_POST['cpassword']);

  // check if all field is not empty
  if(empty($firstname)){
      array_push($errors, "First name is required");
      return;
  }

  if(empty($lastname)){
    array_push($errors, "Last name is required");
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

  if($cpassword != $password){
        array_push($errors, "Password do not match");
        return;
 }

//  Check if user already exist
$checkUserQuery = "SELECT * FROM `admins` WHERE `email`= '".$email."' LIMIT 1";
$result = $mysqli->query($checkUserQuery) or die($mysqli->error);
$user = $result->fetch_assoc();

if($user){ // If user exists
    if($user['email'] === $email){
        array_push($errors, 'Email already exists');
    }
}
// If no user found
if(count($errors) == 0){
    $hashPassword = password_hash($password, PASSWORD_BCRYPT); // Encript password
    // Prepared statement
    $sql = "INSERT INTO `admins` (`firstname`, `lastname`, `email`, `password`)
    VALUES (?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    // Bind the statement
    $stmt->bind_param('ssss', $firstname, $lastname, $email, $hashPassword);
    // Execute
    $stmt->execute() or die($mysqli->error);

    if($stmt){        
        header('location: ../index.php');
    }else {
        array_push($errors, 'Error in connection'.$mysqli->error);
    }
}else {
    echo $errors;
}
}

?>