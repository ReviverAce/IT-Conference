<?php

	session_start();
	
	if (!(isset($_SESSION['ID'])) && ($_SESSION['ID']==15297))
	{
		header('Location: ../mainPage.php');
		exit();
	}
	
				
		if(isset($_POST['name'])){
					//Zapamiętaj wprowadzone dane
		$_SESSION['fr_name'] = $_POST['name'];
		$_SESSION['fr_timeStart'] = $_POST['timeStart'];
		$_SESSION['fr_timeEnd'] = $_POST['timeEnd'];
		$_SESSION['fr_category'] = $_POST['category'];
		$_SESSION['fr_cost'] = $_POST['cost'];
		$_SESSION['fr_authorID'] = $_POST['authorID'];
		$_SESSION['fr_text'] = $_POST['text'];
				
		//validation
		if (isset($_POST['name']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność imienia
		$name = $_POST['name'];
		
			if(strlen($name)<1){
			$wszystko_OK=false;
			$_SESSION['e_name']="Name must contain single character!";
		}
		
		//Sprawdź poprawność czasu
		$timeStart = $_POST['timeStart'];
		
		//if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $timeStart))
		//{
			//$wszystko_OK=false;
			//$_SESSION['e_timeStart']="Time is in bad format!";
		//}
		
		$timeEnd = $_POST['timeEnd'];
		
		//if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $timeEnd))
		//{
			//$wszystko_OK=false;
			//$_SESSION['e_timeEnd']="Time is in bad format!";
		//}
		
		
		//Sprawdź kategorie
		$category = $_POST['category'];
		
		
		if(strlen($category)<1){
			$wszystko_OK=false;
			$_SESSION['e_category']="Category must contain single character!";
		}
		
		//Sprawdź koszt
		$cost = $_POST['cost'];
		
		
		//if(preg_match("/[0-9][0-9].[0-9][0-9]/", $cost)){
			//$wszystko_OK=false;
			//$_SESSION['e_cost']="Cost is in invalid format!";
		//}
		
		// Sprawdź poprawność autora
		$authorID = $_POST['authorID'];
						require_once "../connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
			$result = $connection->query("SELECT USERID FROM USERS WHERE USERID='$authorID' AND AUTHOR=1");
				
				if (!$result) throw new Exception($connection->error);
			$mail_count = $result->num_rows;
				if($mail_count>0)
				{

				}else{
						$wszystko_OK=false;
					$_SESSION['e_authorID']="There is no Author with this ID!";
				}
		
		
		$text=$_POST['text'];
			//Czy science
		if (!isset($_POST['science']))
		{
			$science=0;
		}else{
			$science=1;
		}
		
			//everything is ok
		
		try 
		{
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				if ($wszystko_OK==true)
				{
				
				if ($connection->query("INSERT INTO EVENTS VALUES(NULL,'$name','$timeStart','$timeEnd','$category','$science','$cost','$text','$authorID')"))
					{
							
							$_SESSION['registrationSuccesfull']=true;
							header('Location: newEventSucces.php');
					}
					else
					{
						throw new Exception($connection->error);
					}
					
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
		
	<article>
			<div id="login" style="background-color:#00aa00;" >
			<form method="post">
		Name: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_name']))
			{
				echo $_SESSION['fr_name'];
				unset($_SESSION['fr_name']);
			}
		?>" name="name" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_name']))
			{
				echo '<div class="error">'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
		?>
		
		Time start: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_timeStart']))
			{
				echo $_SESSION['fr_timeStart'];
				unset($_SESSION['fr_timeStart']);
			}
		?>" name="timeStart" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_timeStart']))
			{
				echo '<div class="error">'.$_SESSION['e_timeStart'].'</div>';
				unset($_SESSION['e_timeStart']);
			}
		?>
		
		Time end: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_timeEnd']))
			{
				echo $_SESSION['fr_timeEnd'];
				unset($_SESSION['fr_timeEnd']);
			}
		?>" name="timeEnd" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_timeEnd']))
			{
				echo '<div class="error">'.$_SESSION['e_timeEnd'].'</div>';
				unset($_SESSION['e_timeEnd']);
			}
		?>
		
		Category: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_category']))
			{
				echo $_SESSION['fr_category'];
				unset($_SESSION['fr_category']);
			}
		?>" name="category" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_category']))
			{
				echo '<div class="error">'.$_SESSION['e_category'].'</div>';
				unset($_SESSION['e_category']);
			}
		?>
		
		Science: <input type="checkbox" value="" name="science" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_science']))
			{
				echo '<div class="error">'.$_SESSION['e_science'].'</div>';
				unset($_SESSION['e_science']);
			}
		?>
		
		Cost: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_cost']))
			{
				echo $_SESSION['fr_cost'];
				unset($_SESSION['fr_cost']);
			}
		?>" name="cost" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_cost']))
			{
				echo '<div class="error">'.$_SESSION['e_cost'].'</div>';
				unset($_SESSION['e_cost']);
			}
		?>
		
		Text: <br /> <textarea type="text" value="" name="text" /><?php
			if (isset($_SESSION['fr_text']))
			{
				echo $_SESSION['fr_text'];
				unset($_SESSION['fr_text']);
			}
		?></textarea><br /><br>
		
		<?php
			if (isset($_SESSION['e_text']))
			{
				echo '<div class="error">'.$_SESSION['e_text'].'</div>';
				unset($_SESSION['e_text']);
			}
		?>
		
		AuthorID: <br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_authorID']))
			{
				echo $_SESSION['fr_authorID'];
				unset($_SESSION['fr_authorID']);
			}
		?>" name="authorID" /><br /><br>
		
		<?php
			if (isset($_SESSION['e_authorID']))
			{
				echo '<div class="error">'.$_SESSION['e_authorID'].'</div>';
				unset($_SESSION['e_authorID']);
			}
		?>
		
		
		<br />
		
		<input type="submit" value="Apply changes" />
		</div>
	</form>
		
		</article>

	</main>
	

</body>
</html>