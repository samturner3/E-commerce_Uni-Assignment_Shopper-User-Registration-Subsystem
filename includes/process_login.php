<?php
include_once 'db_connect_PDO.php';
include_once 'functions2.php';

sec_session_start(); // Custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = db_connect();

    if (login($email, $password, $db) == true) {
        // Login success
        header('Location: ../home.php');
    } else {
        // Login failed
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
