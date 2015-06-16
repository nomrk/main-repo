<!--
   index.php
   
   Copyright 2015 mrk <mrk@noname>
   
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   MA 02110-1301, USA.
   
   
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PHP</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.24.1" />
</head>

<body>
	<form method="post" action="index.php" enctype="multipart/form-data">
	Select file: <input type="file" name="filename" size="10">
	<input type="submit" value="Upload">
	</form>
	
	<?php
		
		if($_FILES){
			$name = $_FILES["filename"]["name"];
			switch($_FILES["filename"]["type"]){
				case 'image/jpeg': 
					$ext = 'jpg' ; 
					break;
				case 'image/gif' : 
					$ext = 'gif' ; 
					break;
				case 'image/png' : 
					$ext = 'png' ; 
					break;
				case 'image/tiff': 
					$ext = 'tiff'; 
					break;
				default: 
					$ext = ''; 
					break;
			}
			
			if($ext){
				$n = "image.$ext";
				move_uploaded_file($_FILES['filename']['tmp_name'], $n);
				echo "Uploaded image '$name' as '$n':<br>";
				echo "<img src='$n'>";
			}
			else 
				echo "Error uploading!";
		}
		else 
			echo "No file uploaded.";
	?>
</body>

</html>
