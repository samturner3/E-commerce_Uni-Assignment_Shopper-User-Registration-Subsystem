<?php
  include_once 'includes/db_connect_PDO.php';
  include_once 'includes/functions2.php';
  sec_session_start();
  $db = db_connect();
  //can't see this page if logged in
  if(login_check($db)==true){
    header('Location: ./home.php');
  }
  else{
    //Generate forgot password form
    //form redirects to forgot.php when submitted
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Forgot Password?</title>
            <link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
            <link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css" />
            <link href="styles/css/font-awesome.css" rel="stylesheet" type="text/css" />
            <script type="text/JavaScript" src="js/sha512.js"></script>
            <script type="text/JavaScript" src="js/forms.js"></script>
            <script src="sliderengine/jquery.js"></script>
            <script src="sliderengine/amazingslider.js"></script>
            <link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
            <script src="sliderengine/initslider-1.js"></script>
            <script type="text/javascript">
              function checkEmail(form){
                var re = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
                if(!re.test(form.email.value)) {
              		alert("The email address you entered is not valid. Please Try Again.");
              		//form.email.focus();
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
                  <form action="includes/forgot.php" method="post" name="email_form">
                      Email: <input type="text" name="email" id = "email" size="35" />
                      <br><br>

                      <input type="button"
                             value="Change Password"
                             onclick="checkEmail(this.form);" />
                  </form>
                </div>
                <?php include 'includes/footer.php'; ?>
              </div>
              
            </body>
          </html>
          <?php

  }
 ?>
