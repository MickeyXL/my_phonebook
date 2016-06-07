<?php
//include config
require_once('conn.php');


//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: login.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: home.php');
		exit;
	
	} else {
		print_r($password);
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end if submit

//define page title
$title = 'Login';

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
				<div class="row">

	    <div>
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Login</h2>
				<p><a href='./'>Back to home page</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>

				<div>
					<input type="text" name="username" id="username" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div>
					<input type="password" name="password" id="password" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row">
					<div>
						 <a href='reset.php'>Forgot your Password?</a>
					</div>
				</div>
				
				<hr>
				<div class="row">
					<div><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
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
		<?php include 'footer.php';
		?>
	</footer>
</html>
