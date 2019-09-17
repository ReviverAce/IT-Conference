<?php

	session_start();
	
	if (!(isset($_SESSION['ID'])) && ($_SESSION['ID']==15297))
	{
		header('Location: ../mainPage.php');
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
	<meta name="author" content="MikoŁaj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="../../js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
</head>

<body>
	<header>
	
		<h1 class="logo">Managment </h1>
		
		<nav id="topnav">
		
			<ul class="menu" style="background-color:#00aa00;">
				<li><a href="../loggedInPage.php">My Account</a></li>
				<li><a href="eventsPage.php">Events</a></li>
				<li><a href="createNewAuthorPage.php">Create new author</a></li>
				<li><a href="usersPage.php">Users</a></li>
				<li><a href="conferencePage.php">Conference</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
		

	</main>
	

</body>
</html>