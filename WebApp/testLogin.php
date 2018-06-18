 <!DOCTYPE html>
<?php

    session_start();

    require("connect.php");

    //FOR REGISTRATION
    if(isset($_POST['register']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);;
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);  

        if($password != $confirmpass){
                $message = "Passwords must match!";
                echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
            $password = md5($password);
            $confirmpass = md5($confirmpass);
            
            $sql = "INSERT INTO register(user_id, username, email, password, confirmpass) VALUES(null,'$username', '$email', '$password', '$confirmpass')";
            
            mysqli_query($conn,$sql);  
            
            $upload = "INSERT INTO pictures (image_id, user_id, image)
            VALUES (null, (SELECT user_id FROM register WHERE username = '$username'), 'uploads/StormtrooperProfPic.jpg')";
            
            mysqli_query($conn, $upload);
            
            $message = "Thank you for registering!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("refresh:0; url=WebApp Project.php?reg=true");
        }
    }

    //FOR LOGGING IN

    if(isset($_POST['login']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password); 
        
        $sql = "SELECT username, password FROM register WHERE username='$username' AND password='$password'";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            
            $user = $_SESSION['username'];
            
            $message = "Welcome!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("refresh:0; url=Profile.php?user={$user}");

          }else{
            
            $message = "Invalid login attempt! Username or password is incorrect!";
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
                <h4>Login or Sign Up</h4>
                <hr>
                <div class="row">
                    <div class="dcComics col-md-5 col-md-offset-1">
                        
                        <!-- LOG IN -->
                        
                        <h3>Log In : </h3>
                        <hr>
                        <form method="post" action="Profile.php">
                            <div class="dcComics col-md-5">
                                Username: <br>
                                <input type="text" name="username" class="box" placeholder="Username" class="form-control" required="required">
                                <br>
                                <br>
                                <button type="submit" name="login" class="btn btn-success">Log In</button>
                            </div>
                                <div class="dcComics col-md-5 col-md-offset-1">
                                Password : <br>
                                <input type="password" name="password" class="box" placeholder="Password" class="form-control" required="required">
                                <br>
                                <br>     
                            </div>
                        </form>
                            
                    </div>
                    <div class="dcComics col-md-5">
                        <!-- REGISTER -->
                            <h3>Register : </h3>
                            <hr>
                            <form method="post" action="Profile.php">
                                <div class="dcComics col-md-5">
                                    Username: <br>
                                    <input type="text" name="user" class="box" placeholder="Username" class="form-control" required="required">
                                    <br>
                                    <br>

                                </div>
                                <div class="dcComics col-md-5 col-md-offset-1">
                                    Email : <br>
                                    <input type="test" name="email" class="box" placeholder="Email" class="form-control" required="required">
                                    <br>
                                    <br>     
                                </div>
                                <div class="dcComics col-md-5">
                                    Password : <br>
                                    <input type="password" name="pass" class="box" placeholder="Password" class="form-control" required="required">
                                    <br>
                                    <br>     
                                    <button type="submit" name="register" class="btn btn-success">Register</button>
                                </div>
                                <div class="dcComics col-md-5 col-md-offset-1">
                                    Confirm Password : <br>
                                    <input type="password" name="confirmpass" class="box" placeholder="Confirm Password" class="form-control" required="required">
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
