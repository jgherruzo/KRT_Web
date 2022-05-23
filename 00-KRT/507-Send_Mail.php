<?php


function Send_Mail($to,$subject,$body)
{
	
include_once 'Exception.php';
include_once 'PHPMailer.php';
include_once 'SMTP.php';
	$from= "KRTChampionship@gmail.com";
 
$address = $to;
//Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "KRTChampionship@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "****************";
//Set who the message is to be sent from
$mail->setFrom($from, 'KRT Website');
//Set an alternative reply-to address
$mail->addReplyTo($from, 'KRT Website');
//Set who the message is to be sent to
$mail->addAddress($address, $to);
//Set the subject line
$mail->Subject= $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($body);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;

	}
}

?>
