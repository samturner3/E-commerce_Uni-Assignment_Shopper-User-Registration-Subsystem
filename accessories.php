<?php
//ini_set('display_errors', '0');
$message = '';
$db = new MySQLi('localhost', 'discobuz_phpwebd', 'radiophone', 'discobuz_sunshinemensclothing');
if ($db->connect_error) {
	$message = $db->connect_error;	
} else {
	$sql = 'SELECT * FROM PRODUCTS WHERE product_type = "accessory"';
	$result = $db->query($sql);
	if ($db->error) {
		$message = $db->error;	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Accessories - New Star Public School</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">
</head>

<body class="no_col_2">
<div id="site">
<?php require 'includes/pagetop.php'; ?>
    <div id="content">
        <div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li>Accessories</li>
            </ul>
        </div>
        <div id="col_1" role="main">
            <h1 class="inline_block">Accessories</h1>
            <h2 class="h3 inline_block">Don't forget that extra something to make you stand out</h2>
            <div class="cols lg_margin">
                <div class="col sub">
                    <p class="w210">New Star Public School combines the highest quality 
                        <span class="inline_block">accessories</span> with unique  and top brands that are sure to 
                        make everyone happy.</p>
                    <p>&nbsp;</p>
              </div>
                <div class="col main">
                    <div id="feature">
                      <div class="inner">
                            <p class="overlay large">Something Extra  for Every Look</p>
                        <p class="overlay price">Starting at $24.00</p>
                          <img src="images/Accessories.jpg" alt="Mixed Arrangement" height="400" width="600"> </div>
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
                        <li> <a href="details.php?product_id=<?php echo $row['product_id']; ?>"> <img src="..images/productImages/<?php echo $row['product_image']; ?>.jpg" alt="<?php echo $row['product_alt']; ?>" height="200" width="200">
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