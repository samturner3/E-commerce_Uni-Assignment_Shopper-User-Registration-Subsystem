<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($conn) == true) {
        // Add your protected page content here!
		//
//		echo '<pre>';
//		var_dump($_SESSION);
//		echo '</pre>';
		
		
		?>


<?php 

//ini_set('display_errors', '0');
/*$message = '';
$db = new MySQLi('localhost', 'user1', '', 'NewStarPS2');
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
*/
$home1 = $conn; //$connection
$home1 = oci_parse($home1, "
select * 
	from 
( select *
	from PRODUCTS 
	where product_type = 'food' 
	ORDER BY DBMS_RANDOM.RANDOM )
where ROWNUM <= 3");

oci_execute($home1);

$home2 = $conn; //$connection
$home2 = oci_parse($home2, "
select * 
	from 
( select *
	from PRODUCTS 
	where product_type = 'uniform' 
	ORDER BY DBMS_RANDOM.RANDOM )
where ROWNUM <= 3");

oci_execute($home2);



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
                    <?php 
							while (oci_fetch($home1)) {
								?>
								
								<li> <a href="details.php?product_id=<?php echo oci_result($home1, 'PRODUCT_ID'); ?>"> <img src="images/productImages/<?php echo oci_result($home1, 'PRODUCT_IMAGE'); ?>.jpg" alt="<?php echo oci_result($home1, 'PRODUCT_ALT'); ?>" height="200" width="200">
                            <h3 class="h4"><?php echo oci_result($home1, 'PRODUCT_TITLE'); ?></h3>
                            <p class="reset">From $<?php echo oci_result($home1, 'PRODUCT_PRICE'); ?></p>
                            </a> </li>
                            <?php
}
					?>
                    </ul>
            </div>
            <div class="section">
                <div class="title clearfix">
                    <h2>Uniforms</h2>
                    <p class="h3"><a href="<?php echo $siteroot; ?>/uniform_only.php" class="feature">Browse All Uniforms</a></p>
                </div>
                <ul class="reset tiles">
                <?php 
							while (oci_fetch($home2)) {
								?>
                    <li> <a href="details.php?product_id=<?php echo oci_result($home2, 'PRODUCT_ID'); ?>"> <img src="images/productImages/<?php echo oci_result($home2, 'PRODUCT_IMAGE'); ?>.jpg" alt="<?php echo oci_result($home2, 'PRODUCT_ALT'); ?>" height="200" width="200">
                            <h3 class="h4"><?php echo oci_result($home2, 'PRODUCT_TITLE'); ?></h3>
                            <p class="reset">From $<?php echo oci_result($home2, 'PRODUCT_PRICE'); ?></p>
                            </a> </li>
                      <?php
}
					?>
                    
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