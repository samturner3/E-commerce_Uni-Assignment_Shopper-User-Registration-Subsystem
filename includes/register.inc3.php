<?php
include_once 'db_connect_PDO.php';
//include_once 'psl-config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$db = db_connect();

$error_msg = "";
$warning_msg = "";
$error_array = array();
$error_MissingValues_array = array();
$form_values_array = array();
echo 'here';
	//exit;
if (isset($_POST['fname'], $_POST['lname'], $_POST['addr1'], $_POST['addr2'], $_POST['hcity'], $_POST['hstate'], $_POST['hcountry'], $_POST['hcode'], $_POST['username'], $_POST['email'], $_POST['ccard'], $_POST['ccexpmonth'], $_POST['ccexpyear'], $_POST['password']  )) {
	echo $_POST['fname'];
	echo 'allset!';
	//exit;
    // Sanitize and validate the data passed in and set them.
	$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	
	$addr1 = filter_input(INPUT_POST, 'addr1', FILTER_SANITIZE_STRING);
	$addr2 = filter_input(INPUT_POST, 'addr2', FILTER_SANITIZE_STRING);
	$hcity = filter_input(INPUT_POST, 'hcity', FILTER_SANITIZE_STRING);
	$hstate = filter_input(INPUT_POST, 'hstate', FILTER_SANITIZE_STRING);
	$hcountry = filter_input(INPUT_POST, 'hcountry', FILTER_SANITIZE_STRING);
	$hcode = filter_input(INPUT_POST, 'hcode', FILTER_SANITIZE_STRING);
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$ccard = filter_input(INPUT_POST, 'ccard', FILTER_SANITIZE_STRING);
	$ccexpmonth = filter_input(INPUT_POST, 'ccexpmonth', FILTER_SANITIZE_STRING);
	$ccexpyear = filter_input(INPUT_POST, 'ccexpyear', FILTER_SANITIZE_STRING);
	$p = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	echo $p;
	// Add all elements to array

	$form_values_array['First Name'] = $fname;
	$form_values_array['Last Name'] = $lname;
	$form_values_array['Address Line 1'] = $addr1;
	$form_values_array['Address Line 2'] = $addr2;
	$form_values_array['Suburb / City'] = $hcity;
	$form_values_array['State'] = $hstate;
	$form_values_array['Counrty'] = $hcountry;
	$form_values_array['Post Code'] = $hcode;
	
	$form_values_array['Username'] = $username;
	$form_values_array['Email'] = $email;
	$form_values_array['Credit Card'] = $ccard;
	$form_values_array['Credit Card Expiry Month'] = $ccexpmonth;
	$form_values_array['Credit Card Expiry Year'] = $ccexpyear;
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

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
       // $error_msg .= 'Invalid password configuration. (ServerSide check error)';
    }




    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //


    $prep_stmt = "SELECT sh_email FROM shopper WHERE sh_email = ? LIMIT 1";
    $stmt = $db->prepare($prep_stmt);

   // check existing email
    if ($stmt) {
        $stmt->bindParam(1, $email);
        $stmt->execute();
        //$stmt->store_result();

        if ($stmt->rowCount() == 1) {
            // A user with this email address already exists
            //$error_msg .= 'A user with this email address already exists. (ServerSide check error)';
			$error_array[] = 'A user with this email address already exists. (ServerSide check error)';
                        $stmt = null;
        }
                $stmt = null;
    } else {
        $error_msg .= 'Database error Line 39';
                $stmt = null;
    }

    // check existing username
    $prep_stmt = "SELECT sh_email FROM shopper WHERE sh_username = ? LIMIT 1";
    $stmt = $db->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bindParam(1, $username);
        $stmt->execute();
        //$stmt->store_result();

                if ($stmt->rowCount() == 1) {
                        // A user with this username already exists
                        $error_msg .= 'A user with this username already exists. (ServerSide check error)';
						$error_array[] = 'A user with this username already exists. (ServerSide check error)';
                        $stmt = null;
                }
                $stmt = null;
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt = null;
        }

    // TODO:
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg) && empty($error_array) && empty($error_MissingValues_array) ) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        //$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true)); //do not need for PDO

        // Create salted password
        $password = password_hash($password, PASSWORD_DEFAULT); //hash('sha512', $password . $random_salt);

        // Insert the new user into the database SHOPPER
        if ($insert_stmt = $db->prepare("INSERT INTO shopper (sh_email, sh_username, sh_password)
  											VALUES(?, ?, ?);"
											)){
            //$insert_stmt->bind_param('ssssssssss', $email, $username, $fname, $lname, $sClass, $email, $hname, $hcity, $hstate, $hcode);
			$insert_stmt->bindParam(1, $email);
      $insert_stmt->bindParam(2, $username);
      $insert_stmt->bindParam(3, $password);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }

			}
			//get shopper_id from newly created table.

			$shopper_id = $db->lastInsertId();
			//the below code also works, as the email field is garunteed to be unique
      /*$stmt = $db->prepare("SELECT shopper_id FROM shopper WHERE shopper.sh_email = ? LIMIT 1");
      $stmt->bindParam(1, $email);
      $stmt->execute();
      $data = $stmt->fetch();*/


