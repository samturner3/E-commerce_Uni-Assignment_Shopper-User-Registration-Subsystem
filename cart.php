<?php
session_start();
$db = new MySQLi('localhost', 'user1', '', 'NewStarPS2');
$page_title="Cart";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Cart - New Star Public School</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">
</head>

<body class="no_col_2">
<div id="site">
<?php
require 'includes/pagetop.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
?>
		<div id="content">
<?php
if($action=='removed'){
    //echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was removed from your cart!";
    //echo "</div>";
}
 
else if($action=='quantity_updated'){
    //echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> quantity was updated!";
    //echo "</div>";
}
 
 ?>
 <div id="breadcrumbs" class="reset menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li>Cart</li>
            </ul>
        </div>
        <div id="col_1" role="main">
            <h1 class="inline_block">Cart</h1>
            <div class="cols lg_margin">
                <div class="col sub">
              </div>
                      <div class="inner">
                          <img src="images/shopping_cart_racing.jpg" alt="Cart" height="100" width="111"> </div>
                    
                
            
 
 <?php
 
if(count($_SESSION['cart_items'])>0){
 
    // get the product ids
    $ids = "";
    foreach($_SESSION['cart_items'] as $id=>$value){
        $ids = $ids . $id . ",";
    }
 
    // remove the last comma
    $ids = rtrim($ids, ',');
 
    //start table
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Product Name</th>";
            echo "<th>Price</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        $sql = "SELECT product_id, product_title, product_price FROM PRODUCTS WHERE product_id IN ({$ids}) ORDER BY product_title";
		//$sql = "SELECT * FROM PRODUCTS";
		//$query = "SELECT * FROM PRODUCTS";
		
		//$sql = 'SELECT * FROM PRODUCTS';
		//$result = $db->query($sql);
		$result=mysqli_query($db,$sql);
 
       // $stmt = $db->prepare( $query );
        //$result->execute();
 
        $total_price=0;
        //while ($row = mysqli_query->fetch(MySQLi_result::fetch_assoc)){
			while ($row=mysqli_fetch_assoc($result)){
            extract($row);
 
            echo "<tr>";
                echo "<td>{$product_title}</td>";
                echo "<td>&#36;{$product_price}</td>";
                echo "<td>";
                    echo "<a href='remove_from_cart.php?id={$product_id}&name={$product_title}' class='btn btn-danger'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Remove from cart";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
            $total_price+=$product_price;
        }
 
        echo "<tr>";
                echo "<td><b>Total</b></td>";
                echo "<td>&#36;{$total_price}</td>";
                echo "<td>";
                    echo "<a href='/comp344_ass1/checkout.php' class='btn btn-success'>";
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
 
    echo "</table>";
}
 
else{
    //echo "<div class='alert alert-danger'>";
        echo "<strong>No products found</strong> in your cart!";
    //echo "</div>";
}
 
include 'includes/footer.php';
print_r($_SESSION);
?>
</div>
</div>
</body>
</html>