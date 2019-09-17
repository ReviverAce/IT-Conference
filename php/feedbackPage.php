

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Warsaw IT Scientific Conference</title>
	<meta name="description" content="Biggest IT conference in Warsaw! Meet with best developers around the world! Register now!">
	<meta name="keywords" content="Science,Technology,IT,Conference">
	<meta name="author" content="MikoĹ‚aj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="../css/main.css?rev=1">
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
			<?php

	session_start();
	
	if (isset($_SESSION['loggedIn']))
	{
	echo '<li><a href="loggedInPage.php">My Account</a></li>';
	echo '<li><a href="logout.php">Log out</a></li>	';
	}else{
		echo '<li><a href="registrationPage.php">Registration</a></li>';
		echo '<li><a href="loginPage.php">Log in</a></li>';
	}
	
			?>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="feedbackPage.php">Feedbacks</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
		
	<section id="newest">
				
				<div class="entries">
				
					<header>
					
						<h1>Feedbacks</h1>
						<p>Here You can see all feedbacks left from register users! In order to write feedback You must be logged in.</p>
						<?php
						if (isset($_SESSION['AUTHOR']) && $_SESSION['AUTHOR']==1)
					{
							echo '<h2><a href="authorFeedbackPage.php" style="text-decoration:none; Color:#00aa00;">See your private feedbacks<a></h2>';
					}else if (isset($_SESSION['loggedIn']))
					{
							echo '<h2><a href="writeFeedbackPage.php" style="text-decoration:none; Color:#00aa00;">Write your own feedback!</a></h2>';
					}
					
						?>
						
						<?php
						if(isset($_SESSION['g_feedback'])){
							echo '</br><span style="color:green;">'.$_SESSION['g_feedback'].'</span>';
							unset($_SESSION['g_feedback']);
						}
						?>
						
					</header>	
					
					<?php
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{                                                                                                                                                                                                
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result=@$connection->query('SELECT F.TEXT ,E.NAME AS ENAME ,U.NAME AS UNAME , U.SURRNAME FROM  FEEDBACK F,EVENTS E,USERS U WHERE PRIVATE=0 AND F.AUTHORID=U.USERID AND F.EVENTID=E.EVENTID ORDER BY F.FEEDBACKID DESC');
						
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
									echo '<div class="entry"><div class="entrytxt">';
							echo'<h2>'.$row['UNAME'].' '.$row['SURRNAME'].' : '.$row['ENAME'].'</h2>';
							echo '<p>'.$row['TEXT'].'</p>';
						echo '</div></div>';
									
						}
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
?>
									
				</div>
				
			</section>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>
</body>
</html>