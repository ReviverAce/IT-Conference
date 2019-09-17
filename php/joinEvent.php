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
				
			//===
			
				
					
						
						$EVENTID=$_GET['EVENTID'];
						$USERID=$_SESSION['ID'];
						$pass=true;
											
									//already registered?
						$result=$connection->query("SELECT * FROM EVENTS_USERS WHERE USERID='$USERID' AND EVENTID='$EVENTID'");
						$count=$result->num_rows;
						
				if($count>0)
				{
					$pass=false;
					$_SESSION['e_event']="You are already registered for this event!";
				}
					else{
						
						//science ?
						$result=$connection->query("SELECT SCIENCE FROM EVENTS WHERE EVENTID='$EVENTID'");
						$row=$result->fetch_assoc();
						$science=$row['SCIENCE'];
						
						if($science==0){
							$result=$connection->query("SELECT * FROM EVENTS_USERS EU,EVENTS E WHERE E.SCIENCE=1 AND EU.USERID='$USERID' AND EU.EVENTID=E.EVENTID");
							$count=$result->num_rows;
						
								if($count==0){
									$pass=false;
									$_SESSION['e_event']="To join no science event You must be registered to at least one science event!";
								}
						}		
			}
			
				//all good
				if($pass){
					if ($connection->query("INSERT INTO EVENTS_USERS VALUES(NULL,'$EVENTID','$USERID')"))
						{
							$TOTALCOST=$_SESSION['TOTALCOST'];
							$result=$connection->query("SELECT COST FROM EVENTS WHERE EVENTID='$EVENTID'");
							$row=$result->fetch_assoc();
							$EVENTCOST=$row['COST'];
							$NEW_TOTALCOST=$EVENTCOST+$TOTALCOST;
							$_SESSION['TOTALCOST']=$NEW_TOTALCOST;
							$connection->query("UPDATE USERS SET TOTALCOST='$NEW_TOTALCOST' WHERE USERID='$USERID'");
							$_SESSION['g_event']="You have joined new event!";
							ECHO "WIN";
						}
						else
						{
							throw new Exception($connection->error);
						}
				}
			$connection->close();
			//===
			
		}
		}
			catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo '<br />Dev info: '.$e;
		}
	
	header('Location: eventTrackPage.php');

?>