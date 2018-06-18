<!DOCTYPE html>
<?php

    session_start();
    
    require ("connect.php");

    $path = $_GET['issue'];
    $comicName = $_GET['comic'];
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if(isset($_POST['postpage'])){
        $message = $_POST['postpage'];
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if(isset($_POST['bookMark'])){
        $message = $_POST['postpage'];
        echo "<script type='text/javascript'>alert('$message');</script>";
        $bookSql = "INSERT INTO bookmark (bookmark_id, user_id, upload_id, page) 
                    VALUES (null, (SELECT user_id FROM register WHERE username='$user'), 
                    '".$_POST['up_id']."', '".$_POST['postpage']."')";
        
        mysqli_query($conn, $bookSql);
    }

    if((isset($_SESSION['username']))){
         $user = $_SESSION['username'];
    }

    if(isset($_POST['comment']))
    {
        $commented = $_POST['commentText'];
        $user = $_SESSION['username'];
        
        $sqlCom = "INSERT INTO comment (comment_id, user_id, upload_id, content, date) 
        VALUES (null, (SELECT user_id FROM register WHERE username='$user'), '".$_POST['up_id']."', '$commented', CURRENT_TIMESTAMP)";
        
        mysqli_query($conn, $sqlCom);
        
        echo "<script>window.opener.location.reload();</script>";
        echo "<script>window.close();</script>";    
        
        header("Location: UploadedComicViewer.php?issue={$path}&amp;comic={$comicName}");
        
        
    }

    $result = mysqli_query($conn, "SELECT * FROM comment AS C 
                                   INNER JOIN register as R 
                                   ON C.user_id=R.user_id 
                                   INNER JOIN pictures AS P 
                                   ON R.user_id=P.user_id
                                   INNER JOIN comiupload AS U
                                   ON C.upload_id=U.upload_id
                                   WHERE U.name='$comicName'");


?>
<html>
<head>
<meta charset ="utf-8">
<title>Comics Online</title>

<link rel = 'stylesheet' href = "css/bootstrap.min.css">
<link rel = 'stylesheet' type='text/css' href = "style.css">

<style>

</style>
</head>

<body>
	<div class = 'container-fluid'>
		<ul class="nav">
			<div class="container">
                <div class="row" style="background-color: #181818;">
                    <div class='logo'>
                        <a href ='index.php'><img class= "logo-image" img src="img/logo.png"></a>
                    </div>
                    <div class="wrapper col-md-3 col-md-offset-4 col-xs-3 col-xs-offset-2">
                        <form method="post" action="index.php">
                            <br>
                            
                            <input type ="search" name="search" placeholder="Search... " class="form-control">
                            <br>
                            <button type="submit" class="btn btn-success" name="searchBtn">
                                <span> Search </span>
                            </button>
                        <br><br>
                        </form>      
                    </div>
                </div>
            </div>
            
			<div class="nav1"> 
			<li>
                <a href ='index.php'>Home</a>
            </li>
            
			<li>
                <a href ='WebApp%20DCList.php' class="nav-item">Comic List</a>
            </li>
            
			<li>
                <a href ='WebAppRequestComic.php'>Request Comic</a>
            </li>
            
			<li>
                <a href ='WebApp%20Report.php'>Report</a>
            </li>
                
            <li>
                <a href='WebAppComicReader.php'>Comic Reader</a>
            </li>
            <?php if(!(isset($_SESSION['username']))){ ?>
                <li>
                    <a href='WebApp%20Project.php' id="login">Log In or Sign Up</a>
                </li>
            <?php }?>
                
            <?php if((isset($_SESSION['username']))){ ?>
                <li>
                    <?php  echo "<a href='Profile.php?user={$user}'>My Profile</a>" ?>
                </li>
            <?php }?>
                
             <?php if((isset($_SESSION['username']))){ ?>
                <li>
                    <a href='logout.php' id="logout">Log Out</a>
                </li>
            <?php }?>
                
            <?php
                
                if(!(isset($_SESSION['username']))){
                    echo 'Current User : Guest'; 
                }else{
                    echo 'Current User : '.$_SESSION['username']; 
                }
                
            ?>
            </div>       
		</ul>
		
		<div class='banner'>
			<img class="banner-image" src="img/ComicsBanner1.jpg">
		</div>
        <hr>
        <select id='pageselector'>
            <?php
            
                $comicPath = "SELECT * FROM comiupload AS C 
                  INNER JOIN register AS R 
                  ON C.user_id=R.user_id
                  WHERE issue_no='$path' AND name='$comicName'";

                $path = mysqli_query($conn, $comicPath);
                $images = array();
                $ctr = 1;
                while($row = mysqli_fetch_array($path)){
                    $directory = $row['comic_path'];
                    if($opendir = opendir($directory)){
                        while(($file = readdir($opendir)) !== FALSE){
                            if($file != "." && $file != ".."){
                                $images[] = $file;
                                echo "<option value='".($ctr)."'>Page {$ctr}</option>";
                                $ctr++;
        
                            }
                            
                        }
                    }

                }

            ?>
        </select>
        <p class="info col-md-offset-4">Use left and right arrow keys to navigate</p>
        <hr>
         <a href="WebApp%20DCList.php"><button type="button" class="back">Back to Comic List</button></a>
        <iframe name="iframeCatch" style="display: none;"></iframe> 
        
        <form method="POST" action="UploadedComicViewer.php" target="iframeCatch">
            <button type="submit" class="bookmark" name="bookMark" id="bookmark">Bookmark This Page</button>
        </form>
        <input type="hidden" id="book" name="book">

            
        
        <div id="container">
            
            
            <?php
                foreach($images as $image){
                     echo "<img class='slides' src='$directory/$image'>";
                }
            ?>
           
            
            <button class="btn" onclick="minusIndex(1)" id="btn1">&#10094;</button>
            <button class="btn" onclick="plusIndex(1)" id="btn2">&#10095;</button>
            
            
        </div>
        <hr>
        <?php if((isset($_SESSION['username']))){ ?>
        <div class="rowcol-xs-offset-1">
                  <label class="commentLabel">Leave a comment!</label>
         </div>
            <iframe name="myiframe" style="display: none;"></iframe>
            <?php
        
                $uploadGet = "SELECT * FROM comiupload AS C 
                INNER JOIN register AS R 
                ON C.user_id=R.user_id 
                WHERE name = '$comicName'";
    
                $getResult = mysqli_query($conn, $uploadGet);
                
                $rowGet = mysqli_fetch_array($getResult);
                $sqlPath = "SELECT * FROM comiupload WHERE upload_id='{$rowGet['upload_id']}'";
                
                                                 
                $query = mysqli_query($conn, $sqlPath);
        
            ?>
            <form method="POST" action="UploadedComicViewer.php" target="myiframe">
                <?php 
                    while($rows=mysqli_fetch_array($query)){
                        echo "<input type='hidden' value='{$rows['upload_id']}' name='up_id'>";
                    }
    
				    echo "<textarea id = '{$rows['upload_id']}' rows = '4' cols = '80' placeholder='Your text here...' name='commentText' class='comment comment{$rows['upload_id']}'></textarea>";
                ?>
				<br>
				<button type="submit" class="btn btn-success" name="comment" onclick="myFunction1();">Submit</button>
            </form>
        <hr>
        <?php }?>
        <h2>Comments</h2>
        <?php if(!(isset($_SESSION['username']))){ ?>
                    <p>Must be logged in to comment!</p>
        <?php } ?>
        <hr>
        <?php
        
            while ($row = mysqli_fetch_array($result)){
                echo "<div class='row'>
                        <div class='updates2 col-md-3 col-md-offset-1'>
                            <div class='rowcol-xs-offset-1'>
                                <img src = '{$row['image']}' class='dynamo'>
                            </div>
                            <hr>
                            Posted By: {$row['username']}
                            <p style = 'font-size: 10px; color: darkgray'>{$row['date']}</p>
                        </div>
                        <div class='updates3 col-md-7'>
                            <div class='rowcol-xs-offset-1'>
                                <p>{$row['content']}</p>
                            </div>
                        </div>
                    </div>
                <hr>
                ";
            }
        
        ?>
         
		<footer>
		
			<div class="row">
                <p>Posted by: Tristan Catane</p>
                <p>Contact information: <a href="mailto:ttcatane@gmail.com">
                ttcatane@gmail.com</a></p>
			</div>
		
		</footer>
        
	</div>
</body>
</html>

<script src ="js/jquery.min.js"></script>
<script>
    
    var index = 1;

    
    $("#pageselector").on("change", function(){
        var page = $(this).val();
        index = page;
        showImage(index);
    });    
    
    function plusIndex(n){        
        index = index+1;
        showImage(index);
    }
    
    function minusIndex(n){
        index = index-1;
        showImage(index);
    }
    
    showImage(1);
    
    function showImage(n){
        var ctr;
        var x = document.getElementsByClassName("slides");
        
        if(n > x.length){
            index = 1;
        }
        
        if(n < 1){
            index = x.length;
        }
        
        for(ctr = 0; ctr < x.length; ctr++){
            x[ctr].style.display = "none";
        }
        x[index-1].style.display = "block";
    }
    
    function myFunction1() {
        alert("Thank you!");    
    }

    document.onkeydown = function(n) {
        n = n || window.event;
        if (n.keyCode == '37') {
            minusIndex();
        } else if (n.keyCode == '39') {
            plusIndex();
        }
    }
    
        
    $(document).ready(function(){
        $('.bookmark').on("click", function(){
            
            var page = index;
            
            $.post('UploadedComicViewer.php', {postpage: page}, 
                  function(data)
                  {
                    $("#book").html(data);            
            });
            
            
        });
    });
    

</script>
