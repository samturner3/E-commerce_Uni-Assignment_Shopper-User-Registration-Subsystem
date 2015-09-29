<?php
include_once 'psl-config.php';
include_once 'db_connect.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
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



function login($email, $password, $conn) {
	
$sessionconn = $conn; //$connection
$sessionconn = oci_parse($sessionconn, "select * from MEMBERS where EMAIL = :email");
oci_bind_by_name($sessionconn, ":email", $email);
oci_execute($sessionconn);


while (($row = oci_fetch_array($sessionconn))) {
$user_id = $row['USERID'];
$email = $row['EMAIL']; 
$username = $row['USERNAME'];
$fname = $row['FNAME']; 
$lname = $row['LNAME'];
$sClass = $row['SCLASS']; 
$hname = $row['HNAME'];
$hcity = $row['HCITY']; 
$hstate =  $row['HSTATE'];
$hcode = $row['HCODE']; 
$ccard = $row['CCARD'];
$ccexpiremonth = $row['CCEXPMONTH']; 
$ccexpireyear = $row['CCEXPYEAR'];
$db_password = $row['PASSWORD'];
}

echo ('From Database:' . $user_id . $email . $username . '');

    // Using prepared statements means that SQL injection is not possible. 
//    if ($stmt = $mysqli->prepare("SELECT members.userid, members.email, members.username, members.fname, members.lname, members.sClass, members_password.password, members_addresses.hname, members_addresses.hcity, members_addresses.hstate, members_addresses.hcode
//									from members
//									INNER JOIN members_password
//									ON members.email = members_password.email
//									INNER JOIN members_addresses
//									ON members.email =  members_addresses.email
//       								WHERE members.email = ?
//       								LIMIT 1
//		")) {
//        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
//        $stmt->execute();    // Execute the prepared query.
//        $stmt->store_result();
 
        // get variables from result.
        //$stmt->bind_result($user_id, $email, $username, $fname, $lname, $sClass, $db_password, $hname, $hcity, $hstate, $hcode);
//        $stmt->fetch();
		
		//Assign userID to from Username in DB.
		//$user_id = $username;
 
        // hash the password with the unique salt.
        //$password = hash('sha512', $password . $salt);
        if (oci_num_rows($sessionconn) == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                     
					                                            $username);
					$_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;
					$_SESSION['fname'] = $fname;
					$_SESSION['lname'] = $lname;
					//$_SESSION['hnumber'] = $hnumber;
					$_SESSION['sClass'] = $sClass;
					$_SESSION['hname'] = $hname;
					$_SESSION['hcity'] = $hcity;
					$_SESSION['hstate'] = $hstate;
					$_SESSION['hcode'] = $hcode;
					
					$_SESSION['ccard'] = $ccard;
					$_SESSION['ccexpmonth'] = $ccexpiremonth;
					$_SESSION['ccexpyear'] = $ccexpireyear;
					
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
					//alert ('<br> $password    : ' . $password . '<br>');
				
					//$login_check1 = hash('sha512', $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    echo ('fail1');
                    return false;
                }
            
        } else {
            // No user exists.
			echo ('fail2');
            return false;
        }
		oci_free_statement($sessionconn); 
		oci_close($conn);
    }
//}

function checkbrute($email, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE email = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $email);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($conn) {



    // Check if all session variables are set
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
		
		
		//$conn = oci_connect($oraUser,$oraPass,$oraDB);

		$checkconn = $conn; //$connection
		$checkconn = oci_parse($checkconn, "select * from MEMBERS where USERNAME = :username");
		oci_bind_by_name($checkconn, ":username", $username);

		oci_execute($checkconn);
		
		//oci_fetch_all($checkconn, $res);
		while (($row = oci_fetch_array($checkconn))) {
			$password = $row['PASSWORD'];
		}
            if (oci_num_rows($checkconn) == 1) {
                // If the user exists get variables from result.
				
                $login_check = hash('sha512', $password . $user_browser);
				//$login_check1 = hash('sha512', $password . $user_browser);
 
               if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
			/*		echo ('<br> LoginCheck   : ' . $login_check . '<br>');
					echo ('<br> $login_string: ' . $login_string . '<br>');
					echo ('<br> $password  2  : ' . $password . '<br>');
					echo ('<br> $user_browser:' . $user_browser . '<br><br>');*/
                    return false;
					echo ('fail1');
                }
            } else {
                // Not logged in 
			echo ('fail2');
                return false;
            }
        } else {
            // Not logged in 
			//echo ('fail3');
            return false;
    }
	oci_close($conn);
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