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
				<li><a href="loggedInPage.php">My Account</a></li>
				<li><a href="logout.php">Log out</a></li>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="feedbackPage.php">Feedbacks</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
		
	<div id="login">
			<form method="post" action="sendFeedback.php">
			
			Event:
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
				$result=@$connection->query('SELECT DISTINCT NAME FROM EVENTS');
						
						echo '<select class="selectFeedback" name="event">';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
						}
						echo "  </select>";
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
			?>
			<br/><br/>
			Text:</br>
			<textarea name="eventText"></textarea>
			<br/>
			 <input type="checkbox" name="private">Visible only to author
			 <br/>
			<input type="submit" value="Send">
			
			
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