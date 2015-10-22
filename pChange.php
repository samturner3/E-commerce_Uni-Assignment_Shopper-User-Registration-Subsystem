<?php
  include_once 'includes/db_connect_PDO.php';
  include_once 'includes/functions2.php';
  sec_session_start();
  print_r($_SESSION);
  $db = db_connect();
  if(login_check($db) == true) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Secure Login: Log In</title>
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
              if (form.nPass.value.length !== 8 || form.oPass.value.length !== 8){
                alert("Passwords must be exactly 8 characters long.  Please try again.");
                //errorBox("Passwords must be exactly 8 characters long.  Please try again.");
                //form.password.focus();
                return false;
              }
              var re = /(?=.*[0-9].*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}/;
              if (!re.test(form.nPass.value) || !re.test(form.oPass.value)) {
             	  alert("Passwords must contain at least two numbers, at least one lowercase and at least one uppercase letter, and be 8 characters long.  Please try again.");
                return false;
              }
              if(form.nPass.value != form.conf.value){
                alert("New password and confirmation password must match");
                return false;
              }
              var p = document.createElement("input");
              var n = document.createElement("input");
              // Add the new element to our form.
              form.appendChild(p);
              form.appendChild(n);

              p.name = "p";
              p.type = "hidden";
              p.value = hex_sha512(form.oPass.value);
              n.name = "n";
              n.type = "hidden";
              n.value = hex_sha512(form.nPass.value);
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
