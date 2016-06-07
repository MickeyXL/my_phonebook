<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/sample/includes/helpers.inc.php'; 
//include 'conn.php';

?>

<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>List of numbers</title>
	</head>
	<body>
		<h2 class="names_line">Here are all the numbers in the database:</h2>
		<hr/>
		<form action="" method="post">
			<ol>
				<?php foreach ($names as $name) { ?>
					<?php echo "<b>"; ?>
					<?php htmlout($name['id']); ?>
					<?php echo "</b>"; ?>		
					<?php htmlout($name['name'] . " " . $name['surname'] . " " . $name['address'] . " " . $name['title']); ?>
					<input type="hidden" name="id" value="<?php echo $name['id']; ?>" />
					<input type="hidden" name="useradded" value="<?php $userID = $_SESSION['id'] ?>">
				<!--	<input type="submit" value="Delete" />	-->
					<li>
						<ul>
							<?php		
								$contact = $pdo->query('SELECT * FROM t_phonebook_more_numbers WHERE phonebook_id="'.$name['id'].'";');
							?>	
							<?php 
								foreach ($contact as $number) { 
							?>
							<li>
								<?php echo "<b>"; ?>
								<?php htmlout($number['description']); ?>
								<?php echo "</b>"; ?>
								<?php htmlout($number['phone_number']); ?>
							
								<?php } ?>
								<?php		
									$emails = $pdo->query('SELECT * FROM t_email WHERE phonebook_id="'.$name['id'].'";');
								?>	
								<?php $i = 1;
									foreach ($emails as $email) { 
								?>
							</li>
							<li>
								<?php echo "<b>"; ?>
								<?php echo "email ".$i. ": "; ?>
								<?php echo "</b>"; ?>
								<?php htmlout($email['email']); ?>
								<?php $i++;
								} ?>
							</li>	
						</ul>	
						<hr/>
					</li>
				<?php } ?>
				
			</ol>
		</form>
	</body>
</html>