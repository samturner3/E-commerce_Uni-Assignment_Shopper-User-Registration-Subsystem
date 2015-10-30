<?php
  include_once 'includes/db_connect_PDO.php';
  include_once 'includes/functions2.php';
  sec_session_start();
  print_r($_SESSION);
  $db = db_connect();
  if(login_check($db) == true) {
    $_SESSION['pchange'] = "change";
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Change Password</title>
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
			  <h3>Change Password</h3>
              <div id="logonBox">
                <form action="includes/change_password.php" method="post" name="password_form">
				  <div class="row">
					  <div class="input-field col s12">
						 <input type="password" name="oPass" id = "oPass" size="35" class="validate"/>
						<label for="oPass">Old Password</label>
				  </div>
				
				  
					  <div class="input-field col s12">
						 <input type="password" name="nPass" id="nPass" size="35" class="validate"/>
						<label for="nPass">New Password</label>
				  </div>
				  <div class="input-field col s12">
						 <input type="password" name = "conf" id="conf" size="35" class="validate"/>
						<label for="conf">Confirm Password</label>
						
				  </div>
				  <input type="hidden" name="pType" value="change"/>
				  </div>
				</div>
                   
          
                </form>
				
				<button class="btn waves-effect waves-light" type="button" name="Change Password"  value="Change Password" onclick="checkPass(this.form);">Change Password
					<i class="material-icons right">send</i>
				</button>
 		<br>
              </div>
              <?php include 'includes/footer.php'; ?>
            </div>
		  </div>
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
