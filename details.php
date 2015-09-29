<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($conn) == true) {

	
$details = $conn; //$connection
$details = oci_parse($details,"select * from PRODUCTS where product_id = :id");

oci_bind_by_name($details, ":id", $_GET['product_id']);

oci_execute($details);





?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require 'includes/HeadScrips.php'; ?>
<?php require 'includes/detailsScripts.php'; ?>
<meta charset="utf-8">
<title>Product Details - New Star Public School</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="site">
<?php require 'includes/pagetop.php'; ?>
    <div id="content">
        <div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="allProducts.php">All Products</a></li>
            </ul>
        </div>
        <div id="col_1" role="main">
        
        <?php
         while (oci_fetch($details)) {
								?>
								
					

        
        
            <h1 class="inline_block"><?php echo oci_result($details, 'PRODUCT_TITLE'); ?></h1>          
            <p class="figure"><img src="<?php echo $siteroot; ?>images/productImages/<?php echo oci_result($details, 'PRODUCT_IMAGE'); ?>.jpg" alt="<?php echo oci_result($details, 'PRODUCT_ALT'); ?>>" width="200" height="200">$<?php echo oci_result($details, 'PRODUCT_PRICE'); ?> each</p>
            <p><?php echo oci_result($details, 'PRODUCT_DESC'); ?></p>
            
                                        <?php
}
					?>

        </div>
      <div id="col_2">
        <!--<a href="add_to_cart.php?id=<?php //echo $row['product_id']; ?>&name=<?php // echo $row['product_title']; ?>" class="cartButon"></a>-->
        <div class="cartButon">
        </div>
        <div id="cartSelect">
        <p>Select your day(s) to order this item.</p>
            <p>Day(s): 
            <br>
            <div id="calendar"></div> 
    	</div>
        
        
        <table id="calendarSelect" style="width:100%">
  		<tr>
    		<td>Jill</td>
    		<td>Smith</td> 
    		<td>50</td>
  		</tr>
 		<tr>
   			<td>Eve</td>
    		<td>Jackson</td> 
    		<td>94</td>
 		</tr>
			</table>
        
        
    <button class="next" id="next">Next</button>
    <button class="can">Cancel</button>
         </div>
   
    </div>
<?php include 'includes/footer.php'; ?>
</div>
</form>
</body>
</html>
<?php 
} else { 
        echo 'You are not authorized to access this page, please <a href="index.php">login</a>.';
}
?>