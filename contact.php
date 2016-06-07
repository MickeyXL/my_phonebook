<?php
	include 'conn.php';
	//$username = $_SESSION['username'];
	//$userID = $_SESSION['id'];
	//$first_name = $_SESSION['first_name'];
	//$last_name = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
		<link rel="stylesheet" type="text/css" href="mycss.css">
		<title>
			Phonebook
		</title>
	</head>
	<body>
		<header class="bar">
			<?php include 'header.php';
			?>
		</header>
		<div id="menu">
			<?php include 'main_menu.php';
			?>
		</div>
		<div id="body" class="about_result">
			<div class="bar">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="content">
				<?php		
					if(isset($_POST['submit'])) {
					
						$namec = $_POST['namec'];
						$email = $_POST['email'];
						$message = $_POST['message'];
						$from = 'From: Test contact'; 
						$to = 'xl_kid@yahoo.com'; 
						$subject = 'Hello';
						$human = $_POST['human'];
						
						$body = "From: $namec\n E-Mail: $email\n Message:\n $message";
							
						$message=
							'Full Name:	'.$_POST['namec'].'<br />
							Email:	'.$_POST['email'].'<br />
							Comments:	'.$_POST['message'].'';
						require "phpmailer/class.phpmailer.php"; //include phpmailer class
						
						// Instantiate Class  
						$mail = new PHPMailer();  
						
						// Set up SMTP  
						$mail->IsSMTP();                // Sets up a SMTP connection  
						$mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
						$mail->SMTPSecure = "tls";      // Connect using a TLS connection  
						$mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
						$mail->Port = 587;  //Gmail SMTP port
						$mail->Encoding = '7bit';
						
						// Authentication  
						$mail->Username   = "intruder.star@gmail.com"; // Your full Gmail address
						$mail->Password   = "fulltime12345"; // Your Gmail password
						
						// Compose
						//$mail->SetFrom($_POST['email'], $_POST['namec']);
						$mail->SetFrom("NoReply@yahoo.com", "xlk");
						$mail->AddReplyTo($_POST['email'], $_POST['namec']);
						$mail->Subject = "New Contact Form Enquiry";      // Subject (which isn't required)  
						$mail->MsgHTML($message);
					
						// Send To  
						$mail->AddAddress("xl_kid@yahoo.com", "xlk"); // Where to send it - Recipient
						$mail->AddAddress($_POST['email'], $_POST['namec']); // Where to send it - Recipient
						$result = $mail->Send();		// Send!  
						$message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
						unset($mail);
						
						if ($_POST['submit'] && $human == '4') {				 
							if (mail ($to, $subject, $body, $from)) { 
							echo '<p>Your message has been sent!</p>';
						} else { 
							echo '<p>Something went wrong, go back and try again!</p>'; 
						} 
						} else if ($_POST['submit'] && $human != '4') {
						echo '<p>You answered the anti-spam question incorrectly!</p>';
						}
					}	
				?>			

				<form class="contact_form" method="post" action="" enctype="multipart/form-data">    
					<label>Name</label>
					<input name="namec" placeholder="Type Here">
							
					<label>Email</label>
					<input name="email" type="email" placeholder="Type Here">
							
					<label>Message</label>
					<textarea name="message" placeholder="Type Here"></textarea>
							
					<label>*What is 2+2? (Anti-spam)</label>
					<input name="human" placeholder="Type Here">
					
					<input id="submit" name="submit" type="submit" value="Submit">
        
				</form>

			</div>
			<div class="aside">

			</div>
		</div>
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>