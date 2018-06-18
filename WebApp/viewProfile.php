<!DOCTYPE html>
<?php

    session_start();

    require ("connect.php");

    $user = $_SESSION['username'];

    $getUser = $_GET['user'];
?>
<html>
<head>
<meta charset ="utf-8">
<title>
    
<?php

    echo $getUser."'s Profile";
    
?>
    
</title>

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
		
        <!--Banner-->
		<div class='banner'>
			<img class="banner-image" src="img/ComicsBanner1.jpg">
		</div>
        <hr>
        
        <!-- PROFILE PICTURE -->
        <form action="Profile.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="updates2 col-md-10 col-md-offset-1">
                    <div class="row">
                         <div class="dcComics col-md-2">
                             
                             <?php
                                $result = mysqli_query($conn, "SELECT * FROM pictures AS P            
                                                                INNER JOIN register AS R 
                                                                ON P.user_id=R.user_id 
                                                                WHERE R.username = '$getUser'");
                             
                                while($row = mysqli_fetch_array($result)){?>
                                    <img src="<?php echo $row['image']; ?>" class="dynamo">
                             
                            <?php } ?>
                            <br><br>

                        </div>
                        <div class="dcComics col-md-4 col-md-offset-1">
                            <hr>
                            <h3>Username : <?php echo $getUser; ?>  
                            <script src="js/jquery.min.js"></script>
                            </h3>
                            
                            <h4> 
                                
                                <?php  
                                        $result = mysqli_query($conn, "SELECT * FROM register WHERE username = '$getUser'");
                            
                                        while($row = mysqli_fetch_array($result)){
                                            if($user != $row['username']){
                                                
                                            }else{
                                                echo "Email : " .$row['email'];
                                            }
                                            
                                        }
                                ?>
                            </h4>
                            <br>
                            <button class="btn btn-success" id="modalBtn">View Uploads</button><hr>
                            <div class="modal">
                                <div class="modal_content"></div>
                                <div class="modal_main">
                                <h1 class="modalUpload">Uploads</h1>
                                <img src="close-x.png" class="closer">
                                <hr class="modalLine">
                                    <div class="updates col-md-12">
                                    <?php
                                    
                                        $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                                        INNER JOIN register AS R 
                                                                        ON C.user_id=R.user_id 
                                                                        WHERE R.username='$getUser'");

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
                            </div>
                        </div>                 
                        
                    </div>
                    
                </div>
            </div>
        </form>
    
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
        $("#modalBtn").click(function(event){
            event.preventDefault();
            event.stopPropagation();
            $(".modal").fadeIn();
            $(".modal_main").show();
        });
    });

    $(document).ready(function(){
        $("body").click(function(){
            $(".modal").fadeOut();
            $(".modal_main").fadeOut();
        });
    });
    
    $(document).ready(function(){
        $(".closer").click(function(){
            $(".modal").fadeOut();
            $(".modal_main").fadeOut();
        });
    });
    
</script>
