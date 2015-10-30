<?php

include_once 'includes/db_connect_PDO.php';
include_once 'includes/functions2.php';
sec_session_start();
include_once 'includes/addressAddNew.php';



//print_r($_SESSION['user_id']);

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
<title>Your Company Here Public School - User Account</title>
<link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
<link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/addressBookControl.js"></script>
<script src="js/jquery-ui.min.js"></script>

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
    
    
    <?php
    //Success Message
		if(isset($_COOKIE['success'])) {
			
			echo "<div class=\"isa_success\">";
			echo "<i class=\"fa fa-check\"></i>";
			echo 'Contact was added.';
			echo "</div>";
			setcookie("success", "", time() - 3600);
			echo "<script> scrollAndShakeSucc();</script>";
		};
		
		 //Success Message
		if(isset($_COOKIE['successUpdate'])) {
			
			echo "<div class=\"isa_success\">";
			echo "<i class=\"fa fa-check\"></i>";
			echo 'Contact was updated.';
			echo "</div>";
			setcookie("success", "", time() - 3600);
			echo "<script> scrollAndShakeSucc();</script>";
		};
		/*if (!empty($success_msg)) {
			echo "<div class=\"isa_success\">";
				echo "<i class=\"fa fa-check\"></i>";
				echo $success_msg;
				//print $error;
			echo "</div>";
		}*/


		?>
    
    
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
        <h2 style="margin:20px">Your Information</h2>
        
        <?php 
		
		$ownUpdateLink = ("<td><button type=\"button\" class=\"getRow\" onclick=\"UpdateFormShow(".$own[0]['shaddr_id'].")\" >Update</button></td>");
		$contactsId = array();
		//echo $ownUpdateLink;
		
		for ($i = 0; $i < count($contacts); ++$i) {
			array_push($contactsId,$contacts[$i]['shaddr_id']);  
			unset($contacts[$i]['shaddr_id']);
		}
		
		
		unset($own[0]['shaddr_id']);
		
		
		?>
        
        <div class="CSSTableGenerator" style="margin:20px">
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
        
        <h2 style="margin:20px">Your Contacts</h2>
        <div class="CSSTableGenerator" style="margin:20px">
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
			
			echo("<td><button class=\"getRow\" type=\"button\" onclick=\"UpdateFormShow(".$contactsId[$i].")\" >Update</button></td>");
			//echo('<td> update <a href="includes/updateAddressBook.php?'.$contactsId[$i].'"><img src="images/Update.png" alt=""/> </a></td>');
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
            
            <div id="updateFormContain" style="margin:20px">
        <h2 style="margin:20px">Update Contact</h2>
        <div id="error">
</div>
 <?php
		//Value Missing Errors
		if (!empty($error_MissingValues_array)) {
			echo "<div class=\"isa_error\">";
			echo "<i class=\"fa fa-times-circle\"></i>";
			echo " Please ensure you provide all fields. The following values are missing: <br>";
			foreach ($error_MissingValues_array as $name => $error) {
				echo $name . '<br>';
				//print $error;
			};
			echo "</div>";
		}
		
		//Normal Errors
		else if (!empty($error_array)) {
			echo "<div class=\"isa_error\">";
			
			foreach ($error_array as $error) {
				echo "<i class=\"fa fa-times-circle\"></i>";
				echo " Error: ". $error . "<br>";
				//print $error;
			};
			echo "</div>";
		}
		
		//Warning Message
		if (!empty($warning_msg)) {
			echo "<div class=\"isa_warning\">";
				echo "<i class=\"fa fa-warning\"></i>";
				echo $warning_msg ;
				//print $error;
			echo "</div>";
		}
		
		
		?>
        
        <form id="updateForm" action="includes/addressUpdate.php" 
                method="post" 
                name="update_Form"
             	>
                
            First Name: <input type="text" name="fname" id="fname" size="35"/><br>
            Last Name: <input type="text" name="lname" id="lname" size="35" /><br><br>
            
            Address: <br>
           
           Address line 1: <input type="text" name="addr1" id="addr1" size="35" /><br>
           Address line 2: <input type="text" name="addr2" id="addr2" size="35" /><br>
            Surburb/City: <input type="text" name="hcity" id="hcity" size="35" /><br>
            State: <input type="text" name="hstate" id="hstate" size="35" /><br>
            Country: <input type="text" name="hcountry" id="hcountry" size="35" /><br>
                    Postcode: <input type="text" name="hcode" id="hcode" size="35" /><br><br>
                    <input hidden type="text" name="shaddrID" id="shaddrID" size="2" />
           
            
           
            <input type="button" 
                   value="Update" 
                   onclick="return updateformhash(this.form,
                   				   this.form.fname,
                                   this.form.lname,
                                   
                                   this.form.addr1,
                                   this.form.addr2,
                                   this.form.hcity,
                                   this.form.hstate,
                                   this.form.hcountry,
                                   this.form.hcode,
                                   
                                   this.form.shaddrID);" /> 
       
                                   
                                   <input type="button" 
                  					 value="Cancel" 
                   					onclick="cancelUpdateForm();" /> 
        </form>
        </div>
		
        <button type="button" id="showAddFormButton" style="margin:20px"><h2>Add new Contact</h2></button>
        
        
       
        <div id="addNewFormContain" style="margin:20px">
        
        <div id="error">
