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
				<li><a href="feedbackPage.php">Feedbacks</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
	
		<article>
			
			<div id="login" style="width:500px; text-align:center">
			<?php
	echo "<p>Hello ".$_SESSION['NAME']." ! </br> You are logged in as : ";
		IF($_SESSION['AUTHOR']==false){
			echo "Partecipant</p>";
		}else{
			if($_SESSION['ID']==15297){
			echo "Manager </p>";
			echo '<a href="manager/managerPage.php" style="text-decoration:none; color:#00dd00;">Click here to manage the conference</a>';
			}
			else{
			echo "Author </p>";
			echo '<a href="authorFeedbackPage.php" style="text-decoration:none; color:#00dd00;">Click here to see your Private feedbacks</a></p>';
			echo '<a href="addFilesPage.php" style="text-decoration:none; color:#00dd00;">Click here to add files to your presentation</a>';
			}
		}
		echo '<p><a href="changePersonalPage.php" style="text-decoration:none; color:#00dd00;">Click here to change your personal data</a></p>';
		echo "Your personel data: </br>";
		echo "Name: ".$_SESSION['NAME']." ".$_SESSION['SURRNAME']."</br>";
		echo "Country: ".$_SESSION['COUNTRY']."</br>";
		echo "Institution: ".$_SESSION['INSTITUTION']."</br>";
		echo "<h4>Registered events</h4>";
		
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
					
					$result=@$connection->query("SELECT TOTALCOST FROM USERS WHERE USERID=".$_SESSION['ID']);
					$row = $result->fetch_assoc();
					$TOTALCOST=$row['TOTALCOST'];
					$_SESSION['TOTALCOST']=$TOTALCOST;
					echo "<table";
					if ($result=@$connection->query("SELECT E.EVENTID AS EVENTID,E.NAME,E.COST FROM events_users EU,EVENTS E WHERE EU.USERID=".$_SESSION['ID']." AND E.EVENTID=EU.EVENTID "))
					{
						for($p=0;$p<$result->num_rows;$p++){
							echo "<tr>";
								$row = $result->fetch_assoc();
							echo '<td>'.$row['NAME'].'</td><td>'." cost: ".$row['COST'].'</td>';
							$EVENTID=$row['EVENTID'];
							$EVENTCOST=$row['COST'];
							echo "<a href='leaveEvent.php?EVENTID=$EVENTID & EVENTCOST=$EVENTCOST'".' style="text-decoration:none;"><span style="color:#aa0000;"> <td>Leave event </td></span></a></p>';
							echo "</tr>";
						}
					}
					else
					{
						throw new Exception($connection->error);
					}
					echo "</table>";
						echo "Total cost: ".$TOTALCOST."</br>";
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
		
		</article>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>

</body>
</html>