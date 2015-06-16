<?php
	require_once 'login.php';
	require_once 'functions.php';
	
	if(isset($_POST['username']) && isset($_POST['charname']) &&
				isset($_POST['password'])){
		$username = getPost('username', $sqli);
		$charname = getPost('charname', $sqli);
		$password = hashPass(getPost('password', $sqli));
		
		if(!checkDuplicate($username, 'username', $sqli)){
			if(!checkDuplicate($charname, 'charname', $sqli)){
				registerUser($username, $charname, $password, $sqli);
			}
			else
				echo "Character name taken!";
		}
		else
			echo "Username taken!";
	}
	
	$sqli->close();
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>More secure user add</title>
	</head>
	<body>
		<pre>
		<form action="setupuser.php" method="post">
Username: <input type="text" name="username" maxlength="16" size="10"  required="required">
Charname: <input type="text" name="charname" maxlength="16" size="10" required="required">
Password: <input type="password" name="password" maxlength="16" size="10" required="required">
<input type="submit" value="Register"><br>
		</form>
		</pre>
	</body>
</html>
