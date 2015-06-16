<!DOCTYPE html>
<?php
	include_once 'functions.php';
	
	$f = $c = '';
	if(isset($_POST['f']))
		$f = sanitizeString($_POST['f']);
	if(isset($_POST['c']))
		$c = sanitizeString($_POST['c']);
	
	if($f != ''){
		$c = intval((5/9)*($f-32));
		$out = "$f F equals $c C";
	}
	elseif($c != ''){
		$f = intval((9/5)*($c+32));
		$out = "$c C equals $f F";
	}
	else
		$out = '';
	
	echo <<<EOT
<html>
	<head>
	<title>Temp. Converter</title>
	</head>
	<body>
		<pre>
			Enter either farenheit or celcius
			<b>$out</b>
			<form action="convert.php" method="post">
				Farenheit <input type="text" name="f" size="7" maxlength="3">
				Celcius <input type="text" name="c" size="7" maxlength="3">
				<input type="submit" value="Convert">
			</form>
		</pre>
	</body>
</html>	
EOT;

?>
