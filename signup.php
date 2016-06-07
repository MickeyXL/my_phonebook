<?php require('conn.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); } 

//if form has been submitted process it
if(isset($_POST['submit'])){

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

	//email validation
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

			//insert into database db with a prepared statement
			$stmt = $pdo->prepare('INSERT INTO t_user (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $pdo->lastInsertId('id');

			//send email
			
//**********************************
//$body = "From: $namec\n E-Mail: $email\n Message:\n $message";
$email_address = $_POST['email'];
$body = "Thank you for registering at demo site.\n\n To activate your account, please click on this link:\n\n ".DIR."activate.php?x=".$id."&y=".$activasion."\n\n Regards Site Admin \n\n";
							
						$message = "Thank you for registering at demo site.\n\n To activate your account, please click on this link:\n\n <a href>".DIR."activate.php?x=".$id."&y=".$activasion."</a>\n\n Regards Site Admin \n\n";
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
			header('Location: index.php?action=joined');
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
//require('header.php'); 
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Sign Up</h2>
				<p>Already a member? <a href='login.php'>Login</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>

</div>

<?php 
//include header template
require('footer.php'); 
?>
