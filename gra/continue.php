<?php


	session_start();
	
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		
		echo "Welcome back $username!";
		
		if(isset($_GET['logout']))
			if($_GET['logout']){
				//~ destroySessionAndData();
				session_destroy();
				header('Location: loginuser.php');
				die();
			}
	}
	else
		echo "You must be logged in to view this page <a href='loginuser.php'>Click here to login!</a>";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Session active</title>
	</head>
	<body>
		<a href="continue.php?logout=1">Logout</a>
	</body>
</html>
