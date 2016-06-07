<?php
	include 'conn.php';
	$id = $_GET['ID'];
	//	$sql = "Delete from t_phonebook_det where md5(id) = '$id'";
	//*****************
	//$delete_id =  $_POST['id']; 
	
	$sql_img = "select * from t_images where md5(phonebook_id) = '$id'";
	$result_img = $pdo->prepare( $sql_img );
	$result_img->execute();

	$row_img = $result_img->fetch(PDO::FETCH_ASSOC);
	$image = $row_img['name'];

	$image_idd = $row_img['id'];
    $sql_del_img = "DELETE FROM t_images WHERE id = '$image_idd'";
    $query = $pdo->prepare($sql_del_img);
    $query->bindParam(':id', $image_idd, PDO::PARAM_INT);   
    $query->execute();

	unlink("uploads/$image");
	
	$sqlEm = "DELETE b FROM t_phonebook_det a INNER JOIN t_email b ON a.id = b.phonebook_id WHERE md5(a.id) = '$id'";
	$stmtE = $pdo->prepare($sqlEm);
	$stmtE->bindParam('$id', $_POST['id'], PDO::PARAM_INT);   
	$stmtE->execute();
	
	$sql = "DELETE a, b FROM t_phonebook_det a INNER JOIN t_phonebook_more_numbers b ON a.id = b.phonebook_id WHERE md5(a.id) = '$id'";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam('$id', $_POST['id'], PDO::PARAM_INT);   
	$stmt->execute();
		
	if($stmt->execute()){?>
		<script>alert('Sucessfully deleted data');</script>
		<script>window.location='maintenance.php';</script>
		<?php
	}else{
		echo "Oppps something error ";
	}
	$pdo = null;
?>