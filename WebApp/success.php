<?php
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
        header("Location: index.php");
    
    }
?>
<h2>You have logged in!</h2>