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
<html>
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="/Favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/Favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/Favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/Favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/Favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/Favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/Favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/Favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/Favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/Favicons/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/Favicons/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/Favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/Favicons/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/Favicons/manifest.json">
		<link rel="mask-icon" href="/Favicons/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
		
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

<!-- Dropdown Structure -->
<?php
				if (login_check($db) == true) {
					?>
<ul id="dropdown1" class="dropdown-content">
  <li><a href="<?php echo $siteroot; ?>/user_account.php">My account</a></li>
  <li><a href="<?php echo $siteroot; ?>/pChange.php">Change Password</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo $siteroot; ?>/includes/logout.php">Logout</a></li>
</ul>
<nav>
  <div class="nav-wrapper">
    <a href="<?php echo $siteroot; ?>/index.php" class="brand-logo"> Logo Text</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="<?php echo $siteroot; ?>/AddressBook.php">Address Book</a></li>
      <li><a href="#">View cart</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Account Settings<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav>
 <?php } else {
						?>
						
<ul id="dropdown1" class="dropdown-content">
  <li><a href="<?php echo $siteroot; ?>/user_account.php">My account</a></li>
  <li><a href="<?php echo $siteroot; ?>/forgot_password.php">Forgot Password</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo $siteroot; ?>/index.php">Log In</a></li>
</ul>
<nav>
  <div class="nav-wrapper">
    <a href="<?php echo $siteroot; ?>/index.php" class="brand-logo"> Logo Text</a>
    <ul class="right hide-on-med-and-down">
    
      <li><a href="#">View cart</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Account Settings<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
  </div>
</nav>
                        <?php
					}
				?>       
