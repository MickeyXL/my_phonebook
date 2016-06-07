<?php
session_start();

if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')){
	//header('location:header.php');
	exit();
}

$session_id = $_SESSION['id']; 
$session_id = $_SESSION['username']; 
$session_id = $_SESSION['first_name'];
$session_id = $_SESSION['last_name'];


?>