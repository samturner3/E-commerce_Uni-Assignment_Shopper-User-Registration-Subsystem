<?php
include_once 'includes/register.inc3.php';
include_once 'includes/functions2.php';

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
            <li>Passwords must be exactly 8 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lowercase letter (a..z)</li>
                    <li>At least two numbers (0..9)</li>
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
           
           Number and Street Address: <input type="text" name="hname" id="hname" size="35" <?php if (isset($_POST['hname'])) echo 'value="'.$_POST['hname'].'"';?>/><br>
            Surburb/City: <input type="text" name="hcity" id="hcity" size="35" <?php if (isset($_POST['hcity'])) echo 'value="'.$_POST['hcity'].'"';?>/><br>
            State: <select name="hstate" id="hstate" <?php if (isset($_POST['hstate'])) echo 'value="'.$_POST['hstate'].'"';?>>
           			<option value="NSW">NSW</option>
  					<option value="ACT">ACT</option>
  					<option value="QLD">QLD</option>
                    <option value="VIC">VIC</option>
  					<option value="SA">SA</option>
                    <option value="WA">WA</option>
  					<option value="NT">NT</option>
					</select><br>
                    Postcode: <input type="text" name="hcode" id="hcode" size="4" <?php if (isset($_POST['hcode'])) echo 'value="'.$_POST['hcode'].'"';?>/><br><br>
           
            
            Student's Class: <select name="sClass" id="sClass" <?php if (isset($_POST['sClass'])) echo 'value="'.$_POST['sClass'].'"';?>>
  						<option value="KA">KA</option>
  						<option value="KB">KB</option>
  						<option value="KC">KC</option>
  						<option value="KD">KD</option>
                        <option value="1A">1A</option>
  						<option value="1B">1B</option>
  						<option value="1C">1C</option>
  						<option value="1D">1D</option>
                        <option value="2A">2A</option>
  						<option value="2B">2B</option>
  						<option value="2C">2C</option>
  						<option value="2D">2D</option>
                        <option value="3A">3A</option>
  						<option value="3B">3B</option>
  						<option value="3C">3C</option>
  						<option value="3D">3D</option>
                        <option value="4A">4A</option>
  						<option value="4B">4B</option>
  						<option value="4C">4C</option>
  						<option value="4D">4D</option>
                        <option value="5A">5A</option>
  						<option value="5B">5B</option>
  						<option value="5C">5C</option>
  						<option value="5D">5D</option>
                        <option value="6A">6A</option>
  						<option value="6B">6B</option>
  						<option value="6C">6C</option>
  						<option value="6D">6D</option>
					</select>
                
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
			
			hname: {required: true},
			hcity: {required: true, lettersonly: true},
			hcode: {required: true, number: true, maxlength: 4, minlength: 4},
			ccard: {required: true, number: true, maxlength: 10, minlength: 10},
   			email: {required: true, email: true },
			username: {required: true},
			password: {required: true},
			confirmpwd: {required: true, equalTo: "#password"}
                   },
				   
			messages: {
			fname: {required: "Missing First Name", lettersonly: "Name can only contain letters"},
			lname: {required: "Missing Last Name", lettersonly: "Name can only contain letters"},
			hnumber: {required: "Missing House / Unit Number"},
			hname: {required: "Missing Street Name", lettersonly: "May only contain letters"},
			hcity: {required: "Missing City / Suburb Name", lettersonly: "May only contain letters"},
			hcode: {required: "Missing Postcode", number: "May only contain numbers", maxlength: "Must be 4 digits", minlength: "Must be 4 digits"},
			ccard: {required: "Missing credit card number", number: "May only contain numbers", maxlength: "Must be 10 digits in length", minlength: "Must be 10 digits in length"},
   			email: {required: "Missing Email", email: "Incorrect email format" },
			username: {required: "Missing Username"},
			password: {required: "Missing Password"},
			confirmpwd: {equalTo: "Passwords Don't Match"}
                   },   
				   
			});
	});
	
		function scrollAndShake() {
			$("html, body").animate({scrollTop:$('#error').offset().top}, 800 , function() {
        		$( '.isa_error' ).effect( "shake", {times:1}, 500 );
    		} );
		};
	
		</script>
        </div>
        
        </div>
        <p>Return to the <a href="index.php">login page</a>.</p>
        <?php include 'includes/footer.php'; ?>
        </div>
    </body>
</html>