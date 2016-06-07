<?php
	header("Content-type: image/jpeg");
	include("conn.php");
	$id = $_GET['id'];
	$file ="uploads/";
	$image = mysql_query("SELECT * FROM t_images WHERE id = $id");
	$image = mysql_fetch_assoc($image);
	$image = stripslashes($image['name']);
	echo $file."".$image;
?>