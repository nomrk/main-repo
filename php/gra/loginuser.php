<?php
	require_once 'login.php';
	require_once 'functions.php';
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = getPost('username', $sqli);
		$password = getPost('password', $sqli);
		
		if(loginUser($username, $password, $sqli)){
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
	
	$sqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="loginuser.php" method="post">
		Username: <input type="text" name="username" maxlength="16" size="10" required="required"><br>
		Password: <input type="text" name="password" maxlength="16" size="10" required="required"><br>
		<input type="submit" value="Log in">		
	</form>
</body>
</html>
