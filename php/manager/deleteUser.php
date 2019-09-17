<?php

	session_start();
	
	if (!(isset($_SESSION['ID'])) && ($_SESSION['ID']==15297))
	{
		header('Location: ../mainPage.php');
		exit();
	}
	
		try 
		{
					require_once "../connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
					$ID=$_GET['ID'];	
						
					if ($connection->query("DELETE FROM EVENTS_USERS WHERE USERID='$ID'"))
					{
						ECHO "WIN";
					}
					else
					{
						throw new Exception($connection->error);
					}
					
					if ($connection->query("DELETE FROM FEEDBACK WHERE AUTHORID='$ID'"))
					{
						ECHO "WIN";
					}
					else
					{
						throw new Exception($connection->error);
					}
					
					if ($connection->query("DELETE FROM USERS WHERE USERID='$ID'"))
					{
						ECHO "WIN";
					}
					else
					{
						throw new Exception($connection->error);
					}
				
				$_SESSION['g_eventDeleted']="User deleted!";
				
				$connection->close();
			}
			
		}
			catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
	
	header('Location: eventsPage.php');

?>