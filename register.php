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
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        
<head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
		<?php include_once 'includes/HeadScrips.php';?>

    </head>
<body>
<div class="container">
        <!-- Page Content goes here -->
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



<div class="card-panel"
	<div class="row">
        <form id="myform" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form"
             	>
				
		<form class="col s12">
		<h3>Personal Information</h3>
			<div class="row">
				<div class="input-field col s6">

		  		<input type="text" name="fname" id="fname" size="35" class="validate" <?php if (isset($_POST['fname'])) echo 'value="'.$_POST['fname'].'"';?>/>
				<label for="fname">First Name</label>
				
				</div>
				
				<div class="input-field col s6">
					<input type="text" name="lname" id="lname" size="35" class="validate" <?php if (isset($_POST['lname'])) echo 'value="'.$_POST['lname'].'"';?>/><br><br>
					<label for"lname">Last Name</label>
				</div>
			</div>    
           <h3> Address </h3>
		   
			<div class="row">
				<div class="input-field col s12">
				<input type="text" name="hname" id="hname" size="35" class="validate" <?php if (isset($_POST['hname'])) echo 'value="'.$_POST['hname'].'"';?>/><br>
				<label for="hname">Street Number with Street Address</label>
				</div>
			</div>
			
		   <div class="row">
				<div class="input-field col s12">
					<input type="text" name="hcity" id="hcity" size="35" class="validate"<?php if (isset($_POST['hcity'])) echo 'value="'.$_POST['hcity'].'"';?>/><br>
					<label for=hcity>Surburb/City</label>
				</div>
		   </div>
           
		   <div class="row">
				<div class="input-field col s6">
					<label>State</label>
					<br>
					<select name="hstate" id="hstate" class="browser-default" <?php if (isset($_POST['hstate'])) echo 'value="'.$_POST['hstate'].'"';?>>
						<option value="" disabled selected>Choose your option</option>
						<option value="NSW">NSW</option>
						<option value="ACT">ACT</option>
						<option value="QLD">QLD</option>
						<option value="VIC">VIC</option>
						<option value="SA">SA</option>
						<option value="WA">WA</option>
						<option value="NT">NT</option>
					</select>
				</div>
				<div class="input-field col s6">
					
	
				</div>
		   </div>
		    <div class="input-field col s12">
   
                    Postcode: <input type="text" name="hcode" id="hcode" size="4" <?php if (isset($_POST['hcode'])) echo 'value="'.$_POST['hcode'].'"';?>/><br><br>
           
                           
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
			</div>
		</div>
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
		</div>    
     
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
        
        </div>
        <p>Return to the <a href="index.php">login page</a>.</p>
        <?php include 'includes/footer.php'; ?>
        </div>
</div>	
</div>
    </body>

</html>