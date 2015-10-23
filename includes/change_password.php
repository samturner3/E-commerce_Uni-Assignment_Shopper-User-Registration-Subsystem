<?php
  include_once 'db_connect_PDO.php';
  include_once 'functions2.php';
  sec_session_start();

  $db = db_connect();
  //print_r($_POST);
  //print_r($_SESSION);
//If user is changing their password while logged in, execute this
  $shopper_id = $_SESSION['user_id'];
  if($_POST['pType'] == "change"){
    if(isset($_POST['oPass'], $_POST['nPass'], $_POST['conf'], $_SESSION['user_id'])){
      change_password($shopper_id);
    }
  }
  //if user is changing their password from reset link, execute this
  if($_POST['pType'] == "forgot"){
    if(isset($_POST['nPass'], $_POST['conf'], $_POST['user_id'])){
      forgot_password();
      //ask user to log in with new password
      echo "Password changed. You can now <a href='../index.php'>log in</a>";
    }
  }
?>
