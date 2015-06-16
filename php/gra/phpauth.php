<!DOCTYPE html>
<?php
	include_once 'login.php';
	include_once 'functions.php';
	
	if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
		$unTmp = sanitizeMysql($_SERVER['PHP_AUTH_USER'], $sqli);
		$pwTmp = sanitizeMysql($_SERVER['PHP_AUTH_PW'], $sqli);
		
		$query = "SELECT * FROM users WHERE username='$unTmp'";
		$result = query($query, $sqli);
		
		if($result){
			$row = $result->fetch_array(MYSQLI_NUM);
			
			$result->close();
			
			$pass = hashPass($pwTmp);
			
			if($pass == $row[3])
				echo "You are now logged in as $row[1]";
			else
				die("Invalid username/password combination!");
		}
		else
			die("Invalid username/password combination!");
	}
	else{
		header('WWW-Authenticate: Basic realm="Restricted Section"');
		header('HTTP/1.0 401 Unauthorized');
		die("Enter your username and password.");
	}
	$sqli->close();
?>
