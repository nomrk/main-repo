<!DOCTYPE html>
<html>
	<head>
		<title>Gra</title>
	</head>
	<body>
		<form action="testa.php" method="post">
			<input type="text" name="userinput">
			<input type="submit" value="Button">
			<a href="" value="asd" name="link">Link Test</a>
		</form>
<?php
	if(isset($_POST['userinput']))
		echo $_POST['userinput'];
	if(isset($_POST['link']))
		echo $_POST['link'];
?>
		
	</body>
</html>
