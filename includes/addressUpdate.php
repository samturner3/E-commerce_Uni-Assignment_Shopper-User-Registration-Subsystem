<?php
include_once 'db_connect_PDO.php';

include_once 'functions2.php';
sec_session_start();
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

	//exit;
if (isset($_POST['fname'], $_POST['lname'], $_POST['addr1'], $_POST['addr2'], $_POST['hcity'], $_POST['hstate'], $_POST['hcountry'], $_POST['hcode'], $_POST['shaddrID'])) {
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
	$shaddrID = filter_input(INPUT_POST, 'shaddrID', FILTER_SANITIZE_STRING);
	
	
	// Add all elements to array

	$form_values_array['First Name'] = $fname;
	$form_values_array['Last Name'] = $lname;
	$form_values_array['Address Line 1'] = $addr1;
	//$form_values_array['Address Line 2'] = $addr2;
	$form_values_array['Suburb / City'] = $hcity;
	$form_values_array['State'] = $hstate;
	$form_values_array['Counrty'] = $hcountry;
	$form_values_array['Post Code'] = $hcode;
	$form_values_array['shaddrID'] = $shaddrID;
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


    if (empty($error_msg) && empty($error_array) && empty($error_MissingValues_array) ) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        //$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true)); //do not need for PDO

       
$ownEntry = "0";
$shopper_id = ($_SESSION['user_id']);

	
 $SQL = "UPDATE shaddr SET sh_firstname=?, sh_familyname=?, sh_street1=?, sh_street2=?, sh_city=?, sh_state=?, sh_postcode=?, sh_country=?, shopper_id=?
 WHERE shaddr_id=?";
        $stmt = $db->prepare($SQL);
      $stmt->bindParam(1, $fname);
      $stmt->bindParam(2, $lname);
      $stmt->bindParam(3, $addr1);
	  $stmt->bindParam(4, $addr2);
      $stmt->bindParam(5, $hcity);
      $stmt->bindParam(6, $hstate);
      $stmt->bindParam(7, $hcode);
	  $stmt->bindParam(8, $hcountry);
      $stmt->bindParam(9, $shopper_id);
	  $stmt->bindParam(10, $shaddrID);

        $stmt->execute();

		echo 'Success!';
        setcookie(successUpdate);
		header('Location: ../AddressBook.php');
    }
	else {
		$warning_msg = 'There were error messages, so new user was not added.';
		echo 'here2 <br>';
		print_r( $error_msg);
		echo '<br>';
		print_r($error_array);
		echo '<br>';
		print_r($error_MissingValues_array);
		//exit;
	};
	
}
else {
		echo 'not all set <br>';
		print_r($_POST);
		
	};
