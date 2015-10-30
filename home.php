<?php
include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';
sec_session_start();
//print_r($_SESSION);
$db = db_connect();
if(login_check($db) == true) {
        // Add your protected page content here!

		?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your Company Here - Home</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">
 <!-- Insert to your webpage before the </head> -->
  
    <!-- End of head section HTML codes -->
</head>

<body class="no_col_2">
<div id="site">
<?php require 'includes/pagetop.php'; ?>

<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
//$siteroot = '/hanselandpetal';
//date_default_timezone_set('Australia/Sydney');
?>
    <div id="content">
        <div id="col_1" role="main">
			<h1>Home</h1>
            <div class="section">
                <div class="title clearfix">
                    <h2>Section 1</h2>
                    <p class="h3"><a href="#" class="feature">Browse All ></a></p>
                </div>
                <ul class="reset tiles x3">
                    <li> Item 1 </li>
                   <li> Item 2 </li>
                   <li> Item 3 </li>
                </ul>
            </div>
            <div class="section">
                <div class="title clearfix">
                    <h2>Section 2</h2>
                    <p class="h3"><a href="#" class="feature">Browse All 2 ></a></p>
                </div>
                <ul class="reset tiles">
                     <li> Item 1 </li>
                   <li> Item 2 </li>
                   <li> Item 3 </li>
                </ul>
            </div>


<?php include 'includes/footer.php'; ?>
<?php //print_r($SpecialAltText);?>
</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php
} else {
        echo 'You are not authorized to access this page, please <a href="index.php">login</a>.';
		echo '<pre>';
		var_dump($_SESSION);
		echo '</pre>';
}
?>
