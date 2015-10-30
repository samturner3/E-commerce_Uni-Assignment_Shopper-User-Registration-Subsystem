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
<html>
    <head>
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
<body>
<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer</h5>
                <p class="grey-text text-lighten-4">Footer information goes here, maybe if you want more information etc.</p>
              </div>
			  <?php if (login_check($db) == true) {
					?>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul class="reset menu hover">
					 <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/AddressBook.php">My Address Book</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/user_account.php">My Account</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/pChange.php">Change Password</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/includes/logout.php">Log Off</a></li>
				
				</ul>
				</div>
			 <?php }
			   else {
				   ?>	
			<div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul class="reset menu hover">
					<li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/index.php">Log In</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>/register.php">Register</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>#"></a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo $siteroot; ?>#"></a></li>
				
				</ul>
				
              </div>

          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            </div>
          </div>
		</div>
	</div>
</footer>
</body>
</html>