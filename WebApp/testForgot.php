 <!DOCTYPE html>
<?php

    session_start();

    require("connect.php");
    
    if(isset($_POST['changepass'])){
        
        $username = $_POST['username'];
		$current = md5($_POST['curpass']);
        $password = md5($_POST['newpass']);
        $confirmpass = md5($_POST['newconfirm']);	
        
        $catch = "SELECT password 
				  FROM register 
				  WHERE username = '$username'"
				  ;
		
		$oldpass = mysqli_query($conn, $catch);
		$row =  mysqli_fetch_assoc($oldpass);
		$oldpassworddb = $row['password'];
		
		if($current == $oldpassworddb){
			
			if($password == $confirmpass){
				$sql = "UPDATE register SET password = '$password', confirmpass = '$confirmpass' WHERE username = '$username'";
                
				mysqli_query($conn, $sql);
                
                $message = "Password has been changed!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("refresh:0; url=WebApp Project.php");

			}else{
                $message = "Passwords must match!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
			
		}else{
            $message = "Current password does not match with password in database!";
            echo "<script type='text/javascript'>alert('$message');</script>";
		}

	}

    if(isset($_POST['forgotpass'])){
        
        $username = $_POST['username'];
        $password = md5($_POST['newpass']);
        $confirmpass = md5($_POST['newconfirm']);	
			
			if($password == $confirmpass){
				$sql = "UPDATE register SET password = '$password', confirmpass = '$confirmpass' WHERE username = '$username'";
                
				mysqli_query($conn, $sql);
                
                $message = "Password has been changed!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("refresh:0; url=WebApp Project.php");

			}else{
                $message = "Passwords must match!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
			
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
                <h4>Forgot Password</h4>
                <hr>
                <div class="row">
                    <div class="dcComics col-md-5 col-md-offset-1">
                        
                        <!-- FORGOT PASSWORD -->
                        
                        <h3>Update Password : </h3>
                        <hr>
                        <form method="post" action="WebApp Project.php">
                            <div class="dcComics col-md-5">
                                Email : <br>
                                <input type="text" name="username" class="box" placeholder="Email" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                            <div class="dcComics col-md-5">
                                New Password : <br>
                                <input type="password" name="newpass" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                            <div class="dcComics col-md-5">
                                Confirm Password : <br>
                                <input type="password" name="newconfirm" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>    
                                <button type="submit" name="forgotpass" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                            
                    </div>
                    <div class="dcComics col-md-5">
                        
                        <!-- CHANGE PASSWORD -->
                        
                        <h3>Change Password : </h3>
                        <hr>
                        <form method="post" action="WebApp Project.php">
                            <div class="dcComics col-md-5">
                                Username : <br>
                                <input type="text" name="username" class="box" placeholder="Username" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                            <div class="dcComics col-md-5">
                                Current Password : <br>
                                <input type="password" name="curpass" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                            <div class="dcComics col-md-5">
                                New Password : <br>
                                <input type="password" name="newpass" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>    
                                <button type="submit" name="changepass" class="btn btn-success">Submit</button>
                            </div>
                            <div class="dcComics col-md-5">
                                Confirm Password : <br>
                                <input type="password" name="newconfirm" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                        </form>
                            
                    </div>
                    
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
