<?php
include_once 'includes/register.inc3.php';
include_once 'includes/functions2.php';
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <link rel="shortcut icon" href="images/NewStarSchoolLogoIcon.ico" type="image/x-icon">
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        
        <link href="styles/ssmcCSS.css" rel="stylesheet" type="text/css" />
        <link href="styles/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<?php include_once 'includes/HeadScrips.php';?>

    </head>
<body class="no_col_2">
<div id="site">
       
        <?php require 'includes/pagetop.php'; ?>
        <h1>Register with us</h1>
         <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <div id="error">
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
        </div>
        <div id="regContent">
        <div id="regInstruction">
        
        <ul>
            <li>Usernames must contain only letters, numbers and underscores (no spaces), and be between 3 and 16 characters long.</li>
            <li>Emails must have a valid email format</li>
            
            <li>Passwords must be at least 6 characters and maximum of 20.</li>
            <li>Passwords must also contain:
                <ul>
                    <li>At least one one digit from 0-9</li>
                    <li>At least one lowercase character</li>
                    <li>At least two one uppercase character</li>
                    <li>At least one special symbol: @,#,$,%</li>
                    
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        
                     
        </div>
        <div id="regBox">
        
        <form id="myform" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
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
           
            
                
            Username: <input type='text' 
                name='username' 
                id='username' 
                size="35"
                <?php if (isset($_POST['username'])) echo 'value="'.$_POST['username'].'"';?>
                /><br>
                
            Email: <input type="email" name="email" id="email" size="35" <?php if (isset($_POST['email'])) echo 'value="'.$_POST['email'].'"';?>/><br><br>
            
            Credit Card Number: <input type="number" name="ccard" id="ccard" size="15" <?php if (isset($_POST['ccard'])) echo 'value="'.$_POST['ccard'].'"';?>/><br><br>
            
            Expiration Date: 
            <select name="ccexpmonth" id="ccexpmonth" >
           			<option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
					</select>/
                    <select name="ccexpyear" id="ccexpyear" >
           			<option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
					</select><br><br>
            
            Password: <input type="password"
                             name="password" 
                             id="password" size="35"/><br>
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" size="35"/><br><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                   				   this.form.fname,
                                   this.form.lname,
                                   
                                   this.form.addr1,
                                   this.form.addr2,
                                   this.form.hcity,
                                   this.form.hstate,
                                   this.form.hcountry,
                                   this.form.hcode,
                                   
                                   
                                   
                                   this.form.username,
                                   this.form.email,
                                   
                                   this.form.ccard,
                                   this.form.ccexpmonth,
                                   this.form.ccexpyear,
                                   
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        
     
        <script>
		
      		
  		<?php
		if (!empty($warning_msg)) { ?>	
			scrollAndShake();
        <?php } ?>
		
		
		$(document).ready(function(){
		
		
		$( "#myform" ).validate({
			errorClass: "my-error-class",
  			rules: {
			fname: {required: true, lettersonly: true},
			lname: {required: true, lettersonly: true},
			
			addr1: {required: true},
			addr2: {required: false},
			hcity: {required: true, lettersonly: true},
			hcode: {required: true, maxlength: 8, minlength: 3},
			ccard: {required: true, number: true, maxlength: 10, minlength: 10},
   			email: {required: true, email: true },
			username: {required: true},
			password: {required: true},
			confirmpwd: {required: true, equalTo: "#password"}
                   },
				   
			messages: {
			fname: {required: "Missing First Name", lettersonly: "Name can only contain letters"},
			lname: {required: "Missing Last Name", lettersonly: "Name can only contain letters"},
			
			addr1: {required: "Missing Address Line 1"},
			
			hcity: {required: "Missing City / Suburb Name", lettersonly: "May only contain letters"},
			hcode: {required: "Missing Postcode", maxlength: "Must under 9 characters", minlength: "Must be at least 3 characters"},
			ccard: {required: "Missing credit card number", number: "May only contain numbers", maxlength: "Must be 10 digits in length", minlength: "Must be 10 digits in length"},
   			email: {required: "Missing Email", email: "Incorrect email format" },
			username: {required: "Missing Username"},
			password: {required: "Missing Password"},
			confirmpwd: {equalTo: "Passwords Don't Match"}
                   },   
				   
			});
	});
	
		
	
		</script>
        </div>
        
        </div>
        <p>Return to the <a href="index.php">login page</a>.</p>
        <?php include 'includes/footer.php'; ?>
        </div>
    </body>
</html>