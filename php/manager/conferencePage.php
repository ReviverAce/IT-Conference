<?php

	session_start();
	
	if (!(isset($_SESSION['ID'])) && ($_SESSION['ID']==15297))
	{
		header('Location: ../mainPage.php');
		exit();
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
	
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="../../js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
	<style>
	table, th, td {
		margin-left:auto;
		margin-right:auto;
		margin-bottom:50px;
    border: 1px solid black;
    border-collapse: collapse;
	   padding: 4px;
    background-color: #222222;
}
</style>
	
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
		
<div id="searcher">
			<form method="post" >
			<div class="searcherAtr" style="margin-left:35%;">
			<?php
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
						$result=@$connection->query('SELECT DISTINCT NAME FROM EVENTS ');
						
						echo "Name:";
						echo '<select class="selectUsers" name="name">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
						}
						echo "  </select>";
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo 'Dev info: '.$e;
		}
			?>
			<input id="submitUsers" style="width:100px; padding:0; font-size:18px; margin-left:10px; margin-right:40px;" type="submit" value="Send">
			</div>
		</form>
	</div>
	<div style="clear:both"></div>
	
		<?php
	//options
	if(isset($_POST['name'])){
	$name=$_POST['name'];
	$war="";
	
	if($name=="Any"){
		
	}
		else{
			$war="$war AND NAME='$name'";
		}
		
	}
		
		//echo $war;
	?>
	
	
	<?php
	try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			$connection1 = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{                                                                                                                                                                                                
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
						$result=@$connection->query("SELECT *  FROM EVENTS WHERE 1=1 $war ");
												
						for($p=0;$p<$result->num_rows;$p++){
							$row = $result->fetch_assoc();	
							$ID=$row['EVENTID'];
							echo "<h2 style='margin-left:70px;'>".$row['NAME']."</h2></br>";
							
							//people
							
								$result1=@$connection1->query("SELECT U.USERID AS USERID,U.NAME ,U.SURRNAME,U.COUNTRY,U.EMAIL,U.INSTITUTION,U.AUTHOR,U.TOTALCOST FROM USERS U,EVENTS_USERS EU WHERE EU.USERID=U.USERID AND EU.EVENTID='$ID' ");
						
echo<<<END
<table style="width:90%">
							<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Surrname</th> 
							<th>Country</th> 
							<th>Email</th>
							<th>Institution</th>						
							<th>Author</th>						
							<th>Total cost</th>
							</tr>
END;
						
						for($p1=0;$p1<$result1->num_rows;$p1++){
							$row1 = $result1->fetch_assoc();	
							echo "<tr>";
							echo "<td>".$row1['USERID']."</td>";
							$ID=$row1['USERID'];
							echo "<td>".$row1['NAME']."</td>";
							echo "<td>".$row1['SURRNAME']."</td>";
							echo "<td>".$row1['COUNTRY']."</td>";
							echo "<td>".$row1['EMAIL']."</td>";
							echo "<td>".$row1['INSTITUTION']."</td>";
							if($row1['AUTHOR']==1)
							echo "<td>YES</td>";
							else
							echo "<td>NO</td>";
							echo "<td>".$row1['TOTALCOST']."</td>";
							echo "</tr>";
						}
						
						echo "</table>";
							
							
							
							
						}
				$connection->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Server error!</span>';
			echo 'Dev info: '.$e;
		}
	?>
		
	</main>
	

</body>
</html>