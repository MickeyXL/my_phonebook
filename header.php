<?php
require_once('conn.php');

echo '<h1>Phonebook</h1>
	<div class="right_header_content">
		<h3>';
echo 'Today is'.  '  '. date('d.m.Y') . ' - ' . date('l') . ' ' . date('h:i:s a') . '';
echo '</h3>';

	if(isset($_SESSION['username'])){
	//header('location:header.php');
	//exit();
	//	echo ;
		echo '
		<h4><a href="logout.php">Logout</a></h4>
		<h4><a href="profile.php">Profile</a></h4>
		<h4>
		'.$_SESSION['username'].' </h4>
		<h4>';
		
} else {
		echo '<h4><a href="login.php">Login</a></h4>';
		echo '<h4><a href="register.php">Register</a></h4>';
}
echo '</h4>
				
			</div>
			<hr style="clear:both;"/>';

?>
