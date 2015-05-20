<?php
/////////////////////////////////////////////////////
//			input cleaners                         //
/////////////////////////////////////////////////////
	function sanitizeString($var){
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}
	function sanitizeMysql($var, $sqli){
		$var = $sqli->real_escape_string($var);
		$var = sanitizeString($var);
		return $var;
	}
////////////////////////////////////////////////////
//SQL HELPER FUNCTIONS
////////////////////////////////////////////////////
	function query($var, $sqli){
		$result = $sqli->query($var);
		if(!$result)
			die($sqli->error);
		else
			return $result;
	}
	function addUser($un, $chn, $pw, $sqli){
		$username = strtolower($un);

		$query = "INSERT INTO users(username, charname, password) 
					VALUES('$username', '$chn', '$pw')";
		$result = $sqli->query($query);
		if(!$result)
			die($sqli->error);
			
	}
	function loginUser($username, $password, $sqli){
		$inUser = strtolower($username);
		$inPass = hashPass($password);
		$query = "SELECT username, password FROM users WHERE username='$inUser'";
		$result = query($query, $sqli);
		$row = $result->fetch_row();
		if($inPass == $row[1])
			return true;
		else
			return false;
	}
	function getPost($var, $sqli){
		return sanitizeMysql($_POST[$var], $sqli);
	}
	function hashPass($var){
		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$secuPass = hash('ripemd128', "$salt1$var$salt2");
		return $secuPass;
	}
	function checkDup($var, $sqlvar, $sqli){
		$query = "SELECT $sqlvar FROM users WHERE $sqlvar='$var'";
		$result = query($query, $sqli);
		$row = $result->fetch_row();
		//~ echo $row[0]; //debug
		if(strtolower($var) == strtolower($row[0]) )
			return true;
		else
			return false;
	}
	
	//~ function destroySessionAndData(){
		//~ $_SESSION = array();
		//~ setcookie(session_name(), '', time() - 2592000, '/');
		//~ session_destroy();
	//~ }
?>