</div>
 <?php
		//Value Missing Errors
		if (!empty($error_MissingValues_array)) {
			echo "<div class=\"isa_error\">";
			echo "<i class=\"fa fa-times-circle\"></i>";
			echo " Please ensure you provide all fields. The following values are missing: <br>";
			foreach ($error_MissingValues_array as $name => $error) {
				echo $name . '<br>';
				//print $error;
			};
			echo "</div>";
		}
		
		//Normal Errors
		else if (!empty($error_array)) {
			echo "<div class=\"isa_error\">";
			
			foreach ($error_array as $error) {
				echo "<i class=\"fa fa-times-circle\"></i>";
				echo " Error: ". $error . "<br>";
				//print $error;
			};
			echo "</div>";
		}
		
		//Warning Message
		if (!empty($warning_msg)) {
			echo "<div class=\"isa_warning\">";
				echo "<i class=\"fa fa-warning\"></i>";
				echo $warning_msg ;
				//print $error;
			echo "</div>";
		}
		
		
		?>
        
        <form id="addNewForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form"
             	>
                
            First Name: <input type="text" name="fname" id="fname" size="35" <?php if (isset($_POST['fname'])) echo 'value="'.$_POST['fname'].'"';?>/><br>
            Last Name: <input type="text" name="lname" id="lname" size="35" <?php if (isset($_POST['lname'])) echo 'value="'.$_POST['lname'].'"';?>/><br><br>
            
            Address: <br>
           
           Address line 1: <input type="text" name="addr1" id="addr1" size="35" <?php if (isset($_POST['addr1'])) echo 'value="'.$_POST['addr1'].'"';?>/><br>
           Address line 2: <input type="text" name="addr2" id="addr2" size="35" <?php if (isset($_POST['addr2'])) echo 'value="'.$_POST['addr2'].'"';?>/><br>
            Surburb/City: <input type="text" name="hcity" id="hcity" size="35" <?php if (isset($_POST['hcity'])) echo 'value="'.$_POST['hcity'].'"';?>/><br>
            State: <input type="text" name="hstate" id="hstate" size="35" <?php if (isset($_POST['hstate'])) echo 'value="'.$_POST['hstate'].'"';?>/><br>
            Country: <input type="text" name="hcountry" id="hcountry" size="35" <?php if (isset($_POST['hcountry'])) echo 'value="'.$_POST['hcountry'].'"';?>/><br>
                    Postcode: <input type="text" name="hcode" id="hcode" size="35" <?php if (isset($_POST['hcode'])) echo 'value="'.$_POST['hcode'].'"';?>/><br><br>
           
            
           
            <input type="button" 
                   value="Add New" 
                   onclick="return addformhash(this.form,
                   				   this.form.fname,
                                   this.form.lname,
                                   
                                   this.form.addr1,
                                   this.form.addr2,
                                   this.form.hcity,
                                   this.form.hstate,
                                   this.form.hcountry,
                                   this.form.hcode);" /> 
       
                                   
                                   <input type="button" 
                  					 value="Cancel" 
                   					onclick="cancelNewForm()" /> 
        </form>
        </div>
        
        
	<?php	
		
		
		
?>
            </div>


<?php include 'includes/footer.php'; ?>
<?php //print_r($SpecialAltText);?>
</div>
</div>

</body>
</html>
<?php
} else {
        echo 'You are not authorized to access this page, please login.';
}
?>
