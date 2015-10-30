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

 
			  <!--Import Google Icon Font-->
			  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			  <!--Import materialize.css-->
			  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

		    <!--Let browser know website is optimized for mobile-->
		   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

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
		    <body>
			 <!--Import jQuery before materialize.js-->
		    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			 <script type="text/javascript" src="js/materialize.min.js"></script>
		  </body>
  
<body>
  <div class="container">
	<div class="card-panel">
	  <div id="site">
	   <?php require 'includes/pagetop.php'; ?>
	     <div id="logonBox">
		  <h2>Reset Password</h2>
		  
		  <div class="input-field col s12">
			<form action="includes/forgot.php" method="post" name="email_form">
			   <input type="text" name="email" id = "email" size="35" class="validate"/>
			   <label for="email">Email Address</label>
			   
			   <button class="btn waves-effect waves-light" type="submit" name="value" onclick="checkEmail(this.form);">Change Password
				 <i class="material-icons right">send</i>
			  </button>
			   
		 
		
	    <?php include 'includes/footer.php'; ?>
	  </div>
    </div>
  </div>
</body>
          </html>
          <?php

  }
 ?>
