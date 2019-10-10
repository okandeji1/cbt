<?php
// connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "cbtm";

// connection string to the database
$mysqli = new mysqli($hostname, $username, $password, $dbname);
// check connection
if ($mysqli->connect_error) {
	die ('Error connecting to database' . $mysqli->connect_error);
	exit();
} else {
	true;
}
?>