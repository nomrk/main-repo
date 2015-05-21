<?php
	session_start();
	
	if(isset($_SESSION['username'])){
		if($_SESSION['ip'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'])){
			$username = $_SESSION['username'];	
			echo "Welcome back $username!";
	
			if(isset($_GET['logout']))
				if($_GET['logout']){
					session_destroy();
					header('Location: main.php');
					die();
				}
		}
		else
			die("IP address doesn't match");
	}
	else{
		echo "You must be logged in to view this page <a href='main.php'>Click here to login!</a>";
		die();
	}
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
