<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($mysqli) == true) {
        // Add your protected page content here!
		
		echo '<pre>';
		var_dump($_SESSION);
		echo '</pre>';
		
		
		?>


<?php 
$Month = strtolower(date('M')); 
$MonthNumber = date('n');
//$fileMonth = 'special_'."$Month";


//ini_set('display_errors', '0');
$message = '';
$db = new MySQLi('localhost', 'user1', '', 'NewStarPS1');
if ($db->connect_error) {
	$message = $db->connect_error;	
} else {
	$sql = 'SELECT * FROM products WHERE product_type = "food" order by RAND() LIMIT 3';
	$result = $db->query($sql);
	$sqla = 'SELECT * FROM products WHERE product_type = "uniform" order by RAND() LIMIT 3';
	$resulta = $db->query($sqla);
	if ($db->error) {
		$message = $db->error;	
	} else {
		$row1 = $result->fetch_assoc();	
		$row2 = $result->fetch_assoc();	
		$row3 = $result->fetch_assoc();	
		$row4 = $resulta->fetch_assoc();
		$row5 = $resulta->fetch_assoc();
		$row6 = $resulta->fetch_assoc();
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>New Star Public School - Home</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">
 <!-- Insert to your webpage before the </head> -->
    <script src="sliderengine/jquery.js"></script>
    <script src="sliderengine/amazingslider.js"></script>
    <link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
    <script src="sliderengine/initslider-1.js"></script>
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
            
            <div class="section">
                <div class="title clearfix">
                    <h2>Our Most Popular Food Items</h2>
                    <p class="h3"><a href="<?php echo $siteroot; ?>/food_only.php" class="feature">Browse All Food Items</a></p>
                </div>
                <ul class="reset tiles x3">
                    <li> <a href="details.php?product_id=<?php echo $row1['product_id']; ?>"> <img src="images/productImages/<?php echo $row1['product_image']; ?>.jpg" alt="<?php echo $row1['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row1['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row1['product_price']; ?></p>
                            </a> </li>
                    <li> <a href="details.php?product_id=<?php echo $row2['product_id']; ?>"> <img src="images/productImages/<?php echo $row2['product_image']; ?>.jpg" alt="<?php echo $row2['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row2['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row2['product_price']; ?></p>
                            </a> </li>
                    <li> <a href="details.php?product_id=<?php echo $row3['product_id']; ?>"> <img src="images/productImages/<?php echo $row3['product_image']; ?>.jpg" alt="<?php echo $row3['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row3['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row3['product_price']; ?></p>
                            </a> </li>
                </ul>
            </div>
            <div class="section">
                <div class="title clearfix">
                    <h2>Uniforms</h2>
                    <p class="h3"><a href="<?php echo $siteroot; ?>/uniform_only.php" class="feature">Browse All Uniforms</a></p>
                </div>
                <ul class="reset tiles">
                    <li> <a href="details.php?product_id=<?php echo $row4['product_id']; ?>"> <img src="images/productImages/<?php echo $row4['product_image']; ?>.jpg" alt="<?php echo $row4['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row4['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row4['product_price']; ?></p>
                            </a> </li>
                    <li> <a href="details.php?product_id=<?php echo $row5['product_id']; ?>"> <img src="images/productImages/<?php echo $row5['product_image']; ?>.jpg" alt="<?php echo $row5['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row5['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row5['product_price']; ?></p>
                            </a> </li>
                    <li> <a href="details.php?product_id=<?php echo $row6['product_id']; ?>"> <img src="images/productImages/<?php echo $row6['product_image']; ?>.jpg" alt="<?php echo $row6['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row6['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row6['product_price']; ?></p>
                            </a> </li>
                    
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