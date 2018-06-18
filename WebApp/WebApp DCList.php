 <!DOCTYPE html>
<?php

    session_start();

    require ("connect.php");

    if((isset($_SESSION['username']))){
         $user = $_SESSION['username'];
    }


?>
<html>
<head>
<meta charset ="utf-8">
<title>Comics Online - Comic List</title>

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
                    <a href='WebApp%20Project.php'>Log In or Sign Up</a>
                </li>
            <?php }?>
                
            <?php if((isset($_SESSION['username']))){ ?>
                <li>
                    <?php  echo "<a href='Profile.php?user={$user}'>My Profile</a>" ?>
                </li>
            <?php }?>
                
             <?php if((isset($_SESSION['username']))){ ?>
                <li>
                    <a href='logout.php'>Log Out</a>
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
            <div class="updates2 col-md-7 col-md-offset-1">
				<div class="rowcol-xs-offset-1">
                    <label>DC Comics</label>
                </div>
                <div class="dcComics col-md-2">
                            <a href="WebAppForeverEvilIssueList.php">
                                <img src="ForeverEvil1.jpg" class="rebirth">
                                <br>
                                Forever Evil
                            </a> 
                </div>
                <div class="dcComics col-md-2">
                            <a href='WebAppFlashPointIssueList.php'>
                                <img src="FlashpointCover.jpg" class="rebirth">
                                <br>
                                Flashpoint Paradox 
                            </a> 
                </div>
                <?php
                    
                        $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                        INNER JOIN register AS R 
                                                        ON C.user_id=R.user_id WHERE name 
                                                        NOT LIKE '%paradox%' 
                                                        AND name NOT LIKE '%forever%'
                                                        AND name NOT LIKE '%strange%'
                                                        AND C.publisher LIKE '%dc%'");

                        while($rowCom = mysqli_fetch_array($comic)){ ?>
                          <?php  
                            $comicPath = "SELECT * FROM comiupload AS C 
                                  INNER JOIN register AS R 
                                  ON C.user_id=R.user_id
                                  WHERE issue_no='{$rowCom['issue_no']}' AND name='{$rowCom['name']}'";

                                $path = mysqli_query($conn, $comicPath);
                                $images = array();
                                while($row = mysqli_fetch_array($path)){
                                    $directory = $row['comic_path'];
                                    if($opendir = opendir($directory)){
                                        while(($file = readdir($opendir)) !== FALSE){
                                            if($file != "." && $file != ".."){
                                                $images[] = $file;
                                            }

                                        }
                                    }

                                }                               
                            
                        echo "
                          <div class='dcComics col-md-2'>
                          
                             <a href='UploadedComicViewer.php?issue={$rowCom['issue_no']}&amp;comic={$rowCom['name']}' name='uploadedcomic'>";
                             
                             foreach($images as $image){
                                 
                              echo "<img src='$directory/$image' class='rebirth'>
                                    <br>";
                                 
                                    break;
                                }
                                  echo "{$rowCom['name']}
                                    <br>
                                    <span class='textDark'>Issue #{$rowCom['issue_no']}</span>
                                    <br>
                                    ";
                                    
                                    
                             
                             echo "</a>";
                          echo "</div>" ;
                                                                 
                          ?>
                    <?php }?>
                
                    
            </div>
            <div class="updates col-md-2 col-md-offset-1">
                User Uploads
                <hr>
                <?php
                
                $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                INNER JOIN register AS R 
                                                ON C.user_id=R.user_id 
                                                WHERE name NOT LIKE '%Paradox%' 
                                                AND name NOT LIKE '%Forever Evil%'");
                
                while($row = mysqli_fetch_array($comic)){ ?>
                <?php
                  echo " <a href='UploadedComicViewer.php?issue={$row['issue_no']}&amp;comic={$row['name']}' name='uploadedcomic'>";
                        ?>
                        <?php echo $row['name'];
                            echo "<br><span class='textDark'>Issue #{$row['issue_no']} </span>
                            </a>";
                        if((isset($_SESSION['username']))){
                           echo " <br><span class='uploader'>Uploaded By: </span>
                            <span class='textDark'>";
                    
                            if($user != $row['username']){
                                echo "<a href='viewProfile.php?user={$row['username']}'> {$row['username']}</a>";
                            }else{
                                 echo "<a href='Profile.php?user={$user}'>{$row['username']}</a>";
                            }
                        }
                    
                    echo "</span> <br><br> ";
                ?>
                    
                    
            <?php } ?>

            </div>

        </div>
    <br>
    	<div class="row">
            <div class="updates2 col-md-7 col-md-offset-1">
				<div class="rowcol-xs-offset-1">
                    <label>Marvel Comics</label>
                </div>
                <?php
                    
                        $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                        INNER JOIN register AS R 
                                                        ON C.user_id=R.user_id 
                                                        WHERE C.publisher LIKE '%marvel%'");

                        while($rowCom = mysqli_fetch_array($comic)){ ?>
                          <?php  
                            $comicPath = "SELECT * FROM comiupload AS C 
                                  INNER JOIN register AS R 
                                  ON C.user_id=R.user_id
                                  WHERE issue_no='{$rowCom['issue_no']}' AND name='{$rowCom['name']}'";

                                $path = mysqli_query($conn, $comicPath);
                                $images = array();
                                while($row = mysqli_fetch_array($path)){
                                    $directory = $row['comic_path'];
                                    if($opendir = opendir($directory)){
                                        while(($file = readdir($opendir)) !== FALSE){
                                            if($file != "." && $file != ".."){
                                                $images[] = $file;
                                            }

                                        }
                                    }

                                }                               
                            
                        echo "
                          <div class='dcComics col-md-2'>
                          
                             <a href='UploadedComicViewer.php?issue={$rowCom['issue_no']}&amp;comic={$rowCom['name']}' name='uploadedcomic'>";
                             
                             foreach($images as $image){
                                 
                              echo "<img src='$directory/$image' class='rebirth'>
                                    <br>";
                                 
                                    break;
                                }
                                  echo "{$rowCom['name']}
                                    <br>
                                    <span class='textDark'>Issue #{$rowCom['issue_no']}</span>";
                                    
                                    
                             
                             echo "</a>";
                          echo "</div>" ;
                                                                 
                          ?>
                    <?php }?>
                
                    
            </div>
            <div class="updates col-md-2 col-md-offset-1">
                All Uploads<br>
                <hr>
                <?php
                
                $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                INNER JOIN register AS R 
                                                ON C.user_id=R.user_id ");
                
                while($row = mysqli_fetch_array($comic)){ ?>
                <?php
                  echo " <a href='UploadedComicViewer.php?issue={$row['issue_no']}&amp;comic={$row['name']}' name='uploadedcomic''>";
                        ?>
                        <?php echo $row['name'];
                            echo " <span class='textDark'>Issue #{$row['issue_no']} </span> <br><br>";
                                                         ?>
                    </a>
                    
            <?php } ?>

            </div>

        </div>
                
        <br>
		
        
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
