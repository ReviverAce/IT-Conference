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
		<?php
			if(isset($_SESSION['g_eventDeleted'])){
					echo '<div style="text-align:center; margin:0; padding:0; height:0;"><span style="color:green;">'.$_SESSION['g_eventDeleted'].'</span></div>';
					unset($_SESSION['g_eventDeleted']);
				}
					?>
					<?php
			if(isset($_SESSION['g_eventChanged'])){
					echo '<div style="text-align:center; margin:0; padding:0; height:0;"><span style="color:green;">'.$_SESSION['g_eventChanged'].'</span></div>';
					unset($_SESSION['g_eventChanged']);
				}
					?>
	
	</header>
	
	<main>
		
		<div id="searcher">
			<form method="post" >
			<div class="searcherAtr">
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
						
						$result=@$connection->query('SELECT DISTINCT CATEGORY FROM EVENTS');
						
						echo "		Category:";
						echo '<select class="selectUsers" name="category">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['CATEGORY'].'">'.$row['CATEGORY'].'</option>';
						}
						echo "  </select>";
						
						$result=@$connection->query('SELECT DISTINCT COST FROM EVENTS');
						
						echo "		Cost:";
						echo '<select class="selectUsers" name="cost">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['COST'].'">'.$row['COST'].'</option>';
						}
						echo "  </select>";
						
						$result=@$connection->query('SELECT DISTINCT AUTHORID FROM EVENTS');
						
						echo "		AuthorID:";
						echo '<select class="selectUsers" name="authorID">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['AUTHORID'].'">'.$row['AUTHORID'].'</option>';
						}
						echo "  </select>";
						
						echo "		Science:";
						echo '<select class="selectUsers" name="science">';
						echo '<option value="Any">Any</option>';
						echo '<option value="Yes">Yes</option>';	
						echo '<option value="No">No</option>';		
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
			<a href="addNewEventPage.php" style="color:#03d4ea;">Add new event</a>
			</div>
		</form>
	</div>
	<div style="clear:both"></div>
	
	<?php
	//options
	if(isset($_POST['name'])){
	$name=$_POST['name'];
	$category=$_POST['category'];
	$cost=$_POST['cost'];
	$authorID=$_POST['authorID'];
	$science=$_POST['science'];

	$war="";
	
	if($name=="Any"){
		
	}
		else{
			$war="$war AND NAME='$name'";
		}
		
		if($category=="Any"){
		
	}
		else{
			$war="$war AND category='$category'";
		}
		
		if($cost=="Any"){
		
	}
		else{
			$war="$war AND cost='$cost'";
		}
		
		if($authorID=="Any"){
		
	}
		else{
			$war="$war AND authorID='$authorID'";
		}
		
		if($science=="Any"){
		
	}
		else if($science=="Yes"){
			$war="$war AND SCIENCE=1";
		}else{
			$war="$war AND SCIENCE=0";
		}
		
	}
		
		//echo $war;
	?>
	
	<?php
	try 
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{                                                                                                                                                                                                
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
						$result=@$connection->query("SELECT *  FROM EVENTS WHERE 1=1 $war ");
						
echo<<<END
<table style="width:90%">
							<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Time start</th> 
							<th>Time end</th> 
							<th>Category</th>
							<th>Cost</th>						
							<th>Science</th>						
							<th>AuthorID</th>
							<th>Text</th>
							<th>Edit</th>
							<th>Delete</th>
							</tr>
END;
						
						for($p=0;$p<$result->num_rows;$p++){
							$row = $result->fetch_assoc();	
							echo "<tr>";
							echo "<td>".$row['EVENTID']."</td>";
							$ID=$row['EVENTID'];
							echo "<td>".$row['NAME']."</td>";
							echo "<td>".$row['TIMESTART']."</td>";
							echo "<td>".$row['TIMEEND']."</td>";
							echo "<td>".$row['CATEGORY']."</td>";
							echo "<td>".$row['COST']."</td>";
							if($row['SCIENCE']==1)
							echo "<td>YES</td>";
							else
							echo "<td>NO</td>";
							echo "<td>".$row['AUTHORID']."</td>";
							echo "<td>".$row['TEXT']."</td>";
							echo "<td><a href='editEventPage.php?ID=$ID';>".'<span style="color:yellow;">EDIT</span><a/></td>';
							echo "<td><a href='deleteEvent.php?ID=$ID';>".'<span style="color:red;">DELETE</span><a/></td>';
							echo "</tr>";
						}
						
						echo "</table>";
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