<?php

	session_start();
	
	if (!isset($_SESSION['loggedIn']))
	{
	header('Location: loginPage.php');
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
	
		<h1 class="logo">Warsaw IT Conference </h1>
		
		<nav id="topnav">
		
			<ul class="menu">
				<li><a href="loggedInPage.php">My Account</a></li>
				<li><a href="logout.php">Log out</a></li>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="../index.php#contact">Contact us</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
	
		<div id="login" style="text-align:center">
		
		<?php
		
		require_once "connect.php";
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		$EVENTID=$_GET['EVENTID'];
		$result=$connection->query("select NAME,PATH from files where EVENTID='$EVENTID'");
		
		if($result->num_rows !=0){

		for($p=0;$p<$result->num_rows;$p++){
			$row=$result->fetch_assoc();
			echo "<p>";
			echo $row['NAME']."  - ";
			echo "<a href=../".$row['PATH'].">download</a></p>";
		}
		
		}else{
			echo "There are no files concerning this event";
		}
		echo "</br></br><a href='eventTrackPage.php'".'style="text-decoration:none;"><span style="color:#00ff00;"> Return to event page</span></a>';
?>
		
	</div>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>
</body>
</html>