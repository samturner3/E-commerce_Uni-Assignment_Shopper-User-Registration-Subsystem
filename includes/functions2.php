<?php
include_once 'db_connect_PDO.php';
$siteroot = '/comp344Ass2_PDO';

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = false;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id(true);    // regenerated the session, delete the old one.
}


function login($email, $password, $db) {
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $db->prepare("SELECT shopper.shopper_id, shopper.sh_email, shopper.sh_username, shaddr.sh_firstname, shaddr.sh_familyname, shopper.sh_type, shopper.sh_password, shaddr.sh_street1, shaddr.sh_street2, shaddr.sh_city, shaddr.sh_state, shaddr.sh_postcode
									from shopper
									INNER JOIN shaddr
									ON shopper.shopper_id =  shaddr.shopper_id
       								WHERE shopper.sh_email = ?
       								LIMIT 1
		")) {
        $stmt->bindParam(1, $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        //not needed for PDO $stmt->store_result();

        // get variables from result.
        //not needed for PDO $stmt->bind_result($user_id, $email, $username, $fname, $lname, $sClass, $db_password, $salt, $hname, $hcity, $hstate, $hcode);
        $data = $stmt->fetch();
        print_r($data);

		//Assign userID to from Username in DB.
		//$user_id = $username;

        // hash the password with the unique salt.
        //$password = password_hash($password, PASSWORD_DEFAULT);

        if ($stmt->rowCount() == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts
            if (checkbrute($data['shopper_id'], $db) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if (password_verify($password, $data['sh_password'])) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $data['shopper_id'] = preg_replace("/[^0-9]+/", "", $data['shopper_id']);
                    $_SESSION['user_id'] = $data['shopper_id'];
                    // XSS protection as we might print this value
                    $data['sh_username'] = preg_replace("/[^a-zA-Z0-9_\-]+/",
                                                                "",
                                                                $data['sh_username']);
                    $_SESSION['username'] = $data['sh_username'];
          					$_SESSION['fname'] = $data['sh_firstname'];
          					$_SESSION['lname'] = $data['sh_familyname'];
          					//$_SESSION['hnumber'] = $hnumber;
          					$_SESSION['hname'] = $data['sh_street1'];
          					$_SESSION['hcity'] = $data['sh_city'];
          					$_SESSION['hstate'] = $data['sh_state'];
          					$_SESSION['hcode'] = $data['sh_postcode'];


					//$_SESSION['sClass'] = $sClass;
                    $_SESSION['login_string'] = hash('sha512', $data['sh_password'] . $user_browser);
					//alert ('<br> $password    : ' . $password . '<br>');
					echo "<script type='text/javascript'>alert('$password    : ' . $password');</script>";
					//$login_check1 = hash('sha512', $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $db->exec("INSERT INTO login_attempt(shopper_id, time)
                                    VALUES ('$data[shopper_id]', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
    echo "nothing happened";
}

function checkbrute($id, $db) {
    // Get timestamp of current time
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $db->prepare("SELECT time
                             FROM login_attempt
                             WHERE shopper_id = ?
                            AND time > '$valid_attempts'")) {
        $stmt->bindParam(1, $id);

        // Execute the prepared query.
        $stmt->execute();
        //$stmt->store_result();

        // If there have been more than 5 failed logins
        if ($stmt->rowCount() > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($db) {
 //   print_r($_SESSION['username']);
    // Check if all session variables are set
    if (isset($_SESSION['user_id'],
                        $_SESSION['username'],
                        $_SESSION['login_string'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $db->prepare("SELECT sh_password
                                      FROM shopper
                                      WHERE shopper_id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bindParam(1, $user_id);
            $stmt->execute();   // Execute the prepared query.
            //$stmt->store_result();

            if ($stmt->rowCount() == 1) {
                // If the user exists get variables from result.
                //$stmt->bind_result($password);
                $data = $stmt->fetch();
                $login_check = hash('sha512', $data['sh_password'] . $user_browser);
				//$login_check1 = hash('sha512', $password . $user_browser);

               if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
					echo ('Fail1');
					echo ('<br> LoginCheck   : ' . $login_check . '<br>');
					echo ('<br> $login_string: ' . $login_string . '<br>');
					echo ('<br> $password  2  : ' . $data['sh_password'] . '<br>');
					echo ('<br> $user_browser:' . $user_browser . '<br><br>');

					echo ('<br> Username  : ' . $username . '<br>');
					echo ('<br> First Name:' . $fname . '<br><br>');

                    return false;
                }
            } else {
                // Not logged in
				echo ('Fail2');
                return false;
            }
        } else {
            // Not logged in
			echo ('Fail3');
            return false;
        }
    } else {
        // Not logged in
		echo ('Fail4');
        return false;
    }
}

//function to change password when the user is logged in
function change_password($shopper_id){
  //filter all inputs
  //$shopper_id is directly from database, so no need to filter
  $db = db_connect();
  $oPass = filter_input(INPUT_POST, 'oPass', FILTER_SANITIZE_STRING);
  $nPass = filter_input(INPUT_POST, 'nPass', FILTER_SANITIZE_STRING);
  $conf = filter_input(INPUT_POST, 'conf', FILTER_SANITIZE_STRING);

  //check existing password
  $SQL = "SELECT sh_password FROM shopper WHERE shopper_id=? LIMIT 1";
  $stmt = $db->prepare($SQL);
  $stmt->bindParam(1, $shopper_id);
  $stmt->execute();
  $data = $stmt->fetch();

//validate password format
  $passreg = "/(?=.*[0-9].*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}/";
  if(!strlen($oPass)==8 || !strlen($nPass)==8 || !strlen($conf)==8){
    exit("Passwords must be 8 characters long");
  }
  if(!preg_match($passreg, $oPass) || !preg_match($passreg, $nPass) || !preg_match($passreg, $conf)){
    exit("Passwords must contain at least two numbers, at least one lowercase and at least one uppercase letter, and be 8 characters long.  Please try again.");
  }

//only change password if the user changes it to something different,
//enters their old password correctly, and has their confirmation password matching their new one
  if (password_verify($oPass, $data['sh_password'])) {
    if(!password_verify($nPass, $data['sh_password'])){
      if($nPass == $conf){
        //hash new password
        $password = password_hash($nPass, PASSWORD_DEFAULT);
        //update new password to table
        $SQL = "UPDATE shopper SET sh_password=? WHERE shopper_id=?";
        $stmt = $db->prepare($SQL);
        $stmt->bindParam(1,$password);
        $stmt->bindParam(2, $_SESSION[user_id]);
        $stmt->execute();
        //update login string so user isn't logged out
        $_SESSION['login_string'] = hash('sha512', $password . $_SERVER['HTTP_USER_AGENT']);

        echo "Password changed successfully please return <a href='/comp344Ass2_PDO/home.php'>Home</a>";
      }
      else{
        echo "New password and confirmation don't match. please try again";
      }
    }
    else{
      echo "New password must be different from old password";
    }
  }
  else {
    echo "Incorrect Password. Please re-enter old password";
  }
}

function forgot_password(){
  //sanitise all form inputs
    $db = db_connect();
    $nPass = filter_input(INPUT_POST, 'nPass', FILTER_SANITIZE_STRING);
    $conf = filter_input(INPUT_POST, 'conf', FILTER_SANITIZE_STRING);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);

//validate password format
    $passreg = "/(?=.*[0-9].*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}/";
    if(!strlen($nPass)==8 || !strlen($conf)==8){
      exit("Passwords must be 8 characters long");
    }
    if(!preg_match($passreg, $nPass) || !preg_match($passreg, $conf)){
      exit("Passwords must contain at least two numbers, at least one lowercase and at least one uppercase letter, and be 8 characters long.  Please try again.");
    }
    //make sure passwords match
    if($nPass != $conf){
      exit("Password and confirmation must be the same");
    }
//hash new password
    $password = password_hash($nPass, PASSWORD_DEFAULT);
//insert new password into database
    $SQL="UPDATE shopper SET sh_password=? WHERE shopper_id=?";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1, $password);
    $stmt->bindParam(2, $user_id);
    $stmt->execute();

//delete token from database
    $SQL = "DELETE FROM pwdreset WHERE shopper_id=?";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
}


function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function update_addressBook(){
  //sanitise all form inputs
   
}

function delete_addressBook($deleteID){
  
    $db = db_connect();
 

	$SQL="SELECT sh_firstname, sh_familyname FROM shaddr WHERE shaddr_id=?";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1, $deleteID);
    $stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $SQL="DELETE FROM shaddr WHERE shaddr_id=?";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(1, $deleteID);
    $stmt->execute();
	
	
	echo "<script>
	alert('".$data[0]['sh_firstname']." ".$data[0]['sh_familyname']." Deleted!');
	window.location.href='AddressBook.php';
	</script>";
	
	
	//window.location.href='AddressBook.php';
	
	//echo "<script>window.location.href='AddressBook.php'
	
	/*//echo ('<SCRIPT LANGUAGE=\'JavaScript\'>
    window.alert(\''.$data[0]['sh_firstname'].' '.$data[0]['sh_familyname'].' Deleted!\')
    window.location.href=comp344Ass2_PDO/AddressBook.php\';
    </SCRIPT>');*/

}
