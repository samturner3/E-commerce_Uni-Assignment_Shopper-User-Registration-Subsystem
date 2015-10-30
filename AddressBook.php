<?php
include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';
sec_session_start();
$db = db_connect();

if (login_check($db) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if(login_check($db) == true) {
        // Add your protected page content here!
		
	if(isset($_POST['delete']))
	{
		delete_addressBook(($_POST['IDtoDelete']));
		
	}
		
		?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>New Star Public School - User Account</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">

</head>

<body class="no_col_2">
<div id="site">
<?php require 'includes/pagetop.php'; ?>

<?php
/* $siteroot points to the development folder.
   Reset it to an empty string when deploying the live site. */
//$siteroot = '/hanselandpetal';
//date_default_timezone_set('Australia/Sydney');
//print_r($_SESSION);
?>
    <div id="content">
        <div id="col_1" role="main">
            <h1>Your Address Book</h1>
           <?php
		   //Get Own Info
		   $shopper_id = $_SESSION['user_id'];
        if ($stmt = $db->prepare("SELECT sh_firstname, sh_familyname, sh_street1, sh_street2, sh_city, sh_state, sh_postcode, sh_country, shaddr_id
									from shaddr
									INNER JOIN shopper
									ON shaddr.shopper_id = shopper.shopper_id  
       								WHERE shopper.shopper_id = ? AND own_entry = 1
		")) {
        $stmt->bindParam(1, $shopper_id);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.

        $own = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		   
		   ///Get All Contacts
		   $shopper_id = $_SESSION['user_id'];
        if ($stmt = $db->prepare("SELECT sh_firstname, sh_familyname, sh_street1, sh_street2, sh_city, sh_state, sh_postcode, sh_country, shaddr_id
									from shaddr
									INNER JOIN shopper
									ON shaddr.shopper_id = shopper.shopper_id  
       								WHERE shopper.shopper_id = ? AND own_entry = 0
		")) {
        $stmt->bindParam(1, $shopper_id);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.

        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		
	
		
		?>
        <h2>Your Information</h2>
        
        <?php 
		$ownUpdateLink = ('<td> <a href="updateAddressBook.php?'.$own[0]['shaddr_id'].'"><img src="images/Update.png" alt=""/> </a></td>');
		$contactsId = array();
		//echo $ownUpdateLink;
		
		for ($i = 0; $i < count($contacts); ++$i) {
			array_push($contactsId,$contacts[$i]['shaddr_id']);  
			unset($contacts[$i]['shaddr_id']);
		}
		
		
		unset($own[0]['shaddr_id']);
		
		
		?>
        
        <div class="CSSTableGenerator" >
			<table> 
            <tr>
            <td>
            First Name
            </td>
            <td>
            Family Name
            </td>
            <td>
            Street Address Line 1
            </td>
            <td>
            Street Address Line 2
            </td>
            <td>
            City/Suburb
            </td>
            <td>
            State
            </td>
            <td>
            Postcode
            </td>
            <td>
            Country
            </td>
             <td>
            Update
            
            </td>
			<?php foreach($own as $row) {
		  	echo('<tr>');
		  	foreach($row as $cell) {
				echo('<td>' . $cell . '</td>');
		  	}
			echo $ownUpdateLink ;
		 	echo('</tr>');
			} ?>            
			</table>
			
			<table>
			  <tr>            
	      </table>
			
			<table>
			  <tr>
	      </table>
            
           
            </div>
        
        <h2>Your Contacts</h2>
        <div class="CSSTableGenerator" >
			<table> 
            <tr>
            <td>
            First Name
            </td>
            <td>
            Family Name
            </td>
            <td>
            Street Address Line 1
            </td>
            <td>
            Street Address Line 2
            </td>
            <td>
            City/Suburb
            </td>
            <td>
            State
            </td>
            <td>
            Postcode
            </td>
            <td>
            Country
            </td>
             <td>
            Update
            </td>
             <td>
            Delete
            </td>
			<?php 
			$i = -1;
			foreach($contacts as $row) {
			$i++;
		  	echo('<tr>');
		  	foreach($row as $cell) {
				echo('<td>' . $cell . '</td>');
		  	}
			
			echo('<td> <a href="includes/updateAddressBook.php?'.$contactsId[$i].'"><img src="images/Update.png" alt=""/> </a></td>');
			?>
            <td>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input hidden type="text" name="IDtoDelete" value="<?php echo $contactsId[$i]; ?>">
				<input type="submit" value="delete" name="delete">
			</form>
			</td>
			
			<?php
			//echo('<td> <a href="includes/deleteAddressBook.php?'.$contactsId[$i].'"><img src="images/delete-17.png" alt=""/> </a></td>');
		 	echo('</tr>');

			} ?>            
			</table>
			
			<table>
			  <tr>            
	      </table>
			
			<table>
			  <tr>
	      </table>
            
           
            </div>
		<h2>Add new Contact</h2>
        
        
        <form id="myform" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form"
             	>
                
            First Name: <input type="text" name="fname" id="fname" size="35"><br>
            Family Name: <input type="text" name="lname" id="lname" size="35" ><br><br>
            
            Address: <br>
           
           Address Line 1: <input type="text" name="addr1" id="addr1" size="35" ><br>
           Address Line 2: <input type="text" name="addr2" id="addr2" size="35" ><br>
            Surburb/City: <input type="text" name="city" id="city" size="35" ><br>
            State: <input type="text" name="state" id="state" size="20" ><br>
            Country: <input type="text" name="country" id="country" size="20" ><br>
            Zip/Postcode: <input type="text" name="pcode" id="pcode" size="6" ><br><br>
           
            
           
            Email: <input type="email" name="email" id="email" size="35"><br><br>
            
           
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                   				   this.form.fname,
                                   this.form.lname,
                                   
                                   this.form.hname,
                                   this.form.hcity,
                                   this.form.hstate,
                                   this.form.hcode,
                                   
                                   this.form.sClass,
                                   
                                   this.form.username,
                                   this.form.email,
                                   
                                   this.form.ccard,
                                   this.form.ccexpmonth,
                                   this.form.ccexpyear,
                                   
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        
	<?php	
		
		
		
?>
            </div>


<?php include 'includes/footer.php'; ?>
<?php //print_r($SpecialAltText);?>
</div>
</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<?php
} else {
        echo 'You are not authorized to access this page, please login.';
}
?>
