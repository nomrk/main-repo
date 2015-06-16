<?php
    function sanitizeString($stringToSanitize){
	$stringToSanitize = stripslashes($stringToSanitize);
	$stringToSanitize = htmlentities($stringToSanitize);
	$sanitizedString = strip_tags($stringToSanitize);
	return $sanitizedString;
    }
?>