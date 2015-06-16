<?php
	if(isset($_POST['url'])){
	echo file_get_contents('http://' . sanitizeString($_POST['url']));
	}
	
	function sanitizeString($string){
		$string = strip_tags($string);
		$string = htmlentities($string);
		$string = stripslashes($string);
		return $string;
	}
