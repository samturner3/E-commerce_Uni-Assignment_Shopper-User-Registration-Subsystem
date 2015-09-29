<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

require_once('includes/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('contents.html');
//$body             = eregi_replace("[\]",'',$body);
$body             = "This is the body";

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "yourusername@gmail.com";  // GMAIL username
$mail->Password   = "yourpassword";            // GMAIL password

$mail->SetFrom('name@yourdomain.com', 'First Last');

$mail->AddReplyTo("name@yourdomain.com","First Last");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "whoto@otherdomain.com";
$mail->AddAddress($address, "John Doe");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
?>
</pre>
<?php echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; ?>
<p>What you may find is an issue with many examples heretofore is that SMTPSecure shown on line 25 needs to be TLS (Transport Layer Security) instead of SSL (Secure Sockets Layer). The other item is the port number is 587 as you see on line 29. You can disable line 29 once you have this fully debugged. Use with care. </p>
<p>These images come with PHPMailer and are included here for your convenience. </p>
<p><img class="alignnone" alt="phpmailer.gif" src="http://www.lonhosford.com/images/xampp/phpmailer.gif" width="170" height="45" /> </p>
<p><img class="alignnone" alt="phpmailer.gif" src="http://www.lonhosford.com/images/xampp/phpmailer_mini.gif" width="79" height="59" /> </p>
<p>Optional external html file for the body content. See line 12 in the code above.</p>
<pre class="brush: xml; collapse: true; light: false; title: ; toolbar: true; notranslate" title=""><body style="margin: 10px;">
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<div align="center"><img style="height: 90px; width: 340px;" alt="" src="phpmailer.gif" /></div><br>
<br>
 This is a test of PHPMailer.<br>
<br>
This particular example uses <strong>HTML</strong>, with a <div> tag and inline<br>
styles.<br>
<br>
Also note the use of the PHPMailer logo above with no specific code to handle
including it.<br />
Included are two attachments:<br />
phpmailer.gif is an attachment and used inline as a graphic (above)<br />
phpmailer_mini.gif is an attachment<br />
<br />
PHPMailer:<br />
Author: Lon Hosford (somebody@no.net)
</div>
</body>
</pre>
<p>[ad name="Google Adsense"]<br />
<g:plusone annotation="inline"></g:plusone></p>
<div id="fb-root"></div>
<p><script src="http://connect.facebook.net/en_US/all.js#appId=105467682877384&xfbml=1"></script><fb:like href="http://www.lonhosford.com/lonblog/2013/11/08/how-to-send-email-from-xampp-using-localhost-on-a-mac-and-your-gmail-account/" send="true" width="450" show_faces="true" font=""></fb:like></p>
<div id="fb-root"></div>
<p><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="http://www.lonhosford.com/lonblog/2013/11/08/how-to-send-email-from-xampp-using-localhost-on-a-mac-and-your-gmail-account/" num_posts="3" width="500"></fb:comments></p>
<p><!-- Place this render call where appropriate --><br>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script><p></p>
</body>
</html>
