<?php

	session_start();
	
	if (isset($_POST['password1']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//oldPass
		
		$passwordOld=$_POST['passwordOld'];
		
		//Sprawdź poprawność hasła
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		$_SESSION['fr_passwordOld'] = $passwordOld;
		
		if ((strlen($password1)<8) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Password must contains from 8 to 20 signs!";
		}
		
		if ($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Passwords are not similar!";
		}	
		
		
		$USERID=$_SESSION['ID'];
		
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
				//pass correct?
				$result = $connection->query("SELECT PASSWORD FROM USERS WHERE USERID='$USERID'");
				
				if (!$result) throw new Exception($connection->error);
				
				$row = $result->fetch_assoc();
				if($row['PASSWORD']!=$passwordOld)
				{
					$wszystko_OK=false;
					$_SESSION['e_passwordOld']="Old password is not correct!";
				}		
				
				if ($wszystko_OK==true)
				{
					//everything is ok
					if ($connection->query("UPDATE USERS SET PASSWORD='$password1' WHERE USERID='$USERID'"))
					{
						$_SESSION['registrationSuccesfull']=true;
						$_SESSION['changePersonalSuccesfull']=true;
					}
					else
					{
						throw new Exception($connection->error);
					}
					header('Location: registrationSucces.php');
				}
				
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
		
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
			<div id="login" >
			<form method="post">
			
			Old Password: <br /> <input type="password"  value="<?php
			if (isset($_SESSION['fr_passwordOld']))
			{
				echo $_SESSION['fr_passwordOld'];
				unset($_SESSION['fr_passwordOld']);
			}
		?>" name="passwordOld" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_passwordOld']))
			{
				echo '<div class="error">'.$_SESSION['e_passwordOld'].'</div>';
				unset($_SESSION['e_passwordOld']);
			}
		?>	
	
		Password: <br /> <input type="password"  value="<?php
			if (isset($_SESSION['fr_password1']))
			{
				echo $_SESSION['fr_password1'];
				unset($_SESSION['fr_password1']);
			}
		?>" name="password1" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_password']))
			{
				echo '<div class="error">'.$_SESSION['e_password'].'</div>';
				unset($_SESSION['e_password']);
			}
		?>		
		
		Repeat password: <br /> <input type="password" value="<?php
			if (isset($_SESSION['fr_password2']))
			{
				echo $_SESSION['fr_password2'];
				unset($_SESSION['fr_password2']);
			}
		?>" name="password2" /><br />
		
		<br />
		
		<input type="submit" value="Apply changes" />
		</div>
	</form>
		
		</article>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>

</body>
</html>