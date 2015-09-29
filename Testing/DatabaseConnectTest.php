<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.34)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))" ;

    if($c = OCILogon("system", "your database password", $db))
    {
        echo “Successfully connected to Oracle.\n”;
        OCILogoff($c);
    }
    else
    {
        $err = OCIError();
        echo “Connection failed.” . $err[text];
    }
?>

</body>
</html>
