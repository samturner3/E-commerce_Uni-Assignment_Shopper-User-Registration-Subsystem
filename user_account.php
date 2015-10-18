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
<title>New Star Public School - User Account</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">

</head>

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
    <div id="content">
        <div id="col_1" role="main">
            <h1>Your Account</h1>
           <?php
        if (login_check($db) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
						echo '<p>Your name is: ' . htmlentities($_SESSION['fname']) . ' ' . htmlentities($_SESSION['lname']) . '.</p>';
						echo '<p>You are in class: ' . htmlentities($_SESSION['sClass']) . '.</p>';
						echo '<p>Your Address is: ' . htmlentities($_SESSION['hname']) . ', ' . htmlentities($_SESSION['hcity']) . ', ' . htmlentities($_SESSION['hstate']) . '. ' . htmlentities($_SESSION['hcode']) . '</p>';
 //' . htmlentities($_SESSION['hnumber']) . '
            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
                }
?>
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
