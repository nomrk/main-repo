<?php
	include_once 'login.php';
	include_once 'classes.php';
	include_once 'functions.php';
	
	session_start();
	$sqli = new sqliDatabase($db_hostname, $db_username, $db_password, $db_database);
	$player = new players($sqli);
	
	if(isset($_SESSION['username'])){
		if($_SESSION['ip'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'])){
			$username = $_SESSION['username'];	
			echo "Welcome back $username!";
			echo "<br>";
	
			if(isset($_GET['logout'])){
				if($_GET['logout']){
					session_destroy();
					header('Location: main.php');
					die();
				}
			}
			if(isset($_GET['player'])){
				$playerInfo = $player->fetchPlayerData($username, $sqli);
				$playerChoice = $_GET['player'];
				switch($playerChoice){
					case 1:
						echo "Life: ";
						echo $playerInfo['life'];
						echo "<br>";
						break;
					case 2:
						echo $playerInfo['mana'];
						break;
					case 3:
						echo $playerInfo['level'];
						break;
					case 4:
						echo $playerInfo['experience'];
						break;
					case 5:
						echo $playerInfo['strength'];
						echo $playerInfo['dexterity'];
						echo $playerInfo['vitality'];
						echo $playerInfo['intelligence'];
						break;
					default:
						echo "Fiddler eh?!";
						die();
				}
			}
			echo "<br><br><br>Do player live ? ".$player->isAlive($username, $sqli);
		}
		else
			die("IP address doesn't match");
	}
	else{
		echo "You must be logged in to view this page <a href='main.php'>Click here to login!</a>";
		die();
	}
	$sqli->closeSqli();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Session active</title>
	</head>
	<body>
		<a href="continue.php?player=1">fetch health</a>
		<a href="continue.php?player=2">fetch mana</a>
		<a href="continue.php?player=3">fetch level</a>
		<a href="continue.php?player=4">fetch experience</a>
		<a href="continue.php?player=5">fetch stats</a>
		<a href="continue.php?logout=1">Logout</a>
	</body>
</html>
