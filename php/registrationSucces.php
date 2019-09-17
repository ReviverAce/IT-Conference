<?php

	session_start();
	
	if (!isset($_SESSION['registrationSuccesfull']))
	{
	header('Location: registrationPage.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationSuccesfull']);
	}
	
	//Usuwanie zmiennych pamiêtaj¹cych wartoœci wpisane do formularza
	if (isset($_SESSION['fr_name'])) unset($_SESSION['fr_name']);
	if (isset($_SESSION['fr_surrname'])) unset($_SESSION['fr_surrname']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	
	//Usuwanie b³êdów rejestracji
	if (isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
	if (isset($_SESSION['e_surrname'])) unset($_SESSION['e_surrname']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	
	
?>

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Warsaw IT Scientific Conference</title>
	<meta name="description" content="Biggest IT conference in Warsaw! Meet with best developers around the world! Register now!">
	<meta name="keywords" content="Science,Technology,IT,Conference">
	<meta name="author" content="MikoÅ‚aj Kapturowski">
	
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
	
		<h1 class="logo">Warsaw IT Conference </h1>
		
		<nav id="topnav">
		
			<ul class="menu">
				<li><a href="registrationPage.php">Registration</a></li>
				<li><a href="loginPage.php">Log in</a></li>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="../index.php#contact">Contact us</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
	
		<div id="login" style="text-align:center">
		<?php
		
		if(isset($_SESSION['changePersonalSuccesfull'])){
echo<<<END
	<h2 style="color: #efefef;">Your personal data was successfully changed! <br /><br />
	You must log in again </br></br>
	</h2>
	
END;
			unset($_SESSION['changePersonalSuccesfull']);
	
	session_unset();
	
		}else{
echo<<<END
	<h2 style="color: #efefef;">Thank you for joining our event! <br /><br />
	Check your UserID on email address <br /><br />
	</h2>
END;
		}
		
		?>
	</div>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Miko³aj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>
</body>
</html>