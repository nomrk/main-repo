<?php
	function sanitizeString($stringToSanitize){
		$stringToSanitize = stripslashes($stringToSanitize);
		$stringToSanitize = htmlentities($stringToSanitize);
		$sanitizedString = strip_tags($stringToSanitize);
		return $sanitizedString;
	}
	function hashPass($passToHash){
		$salt1 = "!d3o";
		$salt2 = "r282";
		$securePass = hash('ripemd128', "$salt1$passToHash$salt2");
		return $securePass;
	}
?>
