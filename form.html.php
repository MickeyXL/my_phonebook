<?php
	include 'conn.php';
	//include 'session.php';

	//UPIS PODATAKA U TABELU
	if (isset($_POST['name']))
	{
		try
		{
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["photo"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["photo"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["photo"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
			
			$sql = 'INSERT INTO t_phonebook_det SET
			name = :name,
			surname = :surname,
			gender = :gender,
			address = :address,
			title = :title,
			useradded = :useradded';
			$s = $pdo->prepare($sql);
			$s->bindValue(':name', $_POST['name']);
			$s->bindValue(':surname', $_POST['surname']);
			$s->bindValue(':gender', $_POST['gender']);
			$s->bindValue(':address', $_POST['address']);
			$s->bindValue(':title', $_POST['title']);
			$s->bindValue(':useradded', $_POST['useradded']);
		//	$s->bindValue(':photo', $_FILES['photo']);
			$s->execute();
			$insert_id = $pdo->lastInsertId();
			
			$sql = 'INSERT INTO t_images SET
			phonebook_id = :phonebook_id,
			name = :name,
			size = :size,
			type = :type,
			image = :image';
			$s = $pdo->prepare($sql);
			$s->bindValue(':phonebook_id', $insert_id);
			$s->bindValue(':name', $_FILES['photo']['name']);
			$s->bindValue(':size', $_FILES['photo']['size']);
			$s->bindValue(':type', $_FILES['photo']['type']);
			$s->bindValue(':image', $_FILES['photo']['tmp_name']);

			$s->execute();
			

			foreach($_POST['description'] as $key => $description) { 
				$phone_number = $_POST['phone_number'][$key]; 
				$stmt = $pdo->prepare("INSERT INTO t_phonebook_more_numbers (phonebook_id, description, phone_number) VALUES ('$insert_id', '$description', '$phone_number')");
				$stmt->execute();
			}
			
			foreach($_POST['email'] as $key => $email) { 
				$phone_number = $_POST['phone_number'][$key]; 
				$stmt = $pdo->prepare("INSERT INTO t_email (phonebook_id, email) VALUES ('$insert_id', '$email')");
				$stmt->execute();
			}

		}
		catch (PDOException $e)
		{
			$error = 'Error adding number: ' . $e->getMessage();
			include 'error.html.php';
			exit();
		}
		header('Location: home.php');
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
		<SCRIPT language="javascript">
			function addRow(t_phonebook_more_numbers) {
				var table = document.getElementById(t_phonebook_more_numbers);
				var rowCount = table.rows.length;
				if(rowCount < 5){
					var row = table.insertRow(rowCount);
					var colCount = table.rows[0].cells.length;
					for(var i=0; i<colCount; i++) {
					var newcell = row.insertCell(i);
					newcell.innerHTML = table.rows[0].cells[i].innerHTML;
					}
				}else{
					alert("Maximum phone numbers are 5");		
				}
			}
			function deleteRow(t_phonebook_more_numbers) {
				var table = document.getElementById(t_phonebook_more_numbers);
				var rowCount = table.rows.length;
				for(var i=0; i<rowCount; i++) {
					var row = table.rows[i];
					var chkbox = row.cells[0].childNodes[0];
					if(null != chkbox && true == chkbox.checked) {
						if(rowCount <= 1) { 
							alert("Cannot Remove all the numbers.");
							break;
						}
						table.deleteRow(i);
						rowCount--;
						i--;
					}
				}
			}
			function addRowEmail(t_email) {
				var table = document.getElementById(t_email);
				var rowCount = table.rows.length;
				if(rowCount < 5){
					var row = table.insertRow(rowCount);
					var colCount = table.rows[0].cells.length;
					for(var i=0; i<colCount; i++) {
						var newcell = row.insertCell(i);
						newcell.innerHTML = table.rows[0].cells[i].innerHTML;
					}
				}else{
					alert("Maximum email address are 5");		
				}
			}
			function deleteRowEmail(t_email) {
				var table = document.getElementById(t_email);
				var rowCount = table.rows.length;
				for(var i=0; i<rowCount; i++) {
					var row = table.rows[i];
					var chkbox = row.cells[0].childNodes[0];
					if(null != chkbox && true == chkbox.checked) {
						if(rowCount <= 1) { 
							alert("Cannot Remove all the email.");
							break;
						}
						table.deleteRow(i);
						rowCount--;
						i--;
					}
				}
			}
		</SCRIPT>
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
				<br />
				<div class="form_add">
					<form action="?" method="post" enctype="multipart/form-data">
						<div>
							<label for="name">Name:</label>
							<input type="text" name="name" id="name" />
							<label for="surname">Surname:</label>
							<input type="text" name="surname" id="surname" />
							<label for="gender">Gender:</label>
							<select name="gender" id="gender">
								<option>-select-</option>
								<?php 
									$stmt_gender = $pdo->prepare('SELECT gender_description FROM t_gender ORDER BY gender_description');
									$stmt_gender->execute();
									while($row = $stmt_gender->fetch(PDO::FETCH_ASSOC)) {
										echo '<option>' . $row['gender_description'] . '</option>';
									}
								?>
							</select>
							<label for="address">Address:</label>
							<input type="text" name="address" id="address" />
							<label for="Title">Title:</label>
							<select id="title" name="title">
								<option>-select-</option>
								<?php
									$stmt = $pdo->prepare('SELECT title FROM t_title order by title');
									$stmt->execute();
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
										echo '<option>'.$row['title'].'</option>';
									}
								?>
							</select>
							<label for="photo">Photo:</label>
							<input type="file" name="photo" id="photo" />
							<?php
								if($pdo){
									$log_user = "SELECT id, first_name, last_name FROM t_user WHERE username= '".$_SESSION['username']."'";    
									$userIDD = $pdo->query($log_user);

									while ($row = $userIDD->fetch()){
										$user_data[] = $row;
									}
								}
								foreach ($user_data as $user_loged) { 
							
									$userID = $user_loged['id']; 
								//	$first_name = $user_loged['first_name'];
								//	$last_name = $user_loged['last_name'];
								}
							?>
							<input type="hidden" name="useradded" value="<?php echo $userID; ?>"/>
						</div>	
						<br />
						<div>
							<INPUT type="button" value="Add Number" onclick="addRow('dataTable')" /> 
							<INPUT type="button" value="Delete Number" onclick="deleteRow('dataTable')" />
							<TABLE id="dataTable" width="350px" border="1">
								<TR>
									<TD><INPUT type="checkbox" name="chk"/></TD>
									<TD>
										<input type="hidden" name="phonebook_id[]" id="phonebook_id" />
									</TD>
									<TD>
										<select id="description" name="description[]">
											<?php
												$stmt = $pdo->prepare('SELECT * FROM t_description order by description');
												$stmt->execute();
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													echo '<option>'.$row['description'].'</option>';
												}
											?>
										</select>
									</TD>
									<TD>
										<input type="text" name="phone_number[]" id="phone_number" />
									</TD>
								</TR>
							</TABLE>
						</div>
						<br />
						<div>
							<INPUT type="button" value="Add Email" onclick="addRowEmail('dataTableEmail')" /> 
							<INPUT type="button" value="Delete Email" onclick="deleteRowEmail('dataTableEmail')" />
							<TABLE id="dataTableEmail" width="350px" border="1">
								<TR>
									<TD><INPUT type="checkbox" name="chk"/></TD>
									<TD>
										<input type="hidden" name="phonebook_id[]" id="phonebook_id" />
									</TD>
									<TD>
										<input type="text" name="email[]" id="email" />
									</TD>
								</TR>
							</TABLE>
						</div>
						<br />
						<br />
						<div><input type="submit" value="Add" /></div>
					</form>
				</div>
				<?php /*
					echo "<br /><br />";
					echo $userID = $_SESSION['id'];
					echo "<br /><br />";
					echo $first_name = $_SESSION['first_name'] . " " . $first_name = $_SESSION['last_name'];
					echo "<br /><br />";*/
				?>
			</div>
		</div>
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>