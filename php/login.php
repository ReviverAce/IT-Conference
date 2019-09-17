<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: loginPage.php');
		exit();
	}

	require_once "connect.php";

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($result = @$connection->query(
		sprintf("SELECT * FROM USERS WHERE USERID='%s'",
		mysqli_real_escape_string($connection,$login))))
		{
			$ilu_userow = $result->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $result->fetch_assoc();
					//weryfikacja hashowanego hasla
				if(password_verify($password,$wiersz['PASSWORD'])|| $password==$wiersz['PASSWORD']){
					
					$_SESSION['loggedIn'] = true;			
					$_SESSION['ID']=$wiersz['USERID'];
					$_SESSION['NAME'] = $wiersz['NAME'];
					$_SESSION['SURRNAME'] = $wiersz['SURRNAME'];
					$_SESSION['COUNTRY'] = $wiersz['COUNTRY'];
					$_SESSION['EMAIL'] = $wiersz['EMAIL'];
					$_SESSION['INSTITUTION'] = $wiersz['INSTITUTION'];
					$_SESSION['AUTHOR'] = $wiersz['AUTHOR'];
					$_SESSION['TOTALCOST'] = $wiersz['TOTALCOST'];
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: loggedInPage.php');

				}else {
				
					$_SESSION['error'] = '<span style="color:red">Incorrect login or password!</span>';
					header('Location: loginPage.php');
					
				}

				
			} else {
				
				$_SESSION['error'] = '<span style="color:red">Incorrect login or password!</span>';
				header('Location: loginPage.php');
				
			}
			
		}
		
		$connection->close();
	}
	
?>