<!DOCTYPE HTML>
<?php
	//sql database stuff
	require_once 'login.php';
	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
	if(!$db_server)
		die(mysql_error());
	mysql_select_db($db_database) or die(mysql_error());
	
	if(isset($_POST['delete']) && isset($_POST['id'])){
		$id = get_post('id');
		$query = "DELETE FROM users WHERE id='$id'";
		
		if(!mysql_query($query, $db_server))
			echo "failed to delete".mysql_error();
	}
		
	if(isset($_POST['username']) && isset($_POST['charname']) && isset($_POST['password'])){
		$username = get_post('username');
		$charname = get_post('charname');
		$password = get_post('password');
		
		$query = "INSERT INTO users(username, charname, password) VALUE('$username', '$charname', '$password')";
		if(!mysql_query($query, $db_server))
			echo "Failed to insert data!".mysql_error();
	}
	
	echo <<<EOT
		<form action="sqltest.php" method="post">
			<pre>
Username: <input type="text" name='username'>
Charname: <input type="text" name='charname'>
Password: <input type="text" name='password'>
<input type="submit" value="ADD RECORD">
			</pre>
		</form>
EOT;
	$query = "SELECT * FROM users";
	$result = mysql_query($query, $db_server);
	if(!$result) die("ERROR" .mysql_error());
	$rows = mysql_num_rows($result);
	
	for($i = 0; $i < $rows; ++$i){
		$row = mysql_fetch_row($result);
	
		echo <<<EOT
		<pre>
Username:		 $row[1]
Character name:		 $row[2]
Password: 		 $row[3]
		</pre>
		<form action="sqltest.php" method="post">
		<input type="hidden" name="delete" value="yes">
		<input type="hidden" name="id" value="$row[0]">
		<input type="submit" value="DELETE RECORD">
		</form>
EOT;
	}	
	
	mysql_close($db_server);
	
	function get_post($var){
		return mysql_real_escape_string($_POST[$var]);
	}
?>
