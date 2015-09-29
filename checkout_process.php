<?php
session_start();
?>
<html>
<body>

Thanks for your order, <?php echo $_POST["cName"]; ?><br>
Your email address is: <?php echo $_POST["cEmail"]; 

//Gather data
$orderid=$_SESSION["orderid"];
?><br>
Your order ID is <?php echo $orderid; ?>
<br><br>
Your order is:
<?php print_r($_SESSION); ?>

<?php

//Provide Database connection
$dbhost = 'localhost'; //hostname:port number
$dbuser = 'discobuz_phpwebd'; //username
$dbpass = 'radiophone'; //password
$conn = mysql_connect($dbhost, $dbuser, $dbpass); //returns true or false
if(! $conn )////display error message if connection fails
{
  die('Could not connect: ' . mysql_error());
}
//select your database
mysql_select_db('discobuz_sunshinemensclothing'); 
echo "<br><br>DB Selected<br><br>";

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
			$sql = 'INSERT INTO ORDERS VALUES ("'.$oID.'","'.$total.'","'.$_POST["cName"].'","'.$_POST["cEmail"].'")';
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
	}

echo "<br> DB op 1 success! <br><br>";

foreach (array_keys($_SESSION['cart_items']) as $key => $value){
	echo ($value);
	echo  "<br>";
}


//Gather all cart items and input to database ORDER_PRODUCT
if(!empty($_SESSION['cart_items'])){
	echo "DB 2 not empty"; 
	foreach (array_keys($_SESSION['cart_items']) as $key => $value){
			//print_r(key($_SESSION);
			echo $value; 			
			$sql = 'INSERT INTO ORDER_PRODUCTS VALUES ("'.$oID.'","'.$value.'",1,"")';
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
	}
}	

echo "<br> DB op 2 success!";

//Calculate Cost and Print the order

//Calculate Cost and Print the order
$sql=' SELECT ORDER_PRODUCTS.product_id,product_title,product_price FROM ORDER_PRODUCTS,PRODUCTS WHERE ORDER_PRODUCTS.product_id=PRODUCTS.product_id AND ORDERID="'.$orderid.'"';
$retval = mysql_query( $sql, $conn );
if(! $retval )
	{
		die('Could not enter data: ' . mysql_error());
	}
echo '<center> <h3> Your Order ID is '.$orderid.'</h3></center>';
echo '<center> <h3> You have ordered the following </h3></center>';
echo '<table border="2">
				<tr>
				<td> <p> product_id </p> </td>
				<td> <p> product_title</p> </td>
				<td> <p> PRICE </p> </td>
				</tr>';
$totalcost=0.0;
while($row = mysql_fetch_array($retval, MYSQL_NUM)){
		echo '<tr><td> <p>'.$row[0].'</p></td>';
		echo '<td> <p>'.$row[1].'</p></td>';
		echo '<td> <p>'.$row[2].'</p></td></tr>';	
		$totalcost=$totalcost+$row[2];
}
echo '</table>';
echo '<center> <h3> Total Cost is '.$totalcost.'</h3></center>';
echo '<center> <h3> Your order should be ready in 20 mins for pick up. Please note your ORDERID and present at the counter</center>';






?>

<!-- post 
	Post array info to database with user name and email
    
    //Gather data
$orderid=$_SESSION["orderid"];
    
    
   

	output order and order id
-->


</body>
</html>