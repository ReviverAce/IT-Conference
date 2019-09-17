<?php

	session_start();
	
if (!isset($_SESSION['registrationSuccesfull']))
	{
	header('Location: managerPage.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationSuccesfull']);
	}
	
//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_name'])) unset($_SESSION['fr_name']);
	if (isset($_SESSION['fr_timeStart'])) unset($_SESSION['fr_timeStart']);
	if (isset($_SESSION['fr_timeEnd'])) unset($_SESSION['fr_timeEnd']);
	if (isset($_SESSION['fr_category'])) unset($_SESSION['fr_category']);
	if (isset($_SESSION['fr_cost'])) unset($_SESSION['fr_cost']);
	if (isset($_SESSION['fr_text'])) unset($_SESSION['fr_text']);
	if (isset($_SESSION['fr_authorID'])) unset($_SESSION['fr_authorID']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
	if (isset($_SESSION['e_timeStart'])) unset($_SESSION['e_timeStart']);
	if (isset($_SESSION['e_timeEnd'])) unset($_SESSION['e_timeEnd']);
	if (isset($_SESSION['e_category'])) unset($_SESSION['e_category']);
	if (isset($_SESSION['e_cost'])) unset($_SESSION['e_cost']);
	if (isset($_SESSION['e_text'])) unset($_SESSION['e_text']);
	if (isset($_SESSION['e_authorID'])) unset($_SESSION['e_authorID']);
	
	
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
	
	<link rel="stylesheet" href="../../css/main.css">
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
		
		<div id="login" style="text-align:center; background-color:#00aa00;">
	<h2 style="color: #efefef;">New Event added!<br /><br />
	</h2>
	</div>
	
	</main>
</body>
</html>