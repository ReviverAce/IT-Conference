<?php

	session_start();
	
	if (!isset($_SESSION['loggedIn']) && $_SESSION['AUTHOR']==0)
	{
	header('Location: loginPage.php');
		exit();
	}
?>

<?php

if(isset($_POST['submit'])){
$file=$_FILES['file'];
$fileName=$_FILES['file']['name'];
$fileTmpName=$_FILES['file']['tmp_name'];
$fileSize=$_FILES['file']['size'];
$fileError=$_FILES['file']['error'];
$fileType=$_FILES['file']['type'];

$fileExt=explode('.',$fileName);
$fileActualExt=strtolower(end($fileExt));

$allowed=array('jpg','pdf','txt','rar','ppt');

if(in_array($fileActualExt,$allowed)){
	if($fileError==0){
		if($fileSize < 1000000){
			$fileNameNew=$fileName;
			
			$fileDestination= '../files/'.$fileNameNew;
			move_uploaded_file($fileTmpName,$fileDestination);
			$_SESSION['success']="Your file was uploaded!";
			
			//instert record in db
		require_once "connect.php";
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
				$NAME=$_POST['name'];
				$PATH="../WEB/files/".$fileName;
				$EVENTNAME=$_POST['event'];
				$result=$connection->query("SELECT EVENTID FROM EVENTS WHERE NAME='$EVENTNAME'");
				$row=$result->fetch_assoc();
				$EVENTID=$row['EVENTID'];
				if ($connection->query("INSERT INTO FILES VALUES ('$NAME','$PATH','$EVENTID')"))
					{
						$_SESSION['registrationSuccesfull']=true;
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
			echo '<br />Dev info: '.$e;
			$_SESSION['error']="File with this name already exists!";
		}
			
			
		}else{
				$_SESSION['error']="Your file is too big..";
		}
		
	}else{
			$_SESSION['error']="There was an error uploading your file.";
	}
}else{
	$_SESSION['error']="You cannot upload files of this type.";
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
	<meta name="author" content="Mikołaj Kapturowski">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script src="../js/main.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
</head>

<body>
	<header>
	
		<h1 class="logo">Warsaw IT Conference </h1>
		
		<nav id="topnav">
		
			<ul class="menu">
				<li><a href="loggedInPage.php">My Account</a></li>
				<li><a href="logout.php">Log out</a></li>
				<li><a href="../index.php">Main Page</a></li>
				<li><a href="eventTrackPage.php">Track of event</a></li>
				<li><a href="../index.php#contact">Contact us</a></li>
			</ul>
			
		</nav>
	
	</header>
	
	<main>
	
		<div id="login" style="text-align:center">
	
		
	<form method="post" enctype="multipart/form-data">
	<?php
		if(isset($_SESSION['error'])){
			echo '<div class="error">'.$_SESSION['error'].'</div>';
				unset($_SESSION['error']);
				echo "</br>";
		}
		
		if(isset($_SESSION['success'])){
			echo '<div class="error" style="color:#00aa00;">'.$_SESSION['success'].'</div>';
				unset($_SESSION['success']);
				echo "</br>";
		}
		require_once "connect.php";
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		$AUTHORID=$_SESSION['ID'];
		$result=$connection->query("select NAME from EVENTS where AUTHORID='$AUTHORID'");
		
		echo "Event:";
						echo '<select class="selectUsers" name="event">';
						for($p=0;$p<$result->num_rows;$p++){
									$row = $result->fetch_assoc();	
								echo '<option value="'.$row['NAME'].'">'.$row['NAME'].'</option>';
						}
						echo "  </select>";
		
?>	
	</br>
	</br>
		<input type="file" name="file" id="file" >
	</br>
	</br>
	Description:<input type="text" name="name">
			<br/><br/>
		<input type="submit" value="Upload File" name="submit">
	</form>
		
	</div>
	
	</main>
	
	<footer>
		
		<div class="info">
			All rights reserved &copy; Mikołaj Kapturowski 2018 Thank you for visiting!
		</div>
	
	</footer>
</body>
</html>