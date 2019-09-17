<?php

	session_start();
	
	if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true))
	{
		header('Location: loggedInPage.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Warsaw IT Scientific Conference</title>
	<meta name="description" content="Biggest IT conference in Warsaw! Meet with best developers around the world! Register now!">
	<meta name="keywords" content="Science,Technology,IT,Conference">
	<meta name="author" content="Mikołaj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="../js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
</head>

<body>

	<header>
	
		
		
		<nav id="topnav">
		
			<ul class="menu">
				<li><a href="registrationPage.php">Registration</a></li>
				<li><a href="loginPage.php">Log in</a></li>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="feedbackPage.php">Feedbacks</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
		
		<div id="login">
			<form method="post" action="login.php">
			
			UserId:
			<input type="text" name="login">
			<br/><br/>
			Password:
			<input type="password" name="password">
			<br/><br/>
			<input type="submit" value="Login">
			
			
					<div style="text-align:center; padding-top:15px;">
					
					<?php
				if(isset($_SESSION['error'])){
					echo $_SESSION['error'];
					unset($_SESSION['error']);
				}
					?>
					</div>
		</form>
	</div>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>

</body>
</html>