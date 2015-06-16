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
    
    if(isset($_POST['src'])){
        $src = $_POST['src'];
        $query = "DELETE FROM photos WHERE src='$src'";
        $result = $mysqli->query($query);
        if(!$result){
            die($mysqli->error);
        }
        unlink($src);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Photos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="adminstyle.css" type="text/css">
    </head>
    <body style="background-color: #ffffff">
        <div class="back">
            <a href="adminpanel.php">Back</a>
        </div>
        <div class="upload">
            <a href="upload.php">Upload image</a>
        </div>
            <div class="gallery">
                <?php
                    $query = "SELECT * FROM photos ORDER BY date DESC";
                    $result = $mysqli->query($query);
                    
                    $rows = $result->num_rows;
                    
                    for($i = 0; $i < $rows; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_array(MYSQLI_NUM);
                        
                        echo "<h4>$row[2]<h4>";
                        echo "<img src='$row[0]' title='$row[1]'>";
                        echo "<p>$row[3]</p>";
                        echo "<form action='admingallery.php' method='post'>";
                        echo "<input type='hidden' value='$row[0]' name='src'>";
                        echo "<input type='submit' value='Delete' name='delete'>";
                        echo "</form>";
                    }
                
                ?>
            </div>
        </div>
    </body>
</html>
<?php
    $mysqli->close();
?>