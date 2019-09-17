<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>Warsaw IT Scientific Conference</title>
	<meta name="description" content="Biggest IT conference in Warsaw! Meet with best developers around the world! Register now!">
	<meta name="keywords" content="Science,Technology,IT,Conference">
	<meta name="author" content="Mikołaj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="js/main.js"></script>
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
	echo '<li><a href="php/loggedInPage.php">My Account</a></li>';
	echo '<li><a href="php/logout.php">Log out</a></li>	';
	}else{
		echo '<li><a href="php/registrationPage.php">Registration</a></li>';
		echo '<li><a href="php/loginPage.php">Log in</a></li>';
	}
	
			?>
				<li><a href="index.php">Main Page</a></li>
				<li><a href="php/eventTrackPage.php">Track of event</a></li>
				<li><a href="php/feedbackPage.php">Feedbacks</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
	
		<article>
		
			<section>
			
				<div class="categories">
				
					<header>
					
						<h1>Welcome to the biggest IT event!</h1>
						<p>Are You intrested in IT ? Would You like to meet famous developers? Are You intrested in learning new technologies? 
						<br>If yes, join our IT event and enjoy the biggest IT conference in Warsaw! Register now!</p>
						
					</header>
					
					<div class="photo">
							<img src="img/conference1.jpg" alt="conference photo" height="185" width="300">
					</div>
					
					<div class="photo">
					<img src="img/conference2.jpg" alt="conference photo" height="185" width="300">
					</div>

					<div class="photo">
					<img src="img/conference3.jpg" alt="conference photo" height="185" width="300">
					</div>

					<div class="photo">
					<img src="img/conference4.jpg" alt="conference photo" height="185" width="300">
					</div>

					<div class="photo">
					<img src="img/conference5.jpg" alt="conference photo" height="185" width="300">
					</div>

					<div class="photo">
					<img src="img/conference6.jpg" alt="conference photo" height="185" width="300">
					</div>					

				</div>
				
			</section>
			
			<section id="planOfEvent">
				
				<div class="categories">
				
					<header>
					
						<h1 id="eventTrack">Meet famous people!</h1>
						<p>On our conference you can meet famous programmers and scientists around the world! Some of them are:</p>
						
					</header>	
					
					<div class="photo">
					
						<figure>
							<img src="img/f1.jpg" alt="conference photo" height="290" width="290">
							<figcaption>Steve jobs</figcaption>
						</figure>
					
					</div>
					
					<div class="photo">
					
						<figure>
							<img src="img/f2.jpg" alt="conference photo" height="290" width="290">
							<figcaption>Mark Zuckerberg</figcaption>
						</figure>
					
					</div>

					<div class="photo">
					
						<figure>
							<img src="img/f3.jpg" alt="conference photo" height="290" width="290">
							<figcaption>Linus Torvalds</figcaption>
						</figure>
					
					</div>

					<div class="photo">
					
						<figure>
							<img src="img/f7.jpg" alt="conference photo" height="290" width="290">
							<figcaption>Ken Thompson</figcaption>
						</figure>
					
					</div>

					<div class="photo">
					
						<figure>
							<img src="img/f6.jpg" alt="conference photo" height="290" width="290">
							<figcaption>maximillian cohen</figcaption>
						</figure>
					
					</div>

					<div class="photo">
					
						<figure>
							<img src="img/f5.jpg" alt="conference photo" height="290" width="290">
							<figcaption>Michio Kaku</figcaption>
						</figure>
					
					</div>				
					
					</div>
			</section>

			<section>
				
				<div class="contact">
				
					<header>
					
						<h1 id="contact">Contact us</h1>
						<p>If You have any further question or would like to perform in front of many other students, feel free to contact us! 
						<br> If You would like to participate and make presentation on the event contact us week before start of the event.
						<br><br> Contact us on email below:</p>
						
					</header>
					
					<a class="bluebutton">warsawitconference@gmail.com</a>
				
				</div>
				
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