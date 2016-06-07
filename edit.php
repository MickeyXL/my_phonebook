<?php
	include 'conn.php';
//	include 'session.php';
	
	$myavatar_m = 'uploads/Avatar_Male.png';
	$myavatar_f = 'uploads/Avatar_Female.png';
	
	$id = $_GET['ID'];
	
	$view = "SELECT * from t_phonebook_det where md5(id) = '$id'";
	$result = $pdo->query($view);
	$row= $result->fetch(PDO::FETCH_ASSOC);
	
	$viewP = "SELECT * FROM t_phonebook_more_numbers WHERE md5(phonebook_id) = '$id'";
	$resultP = $pdo->query($viewP);
	$rowP= $resultP->fetchAll(PDO::FETCH_ASSOC);
	
	$viewImg = "SELECT * FROM t_images WHERE md5(phonebook_id) = '$id'";
	$resultImg = $pdo->query($viewImg);
	$rowImg= $resultImg->fetch(PDO::FETCH_ASSOC);
	$photo_id = $rowImg['id'];
	
	$viewE = "SELECT * FROM t_email WHERE md5(phonebook_id) = '$id'";
	$resultE = $pdo->query($viewE);
	$rowE= $resultE->fetchAll(PDO::FETCH_ASSOC);
	
	if(isset($_POST['update'])){
	
		//$id = $_GET['ID'];
	
		$fn = $_POST['fname'];
		$ln = $_POST['surname'];
		$adr = $_POST['address'];
		//$tit = $_POST['title'];
	
		$insert = "UPDATE t_phonebook_det set name = '$fn', surname = '$ln', address = '$adr' where md5(id) = '$id'";
	
		$pnCount = count($_POST["phone_number"]);
		for($i=0;$i<$pnCount;$i++) {
			$insertPn = "UPDATE t_phonebook_more_numbers set phone_number='" . $_POST["phone_number"][$i] . "'  WHERE id='" . $_POST["pnid"][$i] . "'";
			$pdo->query("$insertPn");
		}
		
		$aDescription = $_POST['description'];
		
		if(!isset($aDescription)) 
		{
			echo("<p>There is some error!</p>");
		} 
		else 
		{
			$nDescription = count($aDescription);
						
			for($i=0; $i < $nDescription; $i++)
			{
				echo($aDescription[$i]);
				$insertDsc = "UPDATE t_phonebook_more_numbers set description='" . $_POST["description"][$i] . "' WHERE id='" . $_POST["pnid"][$i] . "'";
			$pdo->query("$insertDsc");
			}
			echo("</p>");
		}
		
		$aTitle = $_POST['title'];
		
		if(!isset($aTitle)) 
		{
			echo("<p>There is some error!</p>");
		} 
		else 
		{
			$nTitle = count($aTitle);
						
			for($i=0; $i < $nTitle; $i++)
			{
				echo($aTitle[$i]);
				$insertTit = "UPDATE t_phonebook_det set title='" . $_POST["title"][$i] . "' WHERE id = '" . $_POST["tid"][$i] . "'";
			$pdo->query("$insertTit");
			}
			echo("</p>");
		}
		
		$aGender = $_POST['gender'];
		
		if(!isset($aGender)) 
		{
			echo("<p>There is some error!</p>");
		} 
		else 
		{
			$nGender = count($aGender);
						
			for($i=0; $i < $nGender; $i++)
			{
				echo($aGender[$i]);
				$insertGen = "UPDATE t_phonebook_det set gender='" . $_POST["gender"][$i] . "' WHERE id = '" . $_POST["gid"][$i] . "'";
			$pdo->query("$insertGen");
			}
			echo("</p>");
		}
		
		$emCount = count($_POST["email"]);
		for($i=0;$i<$emCount;$i++) {
			$insertEm = "UPDATE t_email set email='" . $_POST["email"][$i] . "' WHERE id='" . $_POST["emid"][$i] . "'";
			$pdo->query("$insertEm");
		}
		
		if(isset($_POST['update'])){
			//old photo
			$sql_img = "select * from t_images where md5(phonebook_id) = '$id'";
			$result_img = $pdo->prepare( $sql_img );
			$result_img->execute();
		
			$row_img = $result_img->fetch(PDO::FETCH_ASSOC);
			$image_del = $row_img['name'];
		
			unlink("uploads/$image_del");
	
			$name = $_FILES['photo_upd']['name'];
			$size = $_FILES['photo_upd']['size'];
			$type = $_FILES['photo_upd']['type'];
			$image = $_FILES['photo_upd']['tmp_name'];
			
			$img_sql = "update t_images SET name ='$name', size = '$size', type = '$type', image = '$image' where id = '$photo_id'";
			$pdo->query("$img_sql");
						
			$target_dir = "uploads/";
			$path = 'uploads/'; 
			$location = $path . $_FILES['photo_upd']['name']; 
			move_uploaded_file($_FILES['photo_upd']['tmp_name'], $location);
		}

		//*********************************
	
		if($pdo->query("$insert")){
			echo 'Sucessfully update data';
			header('location:maintenance.php');
		
		}else{
			echo "Oppps something error ";
		}
		$pdo = null;
	}
