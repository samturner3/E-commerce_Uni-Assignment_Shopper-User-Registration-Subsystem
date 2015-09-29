<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

//include_once '../includes/psl-config.php';
//include_once '../includes/db_connect.php';

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
// 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!


$oraUser="43156711";
$oraPass="radiophone\$m00";
$oraDB="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=animatrix.science.mq.edu.au)(PORT=1521)))(CONNECT_DATA=(SID=one)))";

$conn = oci_connect($oraUser,$oraPass,$oraDB);


$email = 'samburner3@hotmail.com';
$password = 'pass$';

	
$emailcheck = $conn; //$connection
$emailcheck = oci_parse($emailcheck, 'select * from MEMBERS');
//$emailcheck = oci_parse($emailcheck, "select EMAIL from MEMBERS where EMAIL = 'samburner3@hotmail.com'");
//oci_bind_by_name($emailcheck, ":email", $email);
oci_execute($emailcheck);
oci_fetch_all($emailcheck, $res);
echo oci_num_rows($emailcheck) . " rows found.<br />\n";

        if (oci_num_rows($emailcheck) == 1) {
			echo ('email exists!');
            // A user with this email address already exists
            //$error_msg .= 'A user with this email address already exists. (ServerSide check error)';
			//$error_array[] = 'A user with this email address already exists. (ServerSide check error)';
                       oci_close($conn);
        }
		else {
		echo ('email ok!');	
		oci_close($conn);
		}

?>
</body>
</html>
