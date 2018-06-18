<!DOCTYPE html>
<?php

    session_start();

    require ("connect.php");

    $user = $_SESSION['username'];

    if(isset($_POST["changepic"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $pathto="uploads/".$_FILES["file"]["name"];
            
        move_uploaded_file( $_FILES['file']['tmp_name'],$pathto);
            
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
            
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            echo "<script type='text/javascript'>alert('$message');</script>";

        }else{
            $sql = "UPDATE pictures AS P 
                    INNER JOIN register AS R 
                    ON P.user_id=R.user_id
                    SET image = '$target_file'
                    WHERE R.username = '$user'";

            mysqli_query($conn, $sql);
            
            $message = "Profile picture has been changed!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("refresh:0; url=Profile.php?user={$user}");
        }
    }

    if(isset($_POST['changepass'])){
        
		$current = md5($_POST['curpass']);
        $password = md5($_POST['newpass']);
        $confirmpass = md5($_POST['newconfirm']);	
        
        $catch = "SELECT password 
				  FROM register 
				  WHERE username = '$user'"
				  ;
		
		$oldpass = mysqli_query($conn, $catch);
		$row =  mysqli_fetch_assoc($oldpass);
		$oldpassworddb = $row['password'];
		
		if($current == $oldpassworddb){
			
			if($password == $confirmpass){
				$sql = "UPDATE register SET password = '$password', confirmpass = '$confirmpass' WHERE username = '$user'";
                
				mysqli_query($conn, $sql);
                
                $message = "Password has been changed!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("refresh:0; url=Profile.php?user={$user}");

			}else{
                $message = "Passwords must match!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
			
		}else{
            $message = "Current password does not match with password in database!";
            echo "<script type='text/javascript'>alert('$message');</script>";
		}

	}

    if(isset($_POST["uploadfile"])) {
        $target_dir = "comics/";
        $target_file = $target_dir . basename($_FILES["comicfile"]["name"]);
        $pathto="comics/".$_FILES["comicfile"]["name"];
        $name = mysqli_real_escape_string($conn, $_POST['comicname']); 
        $issue = mysqli_real_escape_string($conn, $_POST['comicissue']); 
        $publisher = mysqli_real_escape_string($conn, $_POST['publisher']); 
        
        move_uploaded_file( $_FILES['comicfile']['tmp_name'],$pathto);
            
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($imageFileType != "cbz" && $imageFileType != "zip" && $imageFileType != "7z") {
            
            $message = "Sorry, only CBZ, ZIP, & 7z files are allowed.";
            echo "<script type='text/javascript'>alert('$message');</script>";

        }else{
            
            $ctr = 1;
            
            $path = "uploadedcomics/";
            
            while(is_dir($path)){
                $path="{$ctr}uploadedcomics/";
                $ctr++;
            }
            
            $zip = new ZipArchive;
            
            $filecomic = $zip->open ($pathto);
            
            mkdir($path);
            
            if($filecomic === TRUE){
                $zip->extractTo($path);
                $zip->close();
            }
            
            $sqli = "INSERT INTO comiupload  (upload_id, user_id, name, issue_no, publisher, file, comic_path, date_added)
                    VALUES (null, (SELECT user_id 
                                    FROM register 
                                    WHERE username = '$user'), 
                    '$name', '$issue', '$publisher', '$pathto', '$path', CURRENT_TIMESTAMP)";

            $_SESSION['issue_no'] = $path;
            
            mysqli_query($conn, $sqli);
            
            $message = "Comic has been uploaded!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("refresh:0; url=Profile.php?user={$user}");
        }
    }

    if(isset($_POST['delete'])){
        $delComic = mysqli_real_escape_string($conn, $_POST['delComic']);
        $delIssue = mysqli_real_escape_string($conn, $_POST['delIssue']);
        
        $delSql = "DELETE FROM comiupload
        WHERE name='$delComic' AND issue_no='$delIssue'";
        
        mysqli_query($conn, $delSql);
        
        $message = "Comic has been deleted!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
?>
<html>
<head>
<meta charset ="utf-8">
<title>
    
<?php

    echo $user."'s Profile";
    
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
                                $result = mysqli_query($conn, "SELECT * FROM pictures AS P            INNER JOIN register AS R 
                                          ON P.user_id=R.user_id 
                                          WHERE R.username = '$user'");
                             
                                while($row = mysqli_fetch_array($result)){?>
                                    <img src="<?php echo $row['image']; ?>" class="dynamo">
                             
                            <?php } ?>
                            <br><br>
                             Upload profile picture
                             <input type="file" name="file" id="file" accept=".jpg, .jpeg, .png,. gif"><br>
                             <button type="submit" class="change" name="changepic">Change!</button><br>
                             <span class="textDark">Click "Change!" to change your profile picture!</span>
                        </div>
                        <div class="dcComics col-md-4 col-md-offset-1">
                            <hr>
                            <h3>Username : <?php echo $_SESSION['username']; ?>  
                            <script src="js/jquery.min.js"></script>
                            </h3>
                            
                            <h4> 
                                Email :
                                <?php  
                                        $result = mysqli_query($conn, "SELECT * FROM register WHERE username = '$user'");
                            
                                        while($row = mysqli_fetch_array($result)){
                                            echo "{$row['email']}";
                                        }
                                ?>
                            </h4>
                            <br>
                            <button class="btn btn-success" id="modalBtn">View Uploads</button>
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
                                                                        WHERE R.username='$user'");

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
                        <div class="dcComics col-md-5">
                            <hr>
                            <h3>Delete Comic : </h3>
                            <form method="post" action="Profile.php">
                            <div class="dcComics col-md-5">
                                Comic Name: <br>
                                <input type="text" name="delComic" class="box" placeholder="Comic Name" class="form-control">
                                <br>
                                <br>
                                <button type="submit" name="delete" class="btn btn-success">Delete</button>
                            </div>
                                <div class="dcComics col-md-5 col-md-offset-1">
                                Issue No. : <br>
                                <input type="text" name="delIssue" class="box" placeholder="Comic Issue" class="form-control">
                                <br>
                                <br>     
                            </div>
                            </form>
                            
                        </div>
                        <div class="dcComics col-md-4 col-md-offset-1">
                            <hr>
                            <h3>Change Password</h3>
                            <hr>
                        <form method="post" action="Profile.php">
                            <div class="dcComics col-md-5">
                                Current Password: <br>
                                <input type="password" name="curpass" class="box" placeholder="Current Password" class="form-control">
                                <br>
                                <br>
                            </div>
                            <div class="dcComics col-md-5 col-md-offset-1">
                                New Password: <br>
                                <input type="password" name="newpass" class="box" placeholder="New Password" class="form-control">
                                <br>
                                <br>
                            </div>
                            <div class="dcComics col-md-5">
                                Confirm New Pass: <br>
                                <input type="password" name="newconfirm" class="box" placeholder="Confirm New Password" class="form-control">
                                <br>
                                <br>
                                <button type="submit" name="changepass" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                        </div>
                        
                        <div class="dcComics col-md-5">
                            <hr>
                            <h3>Upload Your Own Comic</h3>
                            <hr>
                            <form method="post" action="Profile.php"  enctype="multipart/form-data">
                            <div class="dcComics col-md-5">
                                Comic Name : <br>
                                <input type="text" name="comicname" class="box" placeholder="Enter Comic Name" class="form-control">
                                <br>
                                <br>
                                Comic Issue : <br>
                                <input type="text" name="comicissue" class="box" placeholder="Enter Comic Issue" class="form-control"><br><br>
                                Publisher : <br>
                                <input type="text" name="publisher" class="box" placeholder="Enter Publisher Name" class="form-control">
                                <br>
                                <p class="textDark">DC Comics, Marvel Comics, Image Comics, DarkHorse Comics</p>
                            </div>
                            <div class="dcComics col-md-5 col-md-offset-1">
                                 Comic File : <br>
                                <input type="file" name="comicfile" id="file" accept=".cbr, .cbz, .zip, .rar">
                                <br>
                                <button type="button" name="uploadfile" class="btn btn-success">Upload!</button>
                            </div>
                        </form>
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
