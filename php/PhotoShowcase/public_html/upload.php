<?php
    session_start();
    include_once 'database.php';
    include_once 'functions.php';
    $mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
    if($mysqli->connect_error){
        die("Error connecting: ". $mysqli->connect_error);
    }
    if($_SESSION['authenticated']==0){
        header('Location: login.php');
        die();
    }
    //UPLOADING IMAGE
    if(isset($_POST['submit'])){
        $imageDir ='img/';
        //$imageDir = getcwd().'/img/';
        $imageName = $imageDir.basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
        $checkIfImage = getimagesize($_FILES['image']['tmp_name']);
        if($checkIfImage !== false){
            if(file_exists($imageName)){
                echo "File exists!";
                $uploadOk = 0;
            }
            elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != 'bmp'){
                echo "Wrong img format!(jpeg,png,jpg,gif,bmp)";
                $uploadOk = 0;
            }
            $uploadOk = 1;
        }
        else{
            $uploadOk = 0;
        }
        if($uploadOk){
            move_uploaded_file($_FILES['image']['tmp_name'], $imageName);
            $title = $mysqli->real_escape_string($_POST['title']);
            $description = $mysqli->real_escape_string($_POST['description']);
            $query = "INSERT INTO photos VALUES('$imageName', '$title', CURRENT_DATE(), '$description')";
            $result = $mysqli->query($query);
            if(!$result){
                die("Failed to query!".$mysqli->error);
            }
            echo "File uploaded!";
        }
        else{
            echo "Failed to upload!";
        }           
    }
    
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Photos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body style="background-color: #ffffff">
        <div class="back">
            <a href="adminpanel.php">Back</a>
        </div>
        <div class="showGallery">
            <a href="admingallery.php">Show gallery</a>
        </div>
        <div class="upload">
            <p></p> 
            <form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validateUpload(this)">
                <input type="file" name="image" required="required"><br>
                Picture title:<input type="text" maxlength="32" name="title" required="required"><br>
                Description: <textarea name="description" cols="40" rows="10" maxlength="512"></textarea>
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
    </body>
</html>
<?php
    $mysqli->close();
?>