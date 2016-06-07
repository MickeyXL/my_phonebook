<?php
	include 'conn.php';
	
	//$username = $_SESSION['username'];
	//$userID = $_SESSION['id'];
	//$first_name = $_SESSION['first_name'];
	//$last_name = $_SESSION['last_name'];
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
		<div id="body" class="about_result">
			<div class="bar">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="content">			
				<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, nihil, similique, harum eveniet praesentium quos eos quae sapiente adipisci nam ut tempora consectetur numquam exercitationem qui nisi deserunt obcaecati facere!</span>
				</br>
				<span>Nostrum, perspiciatis, placeat mollitia labore delectus dicta molestiae itaque natus at ipsum eos voluptatibus alias ut suscipit nemo neque eligendi maiores odit dolorem tempora. Voluptas, qui aliquam modi esse reiciendis?</span>
				</br>
				<span>Molestias, facere, doloremque, assumenda, tenetur est velit ab consequatur laborum fugit quae omnis sapiente ex minima unde maiores excepturi autem ea distinctio. Vero, quam, modi voluptate nobis iure exercitationem nesciunt.</span>
				</br>
				<span>Doloremque, numquam, itaque, quam qui ea id eum aliquam soluta quasi officia tenetur molestiae blanditiis excepturi totam commodi minus fuga architecto impedit corrupti explicabo porro nemo iusto est sapiente nostrum.</span>
				</br>
				<span>Autem, voluptas, reprehenderit, vitae, quasi est facilis sapiente beatae dignissimos quisquam delectus praesentium voluptatum nihil a labore doloremque necessitatibus sint nam culpa explicabo officiis unde incidunt quis sit rem eius!</span></p>
			</div>
			<div class="aside">
				<p>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, nobis, porro, nihil corrupti consequatur provident optio quos soluta nam molestias cumque voluptas perferendis eum error doloremque harum ea explicabo nostrum.</span>
					</br></br>
					<span>Rerum, iste, mollitia soluta quam laborum nobis debitis nulla nisi consectetur suscipit ipsum quisquam quis vero. Blanditiis, doloribus unde ad quas earum sapiente ex veritatis nihil perspiciatis numquam dolor inventore.</span>
					</br></br>
					<span>Earum, similique, commodi vitae assumenda blanditiis nobis alias consequuntur maxime ab odio voluptates sit ullam animi cupiditate eius incidunt illum sapiente distinctio debitis placeat doloribus quos soluta recusandae eos ex?</span>
				</p>
			</div>
		</div>
		
	</body>
	<footer class="footer-distributed">
		<?php include 'footer.php';
		?>
	</footer>
</html>