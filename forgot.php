<?php
  include_once 'includes/db_connect_PDO.php';
  include_once 'includes/functions2.php';
  sec_session_start();
  $db = db_connect();
  $siteroot = "localhost/comp344Ass2_PDO";
  //If user is directed here from the email form, send them a reset link
  if(isset($_POST['email'])){
    //validate email
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

    //generate reset link and email
    $link =$siteroot . "/forgot.php?" . $token;
    //echo $email;
    $message = "Please follow this link to reset your password " . $link;
    //send email to customer
    mail($email, "Password Reset", $message, "From: jacob.williams@students.mq.edu.au");
    echo "A reset link has been sent to your email address";
    exit;
  }

//if customer is directed to this page from their email link, let them change their password
  if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])){
    //sanitise token to avoid SQL injection
    $token = filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_STRING);
    //echo $token;
    //get shopper id using token
    $SQL = "SELECT shopper_id FROM  pwdreset WHERE link=? LIMIT 1";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1,$token);
    $stmt->execute();
    //send user to homepage if incorrect link
    if($stmt->rowCount() != 1){
      exit("Incorrect link. please return <a href='../index.php'>Home</a>");
    }
    $data = $stmt->fetch();
    $user_id=$data['shopper_id'];

    //generate password reset form
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
            //validate password format
            function checkPass(form){
              var re = /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/;
              if (!re.test(form.nPass.value)) {
            	alert("Passwords must contain must contains one digit from 0-9, one lowercase character, one uppercase character,one special symbols in the list \"@#$%\", length at least 6 characters and maximum of 20.  Please try again.");
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
              <?php require 'includes/pagetop.php'; ?>
              <div id="logonBox">
                <!--Redirect user to change_password.php when they submit form -->
                <form action="includes/change_password.php" method="post" name="password_form">

                    New Password: <input type="password" name="nPass" id="nPass" size="35"/>
                    <br>
                    Confirm Password: <input type="password" name = "conf" id="conf" size="35"/>
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>"/>
                    <!--pType tells change_password what function to execute-->
                    <input type="hidden" name="pType" value="forgot"/>
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
