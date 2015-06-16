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
			$result->close();
		}
		function checkDuplicate($testedCell, $columnNameFromSql, $tableName){
			$query = "SELECT $columnNameFromSql FROM $tableName 
						WHERE $columnNameFromSql='$testedCell'";
			$result = $this->querySqli($query);
			if(!$result)
				die($this->inClassSqli->error);
			$row = $result->fetch_row();
			$result->close();
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
			$result->close();
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
	class players{
		function createNewPlayer($playerName, $sqliDatabase){
			$query = "INSERT INTO characters VALUES('$playerName', '100', '100', 
					'5', '5', '5', '5', '0', '1')";
			$sqliDatabase->querySqli($query);
		}
		function fetchPlayerData($playerName ,$sqliDatabase){
			$query = "SELECT * FROM characters WHERE charname='$playerName'";
			$result = $sqliDatabase->querySqli($query);
			
			if($result){
				return $result->fetch_array(MYSQLI_ASSOC);
				$result->close();
			}
			else{
				die();
			}
		}
		function isAlive($playerName, $sqliDatabase){
			$query = "SELECT life FROM characters WHERE charname='$playerName'";
			$result = $sqliDatabase->querySqli($query);
			$row = $result->fetch_row();
			$result->close();
			
			if($row[0] > 0 )
				return true;
			else
				return false;
		}
	}
?>
