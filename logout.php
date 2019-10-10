<?php
    session_start();
		unset($_SESSION['matric_no']);
		header('location: ./index.php');
		exit();
?>