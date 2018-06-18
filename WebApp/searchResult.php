 <!DOCTYPE html>
<?php

    session_start();

    require("connect.php");
    
    if((isset($_SESSION['username']))){
         $user = $_SESSION['username'];
    }

    $SR = $_GET['search'];

    $searchSql = "SELECT * FROM comiupload AS C 
                INNER JOIN register AS R 
                ON C.user_id=R.user_id
                WHERE C.name LIKE '%{$SR}%'
                ORDER BY C.issue_no ASC";
        
    $searchResult = mysqli_query($conn, $searchSql);
        
    
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
                    <div class="wrapper col-md-3 col-md-offset-4">
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
        <div class="row">
            <div class="updates2 col-md-10 col-md-offset-1">
                <h4>Search Results <span class="item">(Results are arranged by Issue No.)</span></h4>
                <hr>
                <div class="row">
                    <?php
                    
                            if($searchResult && mysqli_num_rows($searchResult) > 0){
                                while($row = mysqli_fetch_array($searchResult)){
                                    $searchImages = array();
                                    $directory = $row['comic_path'];
                                    if($opendir = opendir($directory)){
                                        while(($file = readdir($opendir)) !== FALSE){
                                            if($file != "." && $file != ".."){
                                                $searchImages[] = $file;
                                            }

                                        }
                                    }
                                    echo "<div class='updates col-md-2'>
                                            <a href='UploadedComicViewer.php?issue={$row['issue_no']}&amp;comic={$row['name']}' name='uploadedcomic'>";
                                    
                                            foreach($searchImages as $searchImage){

                                                echo "<img src='$directory$searchImage' class='rebirth'>
                                                    <br>";

                                                break;
                                            }
                                    
                                            echo "{$row['name']}<br>
                                            <span class='textDark'>Issue #{$row['issue_no']} </span>
                                            </a>";
                                        if((isset($_SESSION['username']))){
                                           echo "<br> <span class='uploader'>Uploaded By:</span>
                                            <span class='textDark'>";
                                            
                                            if($user != $row['username']){
                                                echo "<a href='viewProfile.php?user={$row['username']}'> {$row['username']}</a>";
                                            }else{
                                                echo "<a href='Profile.php?user={$user}'>{$row['username']}</a>";
                                            }
                                            
                                        }
                                            
                                         echo "</span><br><br>";
                                            
                                      echo "</div>";
                                }
                            }else{
                                $message = "Sorry, item not found in database!";
                                echo "<script type='text/javascript'>alert('$message');</script>";
                            }
                                                                 
                        ?>
                </div>
            </div>
        </div>
        <br>

        </div>
        <hr>
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
    
    $(document).ready(function(){
 
    });
    
</script>
