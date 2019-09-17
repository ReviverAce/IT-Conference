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
	
	<link rel="stylesheet" href="../../css/main.css?rev=1">
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
			if(isset($_SESSION['g_userDeleted'])){
					echo '<div style="text-align:center; margin:0; padding:0; height:0;"><span style="color:green;">'.$_SESSION['g_userDeleted'].'</span></div>';
					unset($_SESSION['g_userDeleted']);
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
						$result=@$connection->query('SELECT DISTINCT NAME FROM USERS WHERE NOT USERID=15297');
						
						echo "Name:";
						echo '<select class="selectUsers" name="name">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
						}
						echo "  </select>";
						
						$result=@$connection->query('SELECT DISTINCT SURRNAME FROM USERS WHERE NOT USERID=15297');
						
						echo "		Surrname:";
						echo '<select class="selectUsers" name="surrname">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['SURRNAME'].'">'.$row['SURRNAME'].'</option>';
						}
						echo "  </select>";
						
						$result=@$connection->query('SELECT DISTINCT COUNTRY FROM USERS WHERE NOT USERID=15297');
						
						echo "		Country:";
						echo '<select class="selectUsers" name="country">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['COUNTRY'].'">'.$row['COUNTRY'].'</option>';
						}
						echo "  </select>";
						
						$result=@$connection->query('SELECT DISTINCT INSTITUTION FROM USERS WHERE NOT USERID=15297');
						
						echo "		Institution:";
						echo '<select class="selectUsers" name="institution">';
						echo '<option value="Any">Any</option>';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['INSTITUTION'].'">'.$row['INSTITUTION'].'</option>';
						}
						echo "  </select>";
						
						echo "		Author:";
						echo '<select class="selectUsers" name="author">';
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
			<input id="submitUsers" style="width:100px; padding:0; font-size:18px; margin-left:10px;" type="submit" value="Send">
			</div>
		</form>
	</div>
	<div style="clear:both"></div>
	
	<?php
	//options
	if(isset($_POST['name'])){
	$name=$_POST['name'];
	$surrname=$_POST['surrname'];
	$country=$_POST['country'];
	$institution=$_POST['institution'];
	$author=$_POST['author'];

	$war="";
	
	if($name=="Any"){
		
	}
		else{
			$war="$war AND NAME='$name'";
		}
		
		if($surrname=="Any"){
		
	}
		else{
			$war="$war AND SURRNAME='$surrname'";
		}
		
		if($country=="Any"){
		
	}
		else{
			$war="$war AND COUNTRY='$country'";
		}
		
		if($institution=="Any"){
		
	}
		else{
			$war="$war AND INSTITUTION='$institution'";
		}
		
		if($author=="Any"){
		
	}
		else if($author=="Yes"){
			$war="$war AND AUTHOR=1";
		}else{
			$war="$war AND AUTHOR=0";
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
						$result=@$connection->query("SELECT *  FROM USERS WHERE NOT USERID=15297 $war ");
						
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
							<th>Delete</th>
							</tr>
END;
						
						for($p=0;$p<$result->num_rows;$p++){
							$row = $result->fetch_assoc();	
							echo "<tr>";
							echo "<td>".$row['USERID']."</td>";
							$ID=$row['USERID'];
							echo "<td>".$row['NAME']."</td>";
							echo "<td>".$row['SURRNAME']."</td>";
							echo "<td>".$row['COUNTRY']."</td>";
							echo "<td>".$row['EMAIL']."</td>";
							echo "<td>".$row['INSTITUTION']."</td>";
							if($row['AUTHOR']==1)
							echo "<td>YES</td>";
							else
							echo "<td>NO</td>";
							echo "<td>".$row['TOTALCOST']."</td>";
							echo "<td><a href='deleteUser.php?ID=$ID';>".'<span style="color:red;">DELETE</span><a/></td>';
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