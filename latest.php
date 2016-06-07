<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/sample/includes/helpers.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>List of numbers</title>
	</head>
	<body>
		<h2>Latest added contacs by <?php
		echo 'user' . ' ' . $first_name . ' ' . $last_name . ' '; ?>
		</h2>
			<?php 
				if ($result_rec->rowCount() > 0) {
					$row_rec = array();
					foreach ($rec_names as $rec_name) {  ?>
					<ul>
						<?php echo "<b>"; ?>
						<?php htmlout($rec_name['id']); ?>
						<?php echo "</b>"; ?>		
						<?php htmlout($rec_name['name'] . " " . $rec_name['surname'] . " " . $rec_name['address'] . " " . $rec_name['title']); ?>
					</ul>	
					<?php }
				} else {
					echo 'user' . ' ' . $first_name . ' ' . $last_name . ' ' . 'did not add any data';
				}
			?>				
		</form>
	</body>
</html>