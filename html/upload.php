<?php
	$imgDir = "img/";
	$uploadedImg = $imgDir.basename($_FILES["fileToUpload"]["name"]);
	$imgOk = true;
	
	$imgFileType = pathinfo($uploadedImg, PATHINFO_EXTENSTION);
	
	if(isset($_POST['submit']){
		$check = getimagesize($_FILES['fileToUpload']['tmpName']);
		if($check !== false)
			$imgOk = true;
		else
			$imgOk = false;
	}
	
	
?>
