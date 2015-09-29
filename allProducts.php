<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($conn) == true) {
//ini_set('display_errors', '0');
$message = '';
$db = new MySQLi('localhost', 'user1', '', 'NewStarPS2');
if ($db->connect_error) {
	$message = $db->connect_error;	
} else {
	$sql = 'SELECT * FROM PRODUCTS';
	$result = $db->query($sql);
	if ($db->error) {
		$message = $db->error;	
	}
}
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$name = isset($_GET['name']) ? $_GET['name'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Mixed products - New Star Public School</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">
</head>

<body class="no_col_2">
<div id="site">
<?php require 'includes/pagetop.php'; 

?>
    <div id="content">
    <?php
	
if($action=='added'){
    //echo "<div class='alert alert-info'>";
        //echo "<strong>{$name}</strong> was added to your cart";
		echo "<strong>{$name}</strong> was added to your <a href= /comp344_ass1/cart.php>cart!</a>";
		  
    //echo "</div>";
}
 
if($action=='exists'){
    //echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> already exists in your cart!";
    //echo "</div>";
}

	?>
        <div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li>All Products</li>
            </ul>
        </div>
        <div id="col_1" role="main">
            <h1 class="inline_block">All Products</h1>
            <h2 class="h3 inline_block">Everything you need from Top to Toe</h2>
            <div class="cols lg_margin">
                <div class="col sub">
                    <p class="w210">New Star Public School combines the highest quality 
                        brands to make your look stand out from top to toe.</p>
                    <p>&nbsp;</p>
              </div>
                <div class="col main">
                    <div id="feature">
                      <div class="inner">
                           
                        <p class="overlay price">Starting at $12.00</p>
                          <img src="images/topToToe.jpg" alt="Mixed Arrangement" height="273" width="304"> </div>
                    </div>
                </div>
            </div>
            <?php if ($message) { 
			echo ($messgae) ?>
				<h2 class="inline_block">Sorry, there seems to be a problem.</h2>
            <?php    
			} else { ?>
            <div class="page open">
            <?php 
			$i = 0;
			while ($row = $result->fetch_assoc()) { 
				if ($i % 4 === 0) { ?>
				<div class="section">
                    <ul class="reset tiles">
                    <?php } ?>
                        <li> <a href="details.php?product_id=<?php echo $row['product_id']; ?>
                        <?php /*?>&product_title=<?php echo $row['product_title']; ?><?php */?>
                        "> 
                        <img src="<?php echo $siteroot; ?>images/productImages/<?php echo $row['product_image']; ?>.jpg" alt="<?php echo $row['product_alt']; ?>" height="200" width="200">
                            <h3 class="h4"><?php echo $row['product_title']; ?></h3>
                            <p class="reset">From $<?php echo $row['product_price']; ?></p>
                            </a> </li>
                        <?php $i ++;
						if ($i % 4 === 0) { ?>
                    </ul>
                </div>    
                <?php } // end if
				} // end of loop ?>
        </div>
        <?php } // end of page ?>
    </div>
<?php include 'includes/footer.php'; ?>
</div>
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/scripts.js"></script>
</body>
</html>
<?php 
} else { 
        echo 'You are not authorized to access this page, please <a href="index.php">login</a>.';
}
?>