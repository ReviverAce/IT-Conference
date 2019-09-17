<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Warsaw IT Scientific Conference</title>
	<meta name="description" content="Biggest IT conference in Warsaw! Meet with best developers around the world! Register now!">
	<meta name="keywords" content="Science,Technology,IT,Conference">
	<meta name="author" content="Mikołaj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="../css/main.css?rev=1">
	<link rel="stylesheet" href="../css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="../js/main.js?rev=1" type="text/javascript"></script>
	

	
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
	
		<article>
			
			<section id="planOfEvent">
				
				<div class="entries">
				
					<header>
					
						<h1 id="eventTrack">Track of event</h1>
						<p>Here You can track our main event and many other interesting events happening in the same time!</p>
						<p>If You want to learn more about the event, click on it's name!</p>
				
						<?php 
							if(isset($_SESSION['loggedIn']))
							echo'<p>Join events that You are intrested in!</p>';
							else
							echo "<p>In order to join our events or view event files, You have to log in first !<p>";
						?>
						
							<?php
				if(isset($_SESSION['e_event'])){
					echo '<span style="color:red;">'.$_SESSION['e_event'].'</span>';
					unset($_SESSION['e_event']);
				}
					?>
					
					<?php
				if(isset($_SESSION['g_event'])){
					echo '<span style="color:green;">'.$_SESSION['g_event'].'</span>';
					unset($_SESSION['g_event']);
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
				echo '<div class="eventList"><h3>Main track</h3>';
				$result=@$connection->query('select eventid,events.name as ename,timestart,timeend,science,cost,text,users.name as uname,surrname from EVENTS,users where authorid=userid and category="main track" order by timestart');
						
						echo '<ul class="events">';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
									$text=$row['text'];
									$EVENTID=$row['eventid'];
									echo '<li >'.$row["timestart"].'-'.$row["timeend"].': <span style="color: #39a5f1;">';
									echo '<a onclick="displayTextMain'."('$text')".'">';
									echo $row["ename"].'</a></span></br>';
									echo ' Author: <span style="color: #39a5f1;">'.$row['uname'].' '.$row['surrname'].'</span>';
									echo ' Cost: <span style="color: #39a5f1;"> '.$row['cost'].' €</span></br>';
									echo "<a href='joinEvent.php?EVENTID=$EVENTID'".' style="text-decoration:none;"><span style="color:#00aa00;">Join event</span></a>';
									echo " : ";
									echo "<a href='eventFilesPage.php?EVENTID=$EVENTID'".' style="text-decoration:none;"><span style="color:#00aa00;">event files</span></a>';
									 if(!$row['science'])echo " <span style='color:#ffff00;'>Not science event </span>";
							
									echo '</li></br>';
						}
ECHO<<<END
</ul></div>
<div class="eventDescription">
					</div>
					<div style="clear:both; border-bottom: 3px dashed #0a2b42; padding-top:20px;" ></div>
					
					<div class="eventList">
					<h3>Satelite events</h3>
					
					<ul class="events">	
				
END;

			$result=@$connection->query('select distinct category from events where not category="main track"');
			
				for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
									echo '<li><h2>'.$row['category'].'</h2><ul>';
									$category=$row['category'];
									$result1=@$connection->query("select eventid,events.name as ename,timestart,timeend,science,cost,text,users.name as uname,surrname from EVENTS,users where authorid=userid and category='$category' order by timestart");
										for($b=0;$b<$result1->num_rows;$b++){
											$row = $result1->fetch_assoc();	
											$text=$row['text'];
									echo '<li >'.$row["timestart"].'-'.$row["timeend"].': <span style="color: #39a5f1;">';
									echo '<a onclick="displayTextSatelite'."('$text')".'">';
									echo $row["ename"].'</a></span></br>';
									$EVENTID=$row['eventid'];
									echo ' Author: <span style="color: #39a5f1;">'.$row['uname'].' '.$row['surrname'].'</span>';
									echo ' Cost: <span style="color: #39a5f1;"> '.$row['cost'].' €</span></br>';
									echo "<a href='joinEvent.php?EVENTID=$EVENTID'".' style="text-decoration:none;"><span style="color:#00aa00;">Join event</span></a>';
									echo " : ";
									echo "<a href='eventFilesPage.php?EVENTID=$EVENTID'".' style="text-decoration:none;"><span style="color:#00aa00;">event files</span></a>';
									if(!$row['science'])echo " <span style='color:#ffff00;'>Not science event </span>";
									
									echo '</li></br>';
										}
									echo '</ul></li>';
						}
ECHO<<<END
					</ul>
					</div>
					<div class="eventDescription" ></div>
					<div style="clear:both;"></div>
END;
					
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
?>
					
				
			</section>	
		
		</article>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>

</body>
</html>