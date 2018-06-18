<?php

session_start();
if(!(isset($_SESSION['username'])))
{
    $message = "Must be logged in to report!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("refresh:0; url=index.php");
}

?>
