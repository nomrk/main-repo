<?php
	require_once 'login.php';
	require_once 'functions.php';
	require_once 'classes.php';
	
	$sqli = new sqliDatabase($db_hostname, $db_username, $db_password, $db_database);
	$player = new players($sqli);
	
	if(isset($_POST['regusername']) && isset($_POST['regcharname']) &&
				isset($_POST['regpassword'])){
		$username = $sqli->getPost('regusername');
		$charname = $sqli->getPost('regcharname');
		$password = hashPass($sqli->getPost('regpassword'));
		
		if(!$sqli->checkDuplicate($username, 'username', 'users')){
			if(!$sqli->checkDuplicate($charname, 'charname', 'users')){
				$sqli->registerUser($username, $charname, $password);
				$player->createNewPlayer($username, $sqli);
			}
			else
				echo "Character name taken!";
		}
		else
			echo "Username taken!";
	}
	
	if(isset($_POST['logusername']) && isset($_POST['logpassword'])){
		$username = $sqli->getPost('logusername');
		$password = $sqli->getPost('logpassword');
		
		if($sqli->loginUser($username, $password)){
			session_start();
			$_SESSION['ip'] = hash('ripemd128', $_SERVER['REMOTE_ADDR']);
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header('Location: continue.php');
			die();
			//~ echo "You are logged in as $username. Welcome!";
		}
		else
			echo "Failed to login!";
	}
	
	$sqli->closeSqli();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Main</title>
	</head>
	<body>
		<form action="main.php" method="post">
			Username: <input type="text" name="regusername" maxlength="16" size="10"  required="required">
			<br>
			Charname: <input type="text" name="regcharname" maxlength="16" size="10" required="required">
			<br>
			Password: <input type="password" name="regpassword" maxlength="16" size="10" required="required">
			<br>
			<input type="submit" value="Register">
			<br>
		</form>
		<form action="main.php" method="post">
			Username: <input type="text" name="logusername" maxlength="16" size="10" required="required">
			<br>
			Password: <input type="password" name="logpassword" maxlength="16" size="10" required="required">
			<br>
			<input type="submit" value="Log in">
			<br>
		</form>
	</body>
</html>
