<?php require('conn.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: home.php'); } 

//if form has been submitted process it
if(isset($_POST['submit'])){

$email_address = $_POST['email'];

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $pdo->prepare('SELECT username FROM t_user WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}
			
	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation //$db
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $pdo->prepare('SELECT email FROM t_user WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
			
	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $pdo->prepare('INSERT INTO t_user (username,first_name,last_name,password,email,active) VALUES (:username, :first_name, :last_name, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':first_name' => $_POST['first_name'],
				':last_name' => $_POST['last_name'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $pdo->lastInsertId('id');

			//send email
			
//**********************************
//$body = "From: $namec\n E-Mail: $email\n Message:\n $message";

$body = "Thank you for registering at demo site.\n\n To activate your account, please click on this link: http://".DIR."activate.php?x=".$id."&y=".$activasion."\n\n Regards Site Admin \n\n";
							
						$message = "Thank you for registering at demo site.\n\n To activate your account, please click on this link: http://".DIR."activate.php?x=".$id."&y=".$activasion."\n\n Regards Site Admin \n\n";
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

						$mail->Subject = "Registration Confirmation";
						
						$mail->MsgHTML($message);
					
						// Send To  
						$mail->AddAddress($_POST['email']); // Where to send it - Recipient
						$result = $mail->Send();		// Send!  
						$message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
						unset($mail);


//**********************************



			//redirect to index page
			header('Location: register.php?action=joined');
			
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Demo';

//include header template
//require('layout/header.php'); 
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
		
		<div id="body" class="about_result">
			<div class="bar">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="content">			
				<div>

	    <div>
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Sign Up</h2>
				<p>Already a member? <a href='login.php'>Login</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p>'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2>Registration successful, please check your email to activate your account.</h2>";
				}
				
				?>

				<div>
					<input type="text" name="username" id="username" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div>
					<input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php if(isset($error)){ echo $_POST['first_name']; } ?>" tabindex="2">
				</div>
				<div>
					<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php if(isset($error)){ echo $_POST['last_name']; } ?>" tabindex="3">
				</div>
				<div>
					<input type="email" name="email" id="email" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="4">
				</div>
				<div>
					<div>
						<div>
							<input type="password" name="password" id="password" placeholder="Password" tabindex="5">
						</div>
					</div>
					<div>
						<div>
							<input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" tabindex="6">
						</div>
					</div>
				</div>
				
				<div>
					<div><input type="submit" name="submit" value="Register" tabindex="7"></div>
				</div>
			</form>
		</div>
	</div>
			</div>
			<div class="aside">
				<p>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, nobis, porro, nihil corrupti consequatur provident optio quos soluta nam molestias cumque voluptas perferendis eum error doloremque harum ea explicabo nostrum.</span>
					</br></br>
				</p>
			</div>
		</div>
		
	</body>
	<footer class="footer-distributed">
		<?php //include 'footer.php';
		?>
	</footer>
</html>
