<?php
include('conn.php'); 

$username = $_SESSION['username']; 
/*
$log_user = "SELECT t_user.id FROM t_user WHERE t_user.username = '".$_SESSION['username']."'";
					$userIDD = $pdo->query($log_user);
					
print_r($userIDD);
*/
if($pdo){
 $log_user = "SELECT id, first_name, last_name, rol FROM t_user WHERE username= '".$_SESSION['username']."'";    
			   $userIDD = $pdo->query($log_user);

while ($row = $userIDD->fetch()){
					$user_data[] = $row;
				}}
				
				foreach ($user_data as $user_loged) { 
							
								$userID = $user_loged['id']; 
								$first_name = $user_loged['first_name'];
								$last_name = $user_loged['last_name'];
								$rol = $user_loged['rol'];
								 }

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//include header template
//require('header.php'); 
?>

<!DOCTYPE html>
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
			
			<div class="content">			
				<?php
				//disable magic quotes-SECURITY
				if (get_magic_quotes_gpc()){
					$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
					while (list($key, $val) = each($process)){
						foreach ($val as $k => $v){
							unset($process[$key][$k]);
							if (is_array($v)){
								$process[$key][stripslashes($k)] = $v;
								$process[] = &$process[$key][stripslashes($k)];
							}
							else{
								$process[$key][stripslashes($k)] = stripslashes($v);
							}
						}
					}
					unset($process);
				}
				//OTVARA FORMU ZA UPNOS
				if (isset($_GET['addnumber'])){
					include 'form.html.php';
					exit();
				}
				//include 'conn.php';
				//UPIS PODATAKA U TABELU
				if (isset($_POST['name'])){
					try{
						$sql = 'INSERT INTO t_phonebook_det SET
						name = :name,
						surname = :surname,
						address = :address,
						title = :title,
						useradded = :useradded,
						dateadded = :dateadded';
						$s = $pdo->prepare($sql);
						$s->bindValue(':name', $_POST['name']);
						$s->bindValue(':surname', $_POST['surname']);
						$s->bindValue(':address', $_POST['address']);
						$s->bindValue(':title', $_POST['title']);
						$s->bindValue(':useradded', $_POST['useradded']);
						$s->bindValue(':dateadded', date("h:i:sa"));
						$s->execute();
						//$insert_id = $pdo->lastInsertId();
			
						$sql = 'INSERT INTO t_phonebook_more_numbers SET
						phonebook_id = :phonebook_id,
						description = :description,
						phone_number = :phone_number';
						$s = $pdo->prepare($sql);
						$s->bindValue(':phonebook_id', $pdo->lastInsertId());
						$s->bindValue(':description', $_POST['description']);
						$s->bindValue(':phone_number', $_POST['phone_number']);
						$s->execute();
					}
					catch (PDOException $e){
						$error = 'Error adding number: ' . $e->getMessage();
						include 'error.html.php';
						exit();
					}
					header('Location: .');
					exit();
				}
				//PRIKAZ UNETIH PODATAKA U TABELI
				try{
					switch ($rol) {
						case "User":
							$sql = "SELECT DISTINCT id, name, surname, address, title
							FROM t_phonebook_det WHERE useradded = '$userID'";
							$result = $pdo->query($sql);
							$row = array();
						break;
						case "Administrator":
							$sql = "SELECT DISTINCT id, name, surname, address, title
							FROM t_phonebook_det";
							$result = $pdo->query($sql);
							$row = array();
						break;

					}
					$recent_posts = "SELECT * FROM t_phonebook_det WHERE useradded = '$userID' ORDER BY id DESC LIMIT 5";
					$result_rec = $pdo->query($recent_posts);

				}
				catch (PDOException $e){
					$error = 'Error fetching number: ' . $e->getMessage();
					include 'error.html.php';
					exit();
				}
				while ($row = $result->fetch()){
					$names[] = $row;	
				}
				include 'names.html.php';
				?>
			</div>
			<div class="aside">
				<?php 
					while ($row_rec = $result_rec->fetch())
					{
						$rec_names[] = $row_rec;	
					}
					include 'latest.php';
				?>
			</div>
		</div>
		
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>