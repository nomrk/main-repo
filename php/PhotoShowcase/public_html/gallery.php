<?php
    include_once 'database.php';
    
    $mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
    
    
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Photos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" type="text/css">
        <script src='javascript.js'></script>
    </head>
    <body>
        <div class="menu">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="gallery.php">Gallery</a>
            <a href="login.php">Login</a>
        </div>
        <div id="darkLayer">
            <div class="gallery">
               
                <?php
                    $query = "SELECT * FROM photos ORDER BY date DESC";
                    $result = $mysqli->query($query);
                    $rows = $result->num_rows;
                                        
                    for($i = 0; $i < $rows; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_array(MYSQLI_NUM);
                        echo "<div class='photo'>";
                        echo "<img src='$row[0]' title='$row[1]'>";
                        echo "<h4>$row[1]</h4>";
                        echo "<p>$row[3]</p>";
                        echo "<p class='date'>$row[2]</p>";
                        echo "</div>";
                    }
                ?>
                
            </div>
        </div>
        <small>by nomrk.</small>
    </body>
</html>
<?php
    $mysqli->close();
?>