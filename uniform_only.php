<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($conn) == true) {
	
$uniform = $conn; //$connection
$uniform = oci_parse($uniform,"select * from PRODUCTS where product_type = 'uniform' ORDER BY DBMS_RANDOM.RANDOM");

oci_execute($uniform);
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

	?>
        <div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li>All Products</li>
            </ul>
        </div>
        <div id="col_1" role="main">
            <h1 class="inline_block">All Uniform Items</h1>
            <h2 class="h3 inline_block">Order school uniforms online!</h2>
            <div class="cols lg_margin">
                <div class="col sub">
                    <p class="w210"></p>
                
              </div>
                <div class="col main">
                    <div id="feature">
                      <div class="inner">
                           
                        <p class="overlay price">Starting at $20.00</p>
                          <img src="images/School-Uniforms-11.jpg" alt="Mixed Arrangement" height="300" width="300"> </div>
                    </div>
                </div>
            </div>
           
            <?php 
			$i = 0;
				if ($i % 4 === 0) { ?>
				<div class="section">
                    <ul class="reset tiles">
                    <?php } 
                        while (oci_fetch($uniform)) {
								?>
								
								<li> <a href="details.php?product_id=<?php echo oci_result($uniform, 'PRODUCT_ID'); ?>"> <img src="images/productImages/<?php echo oci_result($uniform, 'PRODUCT_IMAGE'); ?>.jpg" alt="<?php echo oci_result($uniform, 'PRODUCT_ALT'); ?>" height="200" width="200">
                            <h3 class="h4"><?php echo oci_result($uniform, 'PRODUCT_TITLE'); ?></h3>
                            <p class="reset">From $<?php echo oci_result($uniform, 'PRODUCT_PRICE'); ?></p>
                            </a> </li>
                            <?php
}
					?>
                        <?php $i ++;
						if ($i % 4 === 0) { ?>
                    </ul>
                </div>    
                <?php } // end if
				 // end of loop ?>
        </div>
       
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