$ownEntry = "1";

			 // Insert the new user into the database SHADDR
        if ($insert_stmt = $db->prepare("INSERT INTO shaddr (sh_firstname, sh_familyname, sh_street1, sh_street2, sh_city, sh_state, sh_postcode, sh_country, shopper_id, own_entry)
  											VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"
											)){
            //$insert_stmt->bind_param('ssssssssss', $email, $username, $fname, $lname, $sClass, $email, $hname, $hcity, $hstate, $hcode);
      $insert_stmt->bindParam(1, $fname);
      $insert_stmt->bindParam(2, $lname);
      $insert_stmt->bindParam(3, $addr1);
	  $insert_stmt->bindParam(4, $addr2);
      $insert_stmt->bindParam(5, $hcity);
      $insert_stmt->bindParam(6, $hstate);
      $insert_stmt->bindParam(7, $hcode);
	  $insert_stmt->bindParam(8, $hcountry);
      $insert_stmt->bindParam(9, $shopper_id);
	  $insert_stmt->bindParam(10, $ownEntry);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
			}
					 // Insert the new user into the database PASSWORD
           //password table not needed with new schema
        /*if ($insert_stmt = $mysqli->prepare("INSERT INTO members_password (username, email, password, salt)
  											VALUES(?, ?, ?, ?);"
											)){
            //$insert_stmt->bind_param('ssssssssss', $email, $username, $fname, $lname, $sClass, $email, $hname, $hcity, $hstate, $hcode);
			$insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
			}*/

			// Insert the new user into the database FINANCE
        if ($insert_stmt = $db->prepare("INSERT INTO finance (ccardNum, ccexpMonth, ccexpYear, shopper_id)
  											VALUES(?, ?, ?, ?);"
											)){
            //$insert_stmt->bind_param('ssssssssss', $email, $username, $fname, $lname, $sClass, $email, $hname, $hcity, $hstate, $hcode);
			$insert_stmt->bindParam(1, $ccard);
      $insert_stmt->bindParam(2, $ccexpmonth);
      $insert_stmt->bindParam(3, $ccexpyear);
      $insert_stmt->bindParam(4, $shopper_id);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
			}


		// the message
		$msg = "Hi " + $fname + ",\n You have registered successfully. \nUsername: " + $username + "\n\nYou may now log in.";

		/*//The email includes the student's name, class, username and some information for confirming registration. The sender's email address should be your MQ email address (you are the shop owner).

		$mailheaders = 'From: sam.turner@students.mq.edu.au' . "\r\n" .
			'Reply-To: sam.turner@students.mq.edu.au' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		$mailsubject = 'New Star Public School Online Registration';

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);

		mail($email,$mailsubject,$msg,$mailheaders);
*/
        setcookie(success);
		header('Location: ./index.php');
    }
	else {
		$warning_msg = 'There were error messages, so new user was not added.';
		echo 'here2';
		//exit;
	};
	
}
else {
		echo 'not all set <br>';
		print_r($_POST);
		exit;
	};
