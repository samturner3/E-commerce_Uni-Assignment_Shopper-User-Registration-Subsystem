<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
$siteroot = '/comp344Ass2_PDO';
//date_default_timezone_set('Australia/Sydney');
include_once 'db_connect_PDO.php';
include_once 'functions2.php';

$db = db_connect();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<div id="header" role="banner">
<p>COMP344 Assignment 1, 2015. Sam Turner. 43156711</p>
        <h1 id="logo"><a href="<?php echo $siteroot; ?>/index.php"><img src="<?php echo $siteroot; ?>/images/New_StarLogo190px.jpg" alt="New Star Public School" width="220"></a></h1>

      <div class="inner" style="height:auto">
        <ul id="quick_links" class="reset menu">
        <?php
				if (login_check($db) == true) {
					?>
                <li>Hello <?php echo htmlentities($_SESSION['fname'])?> </li>
      			<li><a href="<?php echo $siteroot; ?>/user_account.php">My Account</a></li>
                <li><a href="<?php echo $siteroot; ?>/AddressBook.php">My Address Book</a></li>
                <li><a href="#">View My Cart</a></li>
				<li><a href="<?php echo $siteroot; ?>/includes/logout.php">Log Out</a></li>
        <li><a href="<?php echo $siteroot; ?>/pChange.php">Change Password</a></li>

					<?php } else {
						?><li><a href="<?php echo $siteroot; ?>/index.php">Log In</a></li>
                        <li><a href='<?php echo $siteroot; ?>/register.php'>Register</a></li>
                        <li><a href='<?php echo $siteroot; ?>/forgot_password.php'>Forgot Password?</a></li>
                        <?php
					}
				?>
                </li>
            </ul>
        <div id="banner">
        <span class="inner"><img src="<?php echo $siteroot; ?>/images/childrenBanner.jpg" width="632" height="240" alt="childrenBanner" /></span>
        </div>

        <div id="nav_main" role="navigation" class="reset menu pull_out">
        <?php if (login_check($db) == true) {
					?>
        <ul>
            <li><a href="<?php echo $siteroot; ?>/home.php"><span>Home</span></a></li>
            <li><a href="#"><span>Nav1</span></a></li>
            <li><a href="#"><span>Nav2</span></a></li>
            <li> <a href="#" class="parent"><span>Nav3</span></a>
                <div class="single_column">
                    <ul>
                        <li><a href="#">Nav3.1</a></li>
                        <li><a href="#">Nav3.2</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <?php } ?>
    </div>

    </div>
    </div>
