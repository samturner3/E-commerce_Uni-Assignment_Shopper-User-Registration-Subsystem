<?php
include_once 'db_connect.php';
include_once 'functions2.php';
 
sec_session_start(); // Custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 
 
    if (login($email, $password, $conn) == true) {
        // Login success 
	
		echo ('Logged In');
        header('Location: ../home.php');
    } else {
        // Login failed 
		echo ('Failed');
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}