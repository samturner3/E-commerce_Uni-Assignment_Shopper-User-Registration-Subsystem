<?php
  include_once 'db_connect_PDO.php';
  include_once 'functions2.php';
  sec_session_start();

  $db = db_connect();
  //print_r($_POST);
  //print_r($_SESSION);

  $shopper_id = $_SESSION['user_id'];
  if(isset($_POST['oPass'], $_POST['nPass'], $_POST['conf'], $_SESSION['user_id'])){
    $oPass = filter_input(INPUT_POST, 'oPass', FILTER_SANITIZE_STRING);
    $nPass = filter_input(INPUT_POST, 'nPass', FILTER_SANITIZE_STRING);
    $conf = filter_input(INPUT_POST, 'conf', FILTER_SANITIZE_STRING);

    //check existing password
    $SQL = "SELECT sh_password FROM shopper WHERE shopper_id=? LIMIT 1";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1, $shopper_id);
    $stmt->execute();
    $data = $stmt->fetch();
    
    $passreg = "/(?=.*[0-9].*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}/";
    if(!strlen($oPass)==8 || !strlen($nPass)==8 || !strlen($conf)==8){
      exit("Passwords must be 8 characters long");
    }
    if(!preg_match($passreg, $oPass) || !preg_match($passreg, $nPass) || !preg_match($passreg, $conf)){
      exit("Passwords must contain at least two numbers, at least one lowercase and at least one uppercase letter, and be 8 characters long.  Please try again.");
    }

    if (password_verify($oPass, $data['sh_password'])) {
      if(!password_verify($nPass, $data['sh_password'])){
        if($nPass == $conf){
          $password = password_hash($nPass, PASSWORD_DEFAULT);
          $SQL = "UPDATE shopper SET sh_password=? WHERE shopper_id=$_SESSION[user_id]";
          $stmt = $db->prepare($SQL);
          $stmt->bindParam(1,$password);
          $stmt->execute();
          $_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);

          echo "Password changed successfully please return <a href='/comp344Ass2_PDO/home.php'>Home</a>";
        }
        else{
          echo "New password and confirmation don't match. please try again";
        }
      }
      else{
        echo "New password must be different from old password";
      }
    }
    else {
      echo "Incorrect Password. Please re-enter old password";
    }
  }
?>
