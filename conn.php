<?php
session_start();

//set timezone
date_default_timezone_set('Europe/Belgrade');

	//DB configuration Constants
	define('_HOST_NAME_', 'localhost'); //define('DBHOST','localhost');
	define('_USER_NAME_', 'root'); //define('DBUSER','root');
	define('_DB_PASSWORD', 'mck1'); //define('DBPASS','mck1');
	define('_DATABASE_NAME_', 'address'); //define('DBNAME','phonebook');
	
	//application address
define('DIR','localhost/sample/');
define('SITEEMAIL','');
	
	//PDO Database Connection
	try {
		$pdo = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	} 
	catch (PDOException $e)
	{
		$error = 'Unable to connect to the database server.';
		include 'error.html.php';
		//exit();
	}
//include the user class, pass in the database connection
include('classes/user.php');
$user = new User($pdo); 
?>