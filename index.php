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
        <link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
        <link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css" />
        <link href="styles/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>
    <body class="no_col_2">
<div id="site">

    <?php

	echo '<pre>';
	var_dump($_SESSION);
	echo '</pre>';

	require 'includes/pagetop.php'; ?>
    <h1>Login</h1>
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
            Email: <input type="text" name="email" size="35" />
            <br>
            Password: <input type="password"
                             name="password"
                             id="password"
                             size="35"/> <br> <br>

            <input type="button"
                   value="Login"
                   onclick="formhash(this.form, this.form.password);" />
        </form>
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
<?php include 'includes/footer.php'; ?>

</div>

</div>

    </body>
</html>
