<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
$siteroot = '/comp344_ass1';
//date_default_timezone_set('Australia/Sydney');
include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';

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
                <li>Hello <?php echo htmlentities($_SESSION['fname'])?> of <?php echo htmlentities($_SESSION['sClass'])?>   </li>
      			<li><a href="<?php echo $siteroot; ?>/user_account.php">My Account</a></li>
                <li><a href="<?php echo $siteroot; ?>/cart.php">View My Cart</a></li>
				<li><a href="<?php echo $siteroot; ?>/includes/logout.php">Log Out</a></li>
					<?php } else {
						?><li><a href="/comp344_ass1/index.php">Log In</a></li>
                        <li><a href='<?php echo $siteroot; ?>/register.php'>Register</a></li>

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
            <li><a href="<?php echo $siteroot; ?>/food_only.php"><span>Food</span></a></li>
            <li><a href="<?php echo $siteroot; ?>/uniform_only.php"><span>Uniforms</span></a></li>
            <li> <a href="#" class="parent"><span>About Us</span></a>
                <div class="single_column">
                    <ul>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <?php } ?>
    </div>

    </div>
    </div>
