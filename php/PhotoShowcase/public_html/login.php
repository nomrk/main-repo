<?php
    session_start();
    include_once "database.php";
    
    $mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
    
    if($mysqli->connect_error){
        die("Mysqli err 1:" . $mysqli->connect_error);
    }
    if(isset($_SESSION['authenticated']) == 1){
        header('Location: adminpanel.php');
    }
    if(isset($_POST['username'])&&isset($_POST['password'])){
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $mysqli->real_escape_string($_POST['password']);
        
        $query = "SELECT username FROM user WHERE username='$username'";
        $result = $mysqli->query($query);
        if(!$result){
            die($mysqli->error);
        }
        $row = $result->fetch_row();
        $result->close();
        
        if($username == $row[0]){
            $query = "SELECT password FROM user WHERE password='$password'";
            $result = $mysqli->query($query);
            if(!$result){
                die($mysqli->error);
            }
            $row = $result->fetch_row();
            $result->close();
            
            if($password == $row[0]){
                $_SESSION['authenticated'] = 1;
                header('Location: adminpanel.php');
                die();
            }
            else{
                header('Location: login.php');
                die();
            }
        }
        else{
            header('Location: login.php');
            die();
        }
    }
    
    $mysqli->close();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Photos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="javascript.js" type="text/javascript"></script>
    </head>
    <body>
         <div class="menu">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="gallery.php">Gallery</a>
            <a href="login.php">Login</a>
        </div>
        <div class="main">
        <div class="form">
            <form action="login.php" method="POST" id="loginForm" onsubmit="return validateLogin(this)">
                <input id="input" required="required" type="text" maxlength="16" name="username" placeholder="Username" autocomplete="off">
                <input id="input" required="required" type="password" maxlength="16" name="password" placeholder="Password" autocomplete="off">
                <input onmouseover="return hover(this);" onmouseout="return noHover(this);" type="submit" id="submit" value="Login" />
            </form>
        </div>
        </div>
        <small>by nomrk.</small>
    </body>
</html>