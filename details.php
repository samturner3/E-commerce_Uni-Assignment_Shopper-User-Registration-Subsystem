<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions2.php';
sec_session_start();
if(login_check($mysqli) == true) {
$message = '';
$db = new MySQLi('localhost', 'user1', '', 'NewStarPS1');
if ($db->connect_error){
	$message = $db->connect_error;	
} else {
	$sql = 'SELECT * FROM products WHERE product_id=' . $db->real_escape_string($_GET['product_id']);
	$result = $db->query($sql);
	
	$message = $db->error;

	if ($db->error) { 
		$message = $db->error;	
	} else if(mysqli_num_rows($result) < 1){
		$message = "No Rows Found";	
		printf("Result trig 0.");
	}
	else {
		$row = $result->fetch_assoc();	
	}
}
if(!isset($_SESSION["orderid"])){
	$_SESSION["orderid"]=rand(1,9999);
}
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
                <?php if ($message) { ?>
        		<li> No item found</li>
        		<?php 
				} else { ?>
                <li><?php echo $row['product_title']; ?></li>
                <?php } ?>
            </ul>
        </div>
        <div id="col_1" role="main">
        <?php if ($message) { ?>
        <h1 class="inline_block"> Oops! There seems to be a problem.</h1>
        <p>That product dosen't seem to exist. Return to <a href="allProducts.php">All Products.</a> </p>
        <?php 
		} else { ?> 
            <h1 class="inline_block"><?php echo $row['product_title']; ?></h1>          
            <p class="figure"><img src="<?php echo $siteroot; ?>/images/productImages/<?php echo $row['product_image']; ?>.jpg" alt="<?php echo $row['product_alt']; ?>" width="200" height="200">$<?php echo $row['product_price']; ?> each</p>
            <p><?php echo $row['product_desc']; ?></p>

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
        <?php } ?>
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