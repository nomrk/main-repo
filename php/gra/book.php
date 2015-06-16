<!DOCTYPE html>
<?php
	require_once 'login.php';
	
	function getPost($var, $sqlibase){
		return $sqlibase->real_escape_string($_POST[$var]);
	}
	
	$gamebase = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	
	if($gamebase->connect_error)
		die($gamebase->connect_error);
	
	if(isset($_POST['delete']) && isset($_POST['id'])){
		$id = getPost('id', $gamebase);
		$result = $gamebase->query("DELETE FROM users WHERE id='$id'");
		if(!$result)
			echo "Failed to delete entry!" .$gamebase->error."<br><br>";
	}
	
	if(isset($_POST['username']) && isset($_POST['charname']) && isset($_POST['password'])){
		$username = getPost('username', $gamebase);
		$charname = getPost('charname', $gamebase);
		$password = getPost('password', $gamebase);
		
		$result = $gamebase->query("INSERT INTO users(username, charname, password) VALUES('$username', '$charname', '$password')");
		
		if(!$result)
			echo "Failed to insert into table!".$gamebase->error."<br><br>";
	}
	
	echo <<<EOT
	<form action="book.php" method="post">
		<pre>
Username:       <input type="text" name="username">
Character name: <input type="text" name="charname">
Password:       <input type="password" name="password">
<input type="submit" value="Register">
		</pre>
	</form>
EOT;
	
	$result = $gamebase->query("SELECT * FROM users");
	
	for($i = 0; $i < $result->num_rows; ++$i){
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQL_ASSOC);
		echo <<<EOD
		<pre>
Username:       $row[username]
Character name: $row[charname]
</pre>
<form action="book.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[id]">
<input type="submit" value="Delete">
</form>
EOD;
	}
	$result->close();
	$gamebase->close();
?>
