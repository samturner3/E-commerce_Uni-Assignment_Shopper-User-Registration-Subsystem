<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";
$warning_msg = "";
$error_array = array();
$error_MissingValues_array = array();
$form_values_array = array();
 
if (isset($_POST['fname'], $_POST['lname'], $_POST['hname'], $_POST['hcity'], $_POST['hstate'], $_POST['hcode'], $_POST['sClass'], $_POST['username'], $_POST['email'], $_POST['ccard'], $_POST['ccexpmonth'], $_POST['ccexpyear'], $_POST['password']  )) {
	
	
	//echo $_POST['p'];
    // Sanitize and validate the data passed in and set them.
	$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	$hname = filter_input(INPUT_POST, 'hname', FILTER_SANITIZE_STRING);
	$hcity = filter_input(INPUT_POST, 'hcity', FILTER_SANITIZE_STRING);
	$hstate = filter_input(INPUT_POST, 'hstate', FILTER_SANITIZE_STRING);
	$sClass = filter_input(INPUT_POST, 'sClass', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$ccard = filter_input(INPUT_POST, 'ccard', FILTER_SANITIZE_STRING);
	$ccexpmonth = filter_input(INPUT_POST, 'ccexpmonth', FILTER_SANITIZE_STRING);
	$ccexpyear = filter_input(INPUT_POST, 'ccexpyear', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	
	// Add all elements to array
	
	$form_values_array['First Name'] = $fname;
	$form_values_array['Last Name'] = $lname;
	$form_values_array['Address'] = $hname;
	$form_values_array['Suburb / City'] = $hname;
	$form_values_array['State'] = $hstate;
	$form_values_array['Student/s Class'] = $sClass;
	$form_values_array['Username'] = $username;
	$form_values_array['Email'] = $email;
	$form_values_array['Credit Card'] = $ccard;
	$form_values_array['Credit Card Expiry Month'] = $ccexpmonth;
	$form_values_array['Credit Card Expiry Year'] = $ccexpyear;
	$form_values_array['Password'] = $password;
	//
	
	
	//Check all fields exist
	
	if(is_array($form_values_array))   {
	foreach ($form_values_array as $name => $value) {
				if($value == '') {
					$error_MissingValues_array[$name] = ""; 
				}
				//print $error;
			};
	}
	
	// Check email Valadate
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        //$error_msg .= 'The email address you entered is not valid.(ServerSide check error)';
						
		$error_array[] = 'The email address you entered is not valid.
						(ServerSide check error)';			
					  
    }
 
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    /*if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
       // $error_msg .= 'Invalid password configuration. (ServerSide check error)';
    }*/
	
	$hcode = filter_input(INPUT_POST, 'hcode', FILTER_SANITIZE_NUMBER_FLOAT);
	if (!ctype_digit($hcode) Or strlen($hcode)!=4) {
		//If the post code is not digits or is 4 in length.
		//$error_msg .= '<div class="isa_error"><i class="fa fa-times-circle"></i>Post Code must be numbers and 4 digits only.(ServerSide check error)</div>';
	}
	
	 
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

	   // check existing email   
$emailcheck = $conn; //$connection
$emailcheck = oci_parse($emailcheck, "select EMAIL from MEMBERS where EMAIL = :email");
oci_bind_by_name($emailcheck, ":email", $email);
oci_execute($emailcheck);
oci_fetch_all($emailcheck, $res);
        if (oci_num_rows($emailcheck) == 1) {
			echo ('email exists!');
            // A user with this email address already exists
            //$error_msg .= 'A user with this email address already exists. (ServerSide check error)';
			$error_array[] = 'A user with this email address already exists. (ServerSide check error)';
                       //oci_close($conn);
        }
		else {
		echo ('email ok!');	
		//oci_close($conn);
		}
                
   
               
 
 
    // check existing username
	
	
$usernamecheck = $conn; //$connection
$usernamecheck = oci_parse($usernamecheck, "select EMAIL from MEMBERS where USERNAME = :username");
oci_bind_by_name($usernamecheck, ":username", $username);
oci_execute($usernamecheck);
oci_fetch_all($usernamecheck, $res);
 
                if (oci_num_rows($usernamecheck) == 1) {
					echo ('username exists!');
                        // A user with this username already exists
                        $error_msg .= 'A user with this username already exists. (ServerSide check error)';
						$error_array[] = 'A user with this username already exists. (ServerSide check error)';
						//oci_close($conn);
                      
                }
					else {
		echo ('username ok!');	
		//oci_close($conn);
		}
                
      
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 	
    if (empty($error_msg) && empty($error_array) && empty($error_MissingValues_array) ) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        //$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        //$password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database MEMBERS 
		
		$reg = $conn; //$connection
		$reg = oci_parse($reg, 'INSERT INTO MEMBERS (EMAIL, USERNAME, FNAME, LNAME, SCLASS, HNAME, HCITY, HSTATE, HCODE, CCARD, CCEXPMONTH, CCEXPYEAR, PASSWORD) VALUES(:email, :username, :fname, :lname, :sclass, :hname, :hcity, :hstate, :hcode, :ccard, :ccexpmonth, :ccexpyear, :password)');
		
		oci_bind_by_name($reg, ":email", $email);
		oci_bind_by_name($reg, ":username", $username);
		oci_bind_by_name($reg, ":fname", $fname);
		oci_bind_by_name($reg, ":lname", $lname);
		oci_bind_by_name($reg, ":sclass", $sClass);
		oci_bind_by_name($reg, ":hname", $hname);
		oci_bind_by_name($reg, ":hcity", $hcity);
		oci_bind_by_name($reg, ":hstate", $hstate);
		oci_bind_by_name($reg, ":hcode", $hcode);
		oci_bind_by_name($reg, ":ccard", $ccard);
		oci_bind_by_name($reg, ":ccexpmonth", $ccexpmonth);
		oci_bind_by_name($reg, ":ccexpyear", $ccexpyear);
		oci_bind_by_name($reg, ":password", $password);
		
		oci_execute($reg);
		
		
		// the message
		$emsg = "COMP344 Assignment 1, 2015. Sam Turner. 43156711 <br> Hi " + $fname + ",\n You have registered successfully.\n\n Class: " + $sClass + "\nUsername: " + $username + "\n\nYou may now log in.";
		
		//The email includes the student's name, class, username and some information for confirming registration. The sender's email address should be your MQ email address (you are the shop owner).

		$mailheaders = 'From: sam.turner@students.mq.edu.au' . "\r\n" .
			'Reply-To: sam.turner@students.mq.edu.au' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
		$mailsubject = 'COMP344 Assignment 1, 2015. Sam Turner. 43156711 - New Star Public School Online Registration';

		// use wordwrap() if lines are longer than 70 characters
		//$msg = wordwrap($msg,70);
			
		mail($email,$mailsubject,$emsg,$mailheaders);	
        
        setcookie(success);
		echo ('DONE!');
		//oci_close($conn);
		header('Location: ./index.php');
    }
	else {
		$warning_msg = 'There were error messages, so new user was not added.';
		
	};
}