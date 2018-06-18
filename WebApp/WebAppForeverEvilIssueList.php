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
        <a href="WebApp%20DCList.php"><button type="button" class="back col-md-offset-5">Back to Comic List</button></a>
        <br>
        <br>
        <div class="row">
            <div class="updates2 col-md-10 col-md-offset-1">
                <div class="row">
                     <div class="dcComics col-md-2">
                         <img src="ForeverEvil1.jpg" class="rebirth1">
                    </div>
                    <h3>SUMMARY : </h3>
                    <hr>
                    <p>Spinning out of the conclusion of Trinity War, the Justice League is dead, and the Secret Society of Super Villains led by the Crime Syndicate of Earth 3 take over Earth.</p>
                </div>
            </div>
            <br>
            <div class="updates col-md-10 col-md-offset-1">
                <table>
                    <tr>
                        <th width="85%">
                            Issue Name
                            <hr>
                        </th>
                        <th width="15%">
                            Date Added
                            <hr>
                        </th>
                    </tr>
                    <tr>
                        <td width="85%" class="updates">
                            <?php
                
                            $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                            INNER JOIN register AS R 
                                                            ON C.user_id=R.user_id
                                                            WHERE name LIKE '%forever evil%'
                                                            ORDER BY issue_no ASC");

                            while($row = mysqli_fetch_array($comic)){ 
                                echo "<a href='UploadedComicViewer.php?issue={$row['issue_no']}&amp;comic={$row['name']}' name='uploadedcomic'>";

                                echo "{$row['name']} ";
                                echo "<span class='textDark'>Issue #{$row['issue_no']} </span> <br>";

                                echo "</a>";
                                echo "<br>";
                                 ?>

                        <?php } ?>
                        </td>
                        <td width="15%" class="updates">
                            <?php
                
                            $comic = mysqli_query($conn, "SELECT * FROM comiupload AS C 
                                                            INNER JOIN register AS R 
                                                            ON C.user_id=R.user_id
                                                            WHERE name LIKE '%forever evil%'");

                            while($row = mysqli_fetch_array($comic)){ 

                                echo "{$row['date_added']} ";
                                echo "<br><br>";
                                 ?>

                        <?php } ?>
                        </td>
                    </tr>
                    
                    <hr>
                </table>
                <hr>
            </div>
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
