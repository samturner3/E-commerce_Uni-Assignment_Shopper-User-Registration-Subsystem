<?php
include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';

$db = db_connect();

sec_session_start();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
//print_r($stmt);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   
      

        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
		
    </head>
	
	 <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
	 
<body class="no_col_2">
 <div class="container">
		<div class="card-panel">
        <!-- Page Content goes here -->
	<div id="site">

    <?php

	echo '<pre>';
	var_dump($_SESSION);
	echo '</pre>';

	require 'includes/pagetop.php'; ?>

    <h3>Login</h3>
    <?php
    //Success Message
		if(isset($_COOKIE['success'])) {
			echo "<div class=\"isa_success\">";
			echo "<i class=\"fa fa-check\"></i>";
			echo 'User was created. You may now login below.';
			echo "</div>";
			setcookie("success", "", time() - 3600);
		};
		/*if (!empty($success_msg)) {
			echo "<div class=\"isa_success\">";
				echo "<i class=\"fa fa-check\"></i>";
				echo $success_msg;
				//print $error;
			echo "</div>";
		}*/


		?>
    <div id="content">
    <div id="logonBox">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
		if (login_check($db) == false) {
        ?>
		
        <form action="includes/process_login.php" method="post" name="login_form">
		<div class="row">
			 <div class="input-field col s12">
				<input id="email" name ="email" type="email" class="validate">
				<label for="email">Email</label>
			</div>
		</div>
		<div class="row">
			 <div class="input-field col s12">
				<input id="password" name ="password" type="password" class="validate"  size="35">
				<label for="password">Password</label>
			</div>
		</div>

			<button class="btn waves-effect waves-light" type="button" name="login"  value="Login" onclick="formhash(this.form, this.form.password);">Submit
			<i class="material-icons right">send</i>
			</button>
 		<br>
<?php }
        if (login_check($db) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';

            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
						echo '<a href=\''.$siteroot.'/forgot_password.php\'>Forgot Password?</a>';
                }
?>
</div>
</div>
</div>
<?php include 'includes/footer.php'; ?>

</div>

</div>
</div>
</body>
</html>
