<?php
include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';
sec_session_start();
$db = db_connect();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if(login_check($db) == true) {
        // Add your protected page content here!
		?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Address Book</title>

	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
 <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
	
<body class="no_col_2">
<div id="site">
<?php require 'includes/pagetop.php'; ?>

<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
//$siteroot = '/hanselandpetal';
//date_default_timezone_set('Australia/Sydney');
//print_r($_SESSION);
?>
<div class="container">
		<div class="card-panel">
    <div id="content">
        <div id="col_1" role="main">
            <h1>Your Account</h1>
			
           <?php
        if (login_check($db) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
						echo '<p>Your name is: ' . htmlentities($_SESSION['fname']) . ' ' . htmlentities($_SESSION['lname']) . '.</p>';
					
						echo '<p>Your Address is: ' . htmlentities($_SESSION['hname']) . ', ' . htmlentities($_SESSION['hcity']) . ', ' . htmlentities($_SESSION['hstate']) . '. ' . htmlentities($_SESSION['hcode']) . '</p>';
 //' . htmlentities($_SESSION['hnumber']) . '
            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
			echo '<p>Do you want to change your password? <a href="pchange.php">Change password</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
                }
?>
			
            </div>

	</div>
		</div>
<?php include 'includes/footer.php'; ?>
<?php //print_r($SpecialAltText);?>
</div>
</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php
} else {
        echo 'You are not authorized to access this page, please login.';
}
?>
