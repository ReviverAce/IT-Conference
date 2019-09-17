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
			
				//all good
				$EVENTID=$_POST['event'];
				$TEXT=$_POST['eventText'];
				$PRIVATE;
				$ID=$_SESSION['ID'];
				
				if(isset($_POST['private']))
					$PRIVATE=1;
				ELSE
					$PRIVATE=0;
	
				//echo $EVENTID;
				//echo $TEXT;
				//echo $PRIVATE;
				//echo  $ID;
					$result=$connection->query("SELECT EVENTID FROM EVENTS WHERE NAME='$EVENTID'");
					$row=$result->fetch_assoc();
					$EVENT=$row['EVENTID'];
						if ($connection->query("INSERT INTO FEEDBACK VALUES(NULL,'$TEXT','$ID','$PRIVATE','$EVENT')"))
						{
							$_SESSION['g_feedback']="New feedback added!";
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
		header('Location: feedbackPage.php');

?>