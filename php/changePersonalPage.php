<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność imienia
		$name = $_POST['name'];
		
		if (ctype_alnum($name)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Name contains forbidden signs!";
		}
		
			if(strlen($name)<1){
			$wszystko_OK=false;
			$_SESSION['e_name']="Name must contain single character!";
		}
		
		//Sprawdź poprawność nazwiska
		$surrname = $_POST['surrname'];
		
		if (ctype_alnum($surrname)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_surrname']="Surrname contains forbidden signs!";
		}
		
		if(strlen($surrname)<1){
			$wszystko_OK=false;
			$_SESSION['e_surrname']="Surrname must contain single character!";
		}
		
		//Sprawdź poprawność kraju
		$country = $_POST['country'];
		
		
		
		if(strlen($country)<1){
			$wszystko_OK=false;
			$_SESSION['e_country']="Country must contain single character!";
		}
		
		//Sprawdź poprawność instytutu
		$institution = $_POST['institution'];
	
		
		if(strlen($institution)<1){
			$wszystko_OK=false;
			$_SESSION['e_institution']="Institution must contain single character!";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Insert correct email address!";
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
				//email exists?
				$result = $connection->query("SELECT USERID FROM USERS WHERE EMAIL='$email' AND NOT USERID='$USERID'");
				
				if (!$result) throw new Exception($connection->error);
				
				$mail_count = $result->num_rows;
				if($mail_count>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="This email was already registered!";
				}		
				
				if ($wszystko_OK==true)
				{
					//everything is ok
					if ($connection->query("UPDATE USERS SET NAME='$name',SURRNAME='$surrname',COUNTRY='$country', EMAIL='$email', INSTITUTION='$institution' WHERE USERID='$USERID'"))
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
	
		Name: <br /> <input type="text" value="<?php
				echo $_SESSION['NAME'];
			
		?>" name="name" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_name']))
			{
				echo '<div class="error">'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
		?>
		
		Surrname: <br /> <input type="text" value="<?php
		echo $_SESSION['SURRNAME'];
		?>" name="surrname" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_surrname']))
			{
				echo '<div class="error">'.$_SESSION['e_surrname'].'</div>';
				unset($_SESSION['e_surrname']);
			}
		?>
		
		Country: <br /> <input type="text" value="<?php
			echo $_SESSION['COUNTRY'];
		?>" name="country" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_country']))
			{
				echo '<div class="error">'.$_SESSION['e_country'].'</div>';
				unset($_SESSION['e_country']);
			}
		?>
		
		Institution: <br /> <input type="text" value="<?php
			echo $_SESSION['INSTITUTION'];
		?>" name="institution" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_institution']))
			{
				echo '<div class="error">'.$_SESSION['e_institution'].'</div>';
				unset($_SESSION['e_institution']);
			}
		?>
		
		E-mail: <br /> <input type="text" value="<?php
			echo $_SESSION['EMAIL'];
		?>" name="email" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
		
		<div style="text-align:center;"><p><a href="changePasswordPage.php" style="text-decoration:none; color:#00dd00; text-align:center;">Change password</a></p></div>
		
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