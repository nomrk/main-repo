<?php
    session_start();
    if(session_destroy()){
        echo "You have loged out!";
        echo "<a href='index.html'>Return to main page.</a>";
    }
    else{
        echo "something wrong with session_destroy()";
    }
?>