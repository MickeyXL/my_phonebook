<?php
/*
require 'PHPMailer/class.phpmailer.php'; // include the class name

//$mail->Username = "intruder.star@gmail.com";
//$mail->Password = "fulltime12345";
//$mail->AddAddress('xl_kid@yahoo.com');


    // Basic Header Input
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; // or 465 or 587
    $mail->Username = 'intruder.star@gmail.com'; // your GMail user name
    $mail->Password = 'fulltime12345';           //"Password";
    // ---------- adjust these lines ---------------------------------------

    $mail->From= 'intruder.star@gmail.com';
    $mail->FromName='My sites mailer';
    $mail->AddAddress('xl_kid@yahoo.com');
    $mail->Subject = 'Your invoice';

    $mail->IsHTML(false);
  //  $mail->AddAttachment('test1.pdf', 'invoice.pdf'); // attach files/invoice-user-1234.pdf, and rename it to invoice.pdf
    $mail->Body = 'Please find your invoice attached.';
    if(!$mail->Send())
    {
       echo 'Error sending: ' . $mail->ErrorInfo;
    }
    else
    {
       echo 'Letter is sent';
    }
*/
    require("PHPMailer/class.phpmailer.php");
    //    $email = 'xl_kid@yahoo.com';
    //    $mail->Username = "intruder.star@gmail.com";
    //    $mail->Password =  "fulltime12345";
    

require 'PHPMailer/lib/PHPMailer/PHPMailerAutoload.php';


//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
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
$mail->Username = 'intruder.star@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'fulltime12345';
//Set who the message is to be sent from
$mail->setFrom('intruder.star@gmail.com', 'First Last');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('xl_kid@yahoo.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('xl_kid@yahoo.com', 'xl_kid@yahoo.com', 'xl_kid@yahoo.com', 'From: xl_kid@yahoo.com');
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}	
		
?>