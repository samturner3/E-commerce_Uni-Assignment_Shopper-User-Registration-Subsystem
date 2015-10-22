<?php
  include_once 'db_connect_PDO.php';
  include_once 'functions2.php';
  sec_session_start();
  $db = db_connect();
  $siteroot = "localhost/comp344Ass2_PDO";
  if(isset($_POST['email'])){
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $emailreg ='/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
    if(!preg_match($emailreg,$email)){
      exit("Invalid Email");
    }

    //get users shopper_id
    $SQL="SELECT shopper_id FROM shopper WHERE sh_email=? LIMIT 1";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1,$email);
    $stmt->execute();
    if($stmt->rowCount() != 1){
      //user doesn't exist
      exit("Email not found in database. Please try again");
    }
    $data = $stmt->fetch();
    $user_id = $data['shopper_id'];

    //create password reset token
    $token = bin2hex(openssl_random_pseudo_bytes(16));

    //add token to pwdreset table
    $SQL = "INSERT INTO pwdreset (link, shopper_id) VALUES (?,?)";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1,$token);
    $stmt->bindParam(2,$user_id);
    $stmt->execute();

    $link =$siteroot . "/includes/forgot.php?" . $token;
    //echo $link;
    $message = "Please follow this link to reset your password " . $link;
    mail($email, "Password Reset", $message, "From: jacob.williams@students.mq.edu.au");
    echo "A reset link has been sent to your email address";
  }
  if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){
    $token = filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_STRING);
    //echo $token;
    $SQL = "SELECT shopper_id FROM  pwdreset WHERE link=? LIMIT 1";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1,$token);
    $stmt->execute();
    if($stmt->rowCount() != 1){
      exit("Incorrect link. please return <a href='../index.php'>Home</a>");
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Change Password</title>
            <link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
            <link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css" />
            <link href="styles/css/font-awesome.css" rel="stylesheet" type="text/css" />
            <script type="text/JavaScript" src="js/sha512.js"></script>
            <script type="text/JavaScript" src="js/forms.js"></script>
            <script src="sliderengine/jquery.js"></script>
            <script src="sliderengine/amazingslider.js"></script>
            <link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
            <script src="sliderengine/initslider-1.js"></script>

            <script type="text/JavaScript">
            function checkPass(form){
              if (form.nPass.value.length !== 8 || form.conf.value.length !== 8){
                alert("Passwords must be exactly 8 characters long.  Please try again.");
                //errorBox("Passwords must be exactly 8 characters long.  Please try again.");
                //form.password.focus();
                return false;
              }
              var re = /(?=.*[0-9].*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}/;
              if (!re.test(form.nPass.value) || !re.test(form.conf.value)) {
             	  alert("Passwords must contain at least two numbers, at least one lowercase and at least one uppercase letter, and be 8 characters long.  Please try again.");
                return false;
              }
              if(form.nPass.value != form.conf.value){
                alert("New password and confirmation password must match");
                return false;
              }

              form.submit();
              return true;
            }
            </script>


        </head>
        <body class="no_col_2">
            <div id="site">
              <?php require 'pagetop.php'; ?>
              <div id="logonBox">
                <form action="includes/change_password.php" method="post" name="password_form">

                    New Password: <input type="password" name="nPass" id="nPass" size="35"/>
                    <br>
                    Confirm Password: <input type="password" name = "conf" id="conf" size="35"/>
                    <br><br>

                    <input type="button"
                           value="Change Password"
                           onclick="checkPass(this.form);" />
                </form>
              </div>
            </div>
          </body>
        </html>
    <?php
  }
 ?>
