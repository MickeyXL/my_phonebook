<?php
	include 'conn.php';

	
	try{
		$sql = "SELECT * FROM t_user WHERE username= '".$_SESSION['username']."'";
		$result = $pdo->query($sql);
		
		while ($row = $result->fetch()){
					$user_data[] = $row;
		}
				
		foreach ($user_data as $user_loged) { 
			$id = $user_loged['id']; 			
			$username_pr = $user_loged['username']; 
			$first_name = $user_loged['first_name'];
			$last_name = $user_loged['last_name'];
			$email_pr = $user_loged['email'];
		}
					
	}
	catch (PDOException $e){
		$error = 'Error fetching number: ' . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
		if(isset($_POST['update'])){
	
		//$id = $_GET['ID'];
		$un = $_POST['username'];
		$fn = $_POST['first_name'];
		$ln = $_POST['last_name'];
		$eml = $_POST['email'];
		//$tit = $_POST['title'];
	
		$insert = "UPDATE t_user set first_name = '$fn', last_name = '$ln', email = '$eml' where id = '$id'";
		
		if($pdo->query("$insert")){
			echo 'Sucessfully update data';
			header('location:profile.php');
		
		}else{
			echo "Oppps something error ";
		}
		$pdo = null;
		
		}
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
				<form enctype="multipart/form-data" action="" method="POST">
						<tr>
							<td>Userame: <input type="text" name="username" value="<?php echo $username_pr;?>" placeholder="Type username here" required></td>
						</tr>
						<tr>
							<td>First Name: <input type="text" name="first_name"  value="<?php echo $first_name;?>" placeholder="Type First Name here.." required></td>
						</tr>
						<tr>
							<td>Last Name: <input type="text" name="last_name"  value="<?php echo $last_name;?>" placeholder="Type First Name here.." required></td>
						</tr>
						
						<tr>
							<td>Email: <input type="text" name="email"  value="<?php echo $email_pr;?>" placeholder="Type email here.." required></td>
						</tr>

						<tr>
							<td><input type="submit" name="update" value="Update"></td>
							<td><a href="print.php">Print</a></td>
						
						</tr>
				</form>
			
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