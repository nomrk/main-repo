<?php
	//~ include_once 'login.php';
	include_once 'functions.php';
	
	class sqliDatabase{
		public $inClassSqli;
		function __construct($mysqlHostname, $mysqlUsername, 
							$mysqlPassword, $mysqlDatabase){
			$this->inClassSqli = new mysqli($mysqlHostname, $mysqlUsername, 
							$mysqlPassword, $mysqlDatabase);
			if($this->inClassSqli->connect_error)
				die($this->inClassSqli->connect_error);
		}
		//~ function __destruct(){
			//~ $this->inClassSqli->close();
		//~ }
		function querySqli($mysqlQuery){
			$result = $this->inClassSqli->query($mysqlQuery);
			if(!$result)
				die($this->inClassSqli->error);
			return $result;
		}
		function checkDuplicate($testedCell, $columnNameFromSql){
			$query = "SELECT $columnNameFromSql FROM users 
						WHERE $columnNameFromSql='$testedCell'";
			$result = $this->querySqli($query);
			if(!$result)
				die($this->inClassSqli->error);
			$row = $result->fetch_row();
			if(strtolower($testedCell) == strtolower($row[0]) )
				return true;
			else
				return false;
		}	
		function registerUser($username, $charname, $password){
			$lowUsername = strtolower($username);
			$query = "INSERT INTO users(username, charname, password) 
					VALUES('$lowUsername', '$charname', '$password')";
			$result = $this->querySqli($query);
			if(!$result)
				die($this->inClassSqli->error);	
		}
		function loginUser($username, $password){
			$inUser = strtolower($username);
			$inPass = hashPass($password);
			$query = "SELECT username, password FROM users WHERE username='$inUser'";
			$result = $this->querySqli($query);
			$row = $result->fetch_row();
			if($inPass == $row[1])
				return true;
			else
				return false;
		}
		function getPost($formInputName){
			return $this->sanitizeMysql($_POST[$formInputName]);
		}
		function sanitizeMysql($mysqlStringToSanitize){
			$mysqlStringToSanitize = $this->inClassSqli->real_escape_string($mysqlStringToSanitize);
			$sanitizedMysqlString = sanitizeString($mysqlStringToSanitize);
			return $sanitizedMysqlString;
		}
		function closeSqli(){
			$this->inClassSqli->close();
		}
	}
?>
