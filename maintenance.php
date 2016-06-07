<?php
	include 'conn.php';
//	include 'session.php';
	
	$myavatar_m = 'uploads/Avatar_Male.png';
	$myavatar_f = 'uploads/Avatar_Female.png';
	
	if($pdo){
		$log_user = "SELECT id, first_name, last_name, rol FROM t_user WHERE username= '".$_SESSION['username']."'";    
		$userIDD = $pdo->query($log_user);

		while ($row = $userIDD->fetch()){
			$user_data[] = $row;
		}
	}
		foreach ($user_data as $user_loged) { 
							
								$userID = $user_loged['id']; 
								$first_name = $user_loged['first_name'];
								$last_name = $user_loged['last_name'];
								$rol = $user_loged['rol'];
								 }
								 
	if(isset($_POST['add'])){
		$fname = $_POST['name'];
		$surname = $_POST['surname'];
		$insert = "insert into t_phonebook_det (name, surname) values ('$fname', '$surname')";
		
		if($pdo->query($insert)){
				echo "Sucessfully add data";
				header('location:maintenance.php');
		}else{
			echo "Ooppss cannot add data" . $pdo->connect_error;
			header('location:maintenance.php');
		}
		$insert = null;
	}
	if (isset($_GET['addnumber'])){
			include 'form.html.php';
			exit();
	}
	
	//UPIS PODATAKA U TABELU
	if (isset($_POST['name'])){
		try{
			$sql = 'INSERT INTO t_phonebook_det SET
			name = :name,
			surname = :surname,
			address = :address,
			title = :title,
			photo = :photo';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':surname', $_POST['surname']);
			$s->bindValue(':address', $_POST['address']);
			$s->bindValue(':title', $_POST['title']);
			$s->bindValue(':photo', $_POST['photo']);
			$s->execute();
			$insert_id = $pdo->lastInsertId();
	
			$sql = 'INSERT INTO t_phonebook_more_numbers SET
			phonebook_id = :phonebook_id,
			description = :description,
			phone_number = :phone_number';
			$s = $pdo->prepare($sql);
			$s->bindValue(':phonebook_id', $pdo->lastInsertId());
			$s->bindValue(':description', $_POST['description']);
			$s->bindValue(':phone_number', $_POST['phone_number']);
			$s->execute();
			
		}
		catch (PDOException $e){
			$error = 'Error adding number: ' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		header('Location: .');
		exit();
	}
?>
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
		<div id="body">
			
			<div id="content">
				<form action="result.php" method="get" ecntype="multipart/data-form">
					<table align="center">
						<tr>
							<td>Search: <input type="text" name="query"><input type="submit" value="Search" name="search"></td>
						</tr>
					</table>
				</form>
				<form action="maintenance.php" method="POST">

				</form>
				<br />
			</div>
			<div class="table">
			<table class="table_num_data" align="center" border="1" cellspacing="0" width="90%">
				<tr style="background-color:#154462">
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Address</th>
					<th>Title</th>
					<th>Number</th>
					<th>Email</th>
					<th>Photo</th>
					<th>Action</th>
				</tr>
				<?php

				
				switch ($rol) {
						case "User":
							$sql = "SELECT * FROM t_phonebook_det WHERE useradded = '$userID'";
							$result = $pdo->query($sql);

						break;
						case "Administrator":
							$sql = "SELECT * FROM t_phonebook_det";
							$result = $pdo->query($sql);

						break;

					}

				//$sql = "SELECT * FROM t_phonebook_det";
				//$result = $pdo->query($sql);
				if(count($result) > 0 ){
					while($row= $result->fetch(PDO::FETCH_ASSOC)){
					?>
					<tr>
						<td align="center"><?php echo $row['name'];?></td>
						<td align="center"><?php echo $row['surname'];?></td>
						<td align="center">
								<?php 
							$gen_info = "SELECT * FROM t_phonebook_det WHERE id = '$row[id]'";
							$gen_info_results = $pdo->query($gen_info);
							while ($gen_info_row = $gen_info_results->fetch(PDO::FETCH_ASSOC)){
								$gender_select = $gen_info_row['gender'];
								echo $gen_info_row['gender'];
							} 
							?>
						</td>
						<td align="center"><?php echo $row['address'];?></td>
						<td align="center">
								<?php 
							$tit_info = "SELECT * FROM t_phonebook_det WHERE id = '$row[id]'";
							$tit_info_results = $pdo->query($tit_info);
							while ($tit_info_row = $tit_info_results->fetch(PDO::FETCH_ASSOC)){
								echo $tit_info_row['title'];
							} 
							?>
						</td>
						<td align="center"><?php 
							$info = "SELECT * FROM t_phonebook_more_numbers WHERE phonebook_id = $row[id] ";
							$info_results = $pdo->query($info);
							while ($info_row = $info_results->fetch(PDO::FETCH_ASSOC)){
								if ($info_row['phonebook_id'] = $row['id']){
									echo ("$info_row[description]" . ": " ."$info_row[phone_number]" . "<br />");
								} else{ 
									echo ("No Data");
								}
							} 
							?>
						</td>
						<td align="center"><?php 
							$einfo = "SELECT * FROM t_email WHERE phonebook_id = $row[id] ";
							$einfo_results = $pdo->query($einfo);
							while ($einfo_row = $einfo_results->fetch(PDO::FETCH_ASSOC)){
								if ($einfo_row['phonebook_id'] = $row['id']){
									echo ("$einfo_row[email]" . "<br />");
								} else{ 
									echo ("No Data");
								}
							}
							?>
						</td>
						<td align="center">
							<?php
							$sql_img = "select * from t_images where phonebook_id = $row[id]";
							$result_img = $pdo->prepare( $sql_img );
							$result_img->execute();

							while ($row_img = $result_img->fetch(PDO::FETCH_ASSOC)){
									$check = $row_img['name'];
									if($check == true)
									{
										echo '<img src="getImage.php?name='.$row_img['name'].'" alt="Photo" width="100" height="100"/>';
									} else {
										if($gender_select == 'Male') {
											echo '<img src="'.$myavatar_m.'" alt="Avatar" width="100" height="100"/>';
										} else {
											echo '<img src="'.$myavatar_f.'" alt="Avatar" width="100" height="100"/>';
										}
										
									}
							}
							?>
						</td>
						<td align="center"><a href="edit.php?ID=<?php echo md5($row['id']);?>">Edit
							</a>/<a href="delete.php?ID=<?php echo md5($row['id']);?>">Delete</a>
						</td>
					</tr>
					<?php
					}	
				}else{
					echo "<center><p> No Records</p></center>";
				}
				$pdo = null;
				?>
			</table>
			</div>
		</div>
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>