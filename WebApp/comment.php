<?php

    $path = $_GET['issue'];
    $comicName = $_GET['comic'];


    if(isset($_POST['comment']))
    {
        $commented = $_POST['commentText'];
        $user = $_SESSION['username'];
        
        $sqlCom = "INSERT INTO comment (comment_id, user_id, upload_id, content, date) 
        VALUES (null, (SELECT user_id FROM register WHERE username='$user'), (SELECT upload_id FROM comiupload WHERE name='$comicName'), CURRENT_TIMESTAMP)";
        
        $ret = mysqli_query($conn, $sqlCom);
    
        header("location: UploadedComicViewer.php?issue={$path}&amp;comic={$comicName}");  
    }

?>