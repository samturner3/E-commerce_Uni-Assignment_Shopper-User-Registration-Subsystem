<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
$warning_msg = "";
$error_array = array();
$error_MissingValues_array = array();
$form_values_array = array();
 
if (isset($_POST['fname'], $_POST['lname'], $_POST['hname'], $_POST['hcity'], $_POST['hstate'], $_POST['hcode'], $_POST['sClass'], $_POST['username'], $_POST['email'], $_POST['ccard'], $_POST['p']  )) {
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
	$p = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	
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
	$form_values_array['Password'] = $p;
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
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
       // $error_msg .= 'Invalid password configuration. (ServerSide check error)';
    }
	
	$hcode = filter_input(INPUT_POST, 'hcode', FILTER_SANITIZE_NUMBER_FLOAT);
	if (!ctype_digit($hcode) Or strlen($hcode)!=4) {
		//If the post code is not digits or is 4 in length.
		//$error_msg .= '<div class="isa_error"><i class="fa fa-times-circle"></i>Post Code must be numbers and 4 digits only.(ServerSide check error)</div>';
	}
	
	 
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

	
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            //$error_msg .= 'A user with this email address already exists. (ServerSide check error)';
			$error_array[] = 'A user with this email address already exists. (ServerSide check error)';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= 'Database error Line 39';
                $stmt->close();
    }
 
    // check existing username
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // A user with this username already exists
                        $error_msg .= 'A user with this username already exists. (ServerSide check error)';
						$error_array[] = 'A user with this username already exists. (ServerSide check error)';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 	
    if (empty($error_msg) && empty($error_array) && empty($error_MissingValues_array) ) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, fname, lname, hname, hcity, hstate, hcode, sClass, email, ccard, password, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssssssss', $username, $fname, $lname, $hname, $hcity, $hstate, $hcode, $sClass, $email, $ccard, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        setcookie(success);
		header('Location: ./index.php');
    }
	else {
		$warning_msg = 'There were error messages, so new user was not added.';
		
	};
}