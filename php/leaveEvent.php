<?php

	session_start();
	
	if (!isset($_SESSION['loggedIn']))
	{
		header('Location: loginPage.php');
		exit();
	}
	
		try 
		{
					require_once "connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
					
					
						
						//ECHO "ID: ".$_GET['EVENTID'];
						$EVENTID=$_GET['EVENTID'];
						//ECHO "Cost: ".$_GET['EVENTCOST'];
						$COST=$_GET['EVENTCOST'];
				
						$NEW_TOTALCOST=$_SESSION['TOTALCOST']-$COST;
					//	ECHO $NEW_TOTALCOST;
						$USERID=$_SESSION['ID'];
						//ECHO $USERID;
						
						
					if ($connection->query("UPDATE USERS SET TOTALCOST='$NEW_TOTALCOST' WHERE USERID='$USERID'"))
					{
						ECHO "WIN";
					}
					else
					{
						throw new Exception($connection->error);
					}
					
					if ($connection->query("DELETE FROM EVENTS_USERS WHERE EVENTID='$EVENTID' AND USERID='$USERID'"))
					{
						ECHO "WIN";
					}
					else
					{
						throw new Exception($connection->error);
					}
				
				
				$connection->close();
			}
			
		}
			catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
	
	header('Location: loggedInPage.php');

?>