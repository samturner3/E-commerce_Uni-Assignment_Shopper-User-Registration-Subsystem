<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
//$siteroot = '/comp344_ass1V2/';
$siteroot = '';
//date_default_timezone_set('Australia/Sydney');
include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
 

 
if (login_check($conn) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<div id="header" role="banner">
<p>COMP344 Assignment 1, 2015. Sam Turner. 43156711</p>
        <h1 id="logo"><a href="<?php echo $siteroot; ?>/index.php"><img src="<?php echo $siteroot; ?>images/New_StarLogo190px.jpg" alt="New Star Public School" width="220"></a></h1>
        
      <div class="inner" style="height:auto">
        <ul id="quick_links" class="reset menu">
        <?php		
				if (login_check($conn) == true) {
					?>
                <li>Hello <?php echo htmlentities($_SESSION['fname'])?> of <?php echo htmlentities($_SESSION['sClass'])?>   </li>
      			<li><a href="/mqauth/43156711/NewStar/user_account.php">My Account</a></li>
                <li><a href=#>View My Cart</a></li>
				<li><a href="/mqauth/43156711/NewStar/includes/logout.php">Log Out</a></li> 
					<?php } else {
						?><li><a href="/mqauth/43156711/NewStar/index.php">Log In</a></li>
                        <li><a href='/mqauth/43156711/NewStar/register.php'>Register</a></li>
                        
                        <?php
					}
				?>
                </li>
            </ul>
        <div id="banner">
        <span class="inner"><img src="<?php echo $siteroot; ?>images/childrenBanner.jpg" width="632" height="240" alt="childrenBanner" /></span>
        </div>        
          
        <div id="nav_main" role="navigation" class="reset menu pull_out">
        <?php if (login_check($conn) == true) {
					?>
        <ul>
            <li><a href="<?php echo $siteroot; ?>home.php"><span>Home</span></a></li>
            <li><a href="<?php echo $siteroot; ?>food_only.php"><span>Food</span></a></li>
            <li><a href="<?php echo $siteroot; ?>uniform_only.php"><span>Uniforms</span></a></li>
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