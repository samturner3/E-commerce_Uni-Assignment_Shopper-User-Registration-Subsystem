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
    echo $oPass;
    echo $nPass;
    echo $conf;
      if (password_verify($oPass, $data['sh_password'])) {
        if(!password_verify($nPass, $data['sh_password'])){
          $password = password_hash($nPass, PASSWORD_DEFAULT);
          $SQL = "UPDATE shopper SET sh_password=? WHERE shopper_id=$_SESSION[user_id]";
          $stmt = $db->prepare($SQL);
          $stmt->bindParam(1,$password);
          $stmt->execute();
          echo "Password changed successfully please return <a href='comp344Ass2_PDO/home.php'>Home</a>";
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
