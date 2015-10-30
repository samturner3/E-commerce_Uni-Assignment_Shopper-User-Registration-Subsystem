<?php
  include_once 'includes/db_connect_PDO.php';
  include_once 'includes/functions2.php';
  sec_session_start();
 // print_r($_SESSION);
  $db = db_connect();
  if(login_check($db) == true) {
    $_SESSION['pchange'] = "change";
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
              var re = /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/;
              if (!re.test(form.nPass.value) || !re.test(form.oPass.value)) {
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
                <form action="includes/change_password.php" method="post" name="password_form">
                    Old Password: <input type="password" name="oPass" id = "oPass" size="35" />
                    <br>
                    New Password: <input type="password" name="nPass" id="nPass" size="35"/>
                    <br>
                    Confirm Password: <input type="password" name = "conf" id="conf" size="35"/>
                    <input type="hidden" name="pType" value="change"/>
                    <br><br>

                    <input type="button"
                           value="Change Password"
                           onclick="checkPass(this.form);" />
                </form>
              </div>
              <?php include 'includes/footer.php'; ?>
            </div>
          </body>
        </html>
    <?php
  }
  else {
          echo 'You are not authorized to access this page, please <a href="index.php">login</a>.';
  		echo '<pre>';
  		var_dump($_SESSION);
  		echo '</pre>';
  }
 ?>
