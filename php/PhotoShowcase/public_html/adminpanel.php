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
    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: index.html');
        die();
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
        <div class="logout">
            <a href="adminpanel.php?logout=1">Logout</a>
        </div>
        <div class="showGallery">
            <a href="admingallery.php">Show gallery</a>
        </div>
        <div class="upload">
            <a href="upload.php">Upload image</a>
        </div>
    </body>
</html>
<?php
    $mysqli->close();
?>