<?php

	session_start();
	
	if (!(isset($_SESSION['ID'])) && ($_SESSION['ID']==15297))
	{
		header('Location: ../mainPage.php');
		exit();
	}
	
	//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		if(isset($_POST['userid'])){
		$userid = $_POST['userid'];	
		
		//Sprawdź poprawność hasła
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		if ((strlen($password1)<8) || (strlen($password1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password1']="Password must contains from 8 to 20 signs!";
		}
		
		if ($password1!=$password2)
		{
			$wszystko_OK=false;
			$_SESSION['e_password1']="Passwords are not similar!";
		}

		$_SESSION['fr_userid'] = $userid;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		
				
		require_once "../connect.php";
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
				//user exists?
				$result = $connection->query("SELECT USERID FROM USERS WHERE USERID='$userid'");
				
				if (!$result) throw new Exception($connection->error);
				
				$user_count = $result->num_rows;
				if($user_count>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_userid']="This ID already exists !";
				}
				
				if ($wszystko_OK==true)
				{
					if ($connection->query("INSERT INTO USERS VALUES ($userid,'userName','userSurrname','userCountry', 'userMail', 'userInstitution', '$password1', 1, 0)"))
					{
						$_SESSION['registrationSuccesfull']=true;
					}
					else
					{
						throw new Exception($connection->error);
					}
					header('Location: newAuthorSucces.php');
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
		
		<div id="login" style="background-color:#00aa00; ">
			<form method="post" >
			
			UserID: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_userid']))
			{
				echo $_SESSION['fr_userid'];
				unset($_SESSION['fr_userid']);
			}
		?>" name="userid" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_userid']))
			{
				echo '<div class="error">'.$_SESSION['e_userid'].'</div>';
				unset($_SESSION['e_userid']);
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
			if (isset($_SESSION['e_password1']))
			{
				echo '<div class="error">'.$_SESSION['e_password1'].'</div>';
				unset($_SESSION['e_password1']);
			}
		?>		
		
		Repeat password: <br /> <input type="password" value="<?php
			if (isset($_SESSION['fr_password2']))
			{
				echo $_SESSION['fr_password2'];
				unset($_SESSION['fr_password2']);
			}
		?>" name="password2" /><br /><br />
		
			<input type="submit" value="Create">
			
		</form>
	</div>

	</main>
	

</body>
</html>