?>
<html>
	<head>
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
				<form enctype="multipart/form-data" action="" method="POST">
					<table align="center">
						<tr>
							<td>Fisrt Name: <input type="text" name="fname" value="<?php echo $row['name'];?>" placeholder="Type Firstname here" required></td>
						</tr>
						<tr>
							<td>Last Name: <input type="text" name="surname"  value="<?php echo $row['surname'];?>" placeholder="Type Last Name here.." required></td>
						</tr>
						<tr>
								<?php
								$gender = "SELECT * FROM t_phonebook_det WHERE md5(id) = '$id'";
								echo ("<tr><td><input type='hidden' name='gid[]'  value='" . "$row[id]" . "'></td></tr>");
								$gender_results = $pdo->query($gender);
								$gender_id = $row['id'];
								while($rowG = $gender_results->fetch(PDO::FETCH_ASSOC)) {
									$gender_select = $rowG['gender'];
									?>
							<td>Gender:
								<select name="gender[]">
									<?php
										$stmt = $pdo->query('SELECT * FROM t_gender order by gender_description');
										$selected_gender = $row['gender'];
										while($row_gender = $stmt->fetch(PDO::FETCH_ASSOC)) {
											$new_selected_gender = $row_gender['gender_description'];?>
									<option value="<?php echo $new_selected_gender; ?>" <?php if ($selected_gender == $new_selected_gender) echo 'selected="selected"';?>><?php echo $new_selected_gender ; ?></option>
										<?php 
										}
										?>
								</select>
							</td>	
						</tr>
						<?php } ?>
						<tr>
							<td>Address: <input type="text" name="address"  value="<?php echo $row['address'];?>" placeholder="Type Address here.." required></td>
						</tr>
						<tr>
								<?php
								$ttl = "SELECT * FROM t_phonebook_det WHERE md5(id) = '$id'";
								echo ("<tr><td><input type='hidden' name='tid[]'  value='" . "$row[id]" . "'></td></tr>");
								$ttl_results = $pdo->query($ttl);
								
								$tit_id = $row['id'];
								while($rowT = $ttl_results->fetch(PDO::FETCH_ASSOC)) {
									?>
							<td>Title:
								<select name="title[]">
									<?php
										$stmt = $pdo->query('SELECT * FROM t_title order by title');
										$selected_title = $row['title'];
										while($rowTit = $stmt->fetch(PDO::FETCH_ASSOC)) {
											$new_selected_tit = $rowTit['title'];?>
									<option value="<?php echo $new_selected_tit; ?>" <?php if ($selected_title == $new_selected_tit) echo 'selected="selected"';?>><?php echo $new_selected_tit ; ?></option>
										<?php	}
										?>
								</select>
							</td>	
						</tr>
						<?php } ?>
						<tr>
							<?php 
							$info = "SELECT * FROM t_phonebook_more_numbers WHERE md5(phonebook_id) = '$id'";
							$info_results = $pdo->query($info);
								
							while ($info_row = $info_results->fetch(PDO::FETCH_ASSOC)){
								if ($info_row['phonebook_id'] = $row['id']){
									echo ("<tr><td><input type='hidden' name='pnid[]'  value='" . "$info_row[id]" . "'></td></tr>");
									?>
						
							<td>Description:
								<select name="description[]">
									<?php
										$stmt = $pdo->query('SELECT * FROM t_description order by description');
										$selected = $info_row['description'];
										while($row123 = $stmt->fetch(PDO::FETCH_ASSOC)) {
											$new_selected = $row123['description'];?>
									<option value="<?php echo $new_selected; ?>" <?php if ($selected == $new_selected) echo 'selected="selected"';?>><?php echo $new_selected ; ?></option>
										<?php	}
										?>
								</select>
							</td>
						</tr>
									<?php
									echo ("<tr><td>Phone Number: <input type='text' name='phone_number[]'  value='" . "$info_row[phone_number]" . "' placeholder='Type phone_number here..' required></td></tr>");
								} else{ 
									echo ("No Data");
								}
							}
							?>
							<?php 
							$einfo = "SELECT * FROM t_email WHERE md5(phonebook_id) = '$id'";
							$einfo_results = $pdo->query($einfo);
							
							while ($einfo_row = $einfo_results->fetch(PDO::FETCH_ASSOC)){
								if ($einfo_row['phonebook_id'] = $row['id']){
									echo ("<tr><td><input type='hidden' name='emid[]'  value='" . "$einfo_row[id]" . "'></td></tr>");
									echo ("<tr><td>Email: <input type='text' name='email[]'  value='" . "$einfo_row[email]" . "' placeholder='Type email here..' required></td></tr>");
								} else { 
									echo ("No Data");
								}
							}
							?>
							<?php 
							$einfo = "SELECT * FROM t_images WHERE md5(phonebook_id) = '$id'";
							$einfo_results = $pdo->query($einfo);
							
							while ($einfo_row = $einfo_results->fetch(PDO::FETCH_ASSOC)){
								if ($einfo_row['phonebook_id'] = $row['id']){
									echo ("<tr><td><input type='hidden' name='imgid'  value='" . "$einfo_row[id]" . "'></td></tr>");
									$check = $einfo_row['name'];
									if($check == true)
									{
										echo ('<tr><td><img src="getImage.php?name='.$einfo_row['name'].'" alt="Photo" width="100" height="100"/></td></tr>');
									} else {
										if($gender_select == 'Female') {
											echo ('<tr><td><img src="'.$myavatar_f.'" alt="Avatar" width="100" height="100"/></td></tr>');
										} else {
											echo ('<tr><td><img src="'.$myavatar_m.'" alt="Avatar" width="100" height="100"/></td></tr>');
										}
									}
									echo ("<tr><td><input type='file' name='photo_upd' id='photo' /></td></tr>");
								} else{ 
									echo ("No Photo");
								}
							}
							?>
						<tr>
							<td><input type="submit" name="update" value="Update"></td>
							<td><a href="print.php">Print</a></td>
						<!--	<td><a href="print.php?ID=<?php /*echo md5($row['id']);*/?>">Print</a></td> -->
						</tr>
					</table>
				</form>
				<br>
			</div>
		</div>
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>