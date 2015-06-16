<!--
Copyright (C) 2015 mrk

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php
    include_once 'database.php';
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=shop', $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $stmt = $pdo->prepare("SELECT name FROM products WHERE name LIKE :search");
            $stmt->bindValue(':search', '%'.$_POST['search'].'%', PDO::PARAM_STR);
            $stmt->execute();
            
        }
        
    } catch (PDOException $ex) {
        echo 'Error! '.$ex->getMessage();
        die();
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="searchTable">
        <table>
            <?php
                while($row = $stmt->fetch()){
                    echo "<tr>";
                    echo "<td>".$row['pid']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>
<?php 
    if(isset($pdo)){
        $pdo = null;
    } 
?>