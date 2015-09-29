<?php
session_start();
//Gather data
//$orderid=$_SESSION["orderid"];
$orderid='001';

$cName=$_POST["cName"]; 
$cEmail=$_POST["cEmail"]; 

printf($orderid);

//Provide Database connection
$dbhost = 'localhost'; //hostname:port number
$dbuser = 'user1'; //username
$dbpass = ''; //password
$conn = mysql_connect($dbhost, $dbuser, $dbpass); //returns true or false
if(! $conn )////display error message if connection fails
{
  die('Could not connect: ' . mysql_error());
}
//select your database
mysql_select_db('NewStarPS2'); 

$sql = 'DELETE FROM ORDER_PRODUCTS WHERE ORDERID="'.$orderid.'"'; 
$retval = mysql_query( $sql, $conn );
if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}

$sql = 'DELETE FROM ORDERS WHERE ORDERID="'.$orderid.'"'; 
$retval = mysql_query( $sql, $conn );
if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}

// enter order ID and total cost to ORDERS table

if(!empty($_SESSION['cart_items'])){
	$oID=$_SESSION["orderid"];
	$total=$_SESSION["totalPrice"];			
			$sql = 'INSERT INTO ORDERS VALUES ("'.$oID.'","'.$total.'","'.$cName.'","'.$cEmail.'")';
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
	}



//Gather all cart items and input to database ORDER_PRODUCT
if(!empty($_SESSION['cart_items'])){
	foreach (array_keys($_SESSION['cart_items']) as $key => $value){
			//print_r(key($_SESSION);			
			$sql = 'INSERT INTO ORDER_PRODUCTS VALUES ("'.$oID.'","'.$value.'",1,"")';
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die('Could not enter data:1 ' . mysql_error());
			}
	}
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Order Details - New Star Public School</title>
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
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li>Order Details</li>
            </ul>
        </div>
        <div id="col_1" role="main">
            
            <?php
			//Calculate Cost and Print the order
$sql=' SELECT ORDER_PRODUCTS.product_id,product_title,product_price, QUANTITY FROM ORDER_PRODUCTS,PRODUCTS WHERE ORDER_PRODUCTS.product_id=PRODUCTS.product_id AND ORDERID="'.$orderid.'"';
$retval = mysql_query( $sql, $conn );
if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}
echo '<left> <p>Thanks for ordering from us '.$cName.'. Your order has been successfully recieved, below are your order details:</p><br></center>';	
echo '<left> <h3>Order ID:'.$orderid.'</h3><br></center>';
echo '<left> <h3>Name:'.$cName.'</h3><br></center>';
echo '<left> <h3>eMail:'.$cEmail.'</h3><br></center>';
echo '<center> <h3> You have ordered the following </h3></center>';
echo '<table align="center" border="2">
				<tr>
				<td> <h4> Product ID </h4> </td>
				<td> <h4> Product Name</h4> </td>
				<td> <h4> Price </p> </h4>
				</tr>';
$totalcost=0.0;
while($row = mysql_fetch_array($retval, MYSQL_NUM)){
		echo '<tr><td> <p>'.$row[0].'</p></td>';
		echo '<td> <p>'.$row[1].'</p></td>';
		echo '<td> <p>'.$row[2].'</p></td></tr>';	
		$totalcost=$totalcost+$row[2];
}
echo '</table>';
echo '<center> <h3> Total Cost is $'.$totalcost.'</h3><br></center>';
echo '<center> <h3> Thanks for shopping with us!</center>';
			?>
            
           
           
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
</div>
</body>
</html>