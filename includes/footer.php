<?php
include_once 'db_connect_PDO.php';

$db = db_connect();
$startYear = 2015;
$thisYear = date('Y');
if ($thisYear > $startYear) {
	$copyright = "$startYear&ndash;$thisYear";
} else {
	$copyright = $startYear;
}
?>
    <div id="footer">
    <div class="row clearfix">
    <?php if (login_check($db) == true) {
					?>
            <ul class="reset menu hover">
                <li><a href="#">Nav1</a></li>
                <li><a href="#">Nav2</a></li>
                <li><a href="#">Nav3</a></li>
                <li><a href="#">Nav4</a></li>
                <li><a href="#">Nav5</a></li>

            </ul>
            <ul class="reset menu hover">
                <li><a href="<?php echo $siteroot; ?>/AddressBook.php">My Address Book</a></li>
                <li><a href="<?php echo $siteroot; ?>/user_account.php">My Account</a></li>
                <li><a href="<?php echo $siteroot; ?>/pChange.php">Change Password</a></li>
                <li><a href="<?php echo $siteroot; ?>/includes/logout.php">Log Off</a></li>
            </ul>
               <?php }
			   else {
				   ?>
				<ul class="reset menu hover">
                <li><a href="<?php echo $siteroot; ?>/index.php">Log On</a></li>
                <li><a href='<?php echo $siteroot; ?>/register.php'>Register</a></li>

            </ul>
				   <?php }
				   ?>
          <ul class="reset menu hover">
                <li><a href="#">Nav7</a></li>
                <li><a href="#">Nav8</a></li>
                <li><a href="#">Nav9</a></li>
                <li><a href="#">Nav10</a></li>
          </ul>

          <img src="images/your-logo-here.png" alt="Your Logo" width="214"> </div>
        <p id="copyright" class="reset pull_out padding" role="contentinfo">© <?php echo $copyright ?> Your Company Here</a></p>

<p id="disclaimer"><p>Your Company Here is a fictitious project created by Shopper/User Registration Subsystem group solely for the purpose of a Macquarie University assignment. All products and people associated with Your Company Here are also fictitious. Any resemblance to real institutions, products, or people is purely coincidental. Information provided about the product is also fictitious and should not be construed to be representative of actual products on the market in a similar product category.</p>
    </div>
