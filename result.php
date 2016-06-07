<?php
	include 'conn.php';
	//include 'session.php';
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
		
			<div id="content" class="search_result">
				<form action="result.php" method="get" ecntype="multipart/data-form">
					<table align="center">
						<tr>
							<td>Search: <input type="text" name="query"><input type="submit" value="Search" name="search"></td>
						</tr>
					</table>
				</form>
				<form action="maintenance.php" method="POST">
				</form>
				<br>
				<table align="center" border="1" cellspacing="0" width="500">
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Phone Number</th>
						<th>Action</th>
					</tr>
					<?php
					if(isset($_GET['search'])){
						$query = $_GET['query'];

						$sql = "select * FROM t_phonebook_det a INNER JOIN t_phonebook_more_numbers b ON a.id = b.phonebook_id where name like '%$query%' or surname like '%$query%' or phone_number like '%$query%'";
						$result = $pdo->query($sql);

						if($result->rowCount() > 0){
							while($row = $result->fetch()){
								$fname = $row['name'];
								$lname = $row['surname'];
								$phnum = $row['phone_number'];
								?>
								<tr>
									<td align="center"><?php echo $fname;?></td>
									<td align="center"><?php echo $lname;?></td>
									<td align="center"><?php echo $phnum;?></td>
									<td align="center"><a href="edit.php?ID=<?php echo md5($row['phonebook_id']);?>">Edit
									</a>/<a href="delete.php?ID=<?php echo md5($row['phonebook_id']);?>">Delete</a></td>
								</tr>
								<?php
							}
						}else{
							echo "<center>No records</center>";
						}
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