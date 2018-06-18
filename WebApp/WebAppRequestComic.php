 <!DOCTYPE html>
<?php

    session_start();

    require("connect.php");

    ini_set( 'SMTP', "localhost" );  
    ini_set( 'smtp_port', 25 );

    if(isset($_POST['request']))
    {
        $comicname = mysqli_real_escape_string($conn, $_POST['comicname']);
        $issue = mysqli_real_escape_string($conn, $_POST['issue']);;
        $era = mysqli_real_escape_string($conn, $_POST['select']);
        $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);  
        
        if(!(isset($_SESSION['username'])))
        {
            $sql = "INSERT INTO comics (comic_id, name, issue_no, era, publisher) 
                    VALUES(null, '$comicname', '$issue', '$era', '$publisher')";
        }else{
            $user = $_SESSION['username'];
            
            $sql = "INSERT INTO comicrequest (comic_id, user_id, name, issue_no, era, publisher)            
            VALUES(null, (SELECT user_id FROM register WHERE username = '$user' ), '$comicname', '$issue', '$era', '$publisher')";

        }
        
        mysqli_query($conn, $sql);  
            
        $to = "ttcatane@gmail.com";
        $from = $_POST['email'];
        $subject = "Comic Request";
        $message = "I would like to request for" . $comicname . "Issue No." . $issue . "," . $era . "," . $publisher;
        
        $headers = "From: " . $from;
        mail($to, $subject, $message, $headers);

        header("location: WebAppRequestComic.php");  
    }

    if((isset($_SESSION['username']))){
         $user = $_SESSION['username'];
    }

?>
<html>
<head>
<meta charset ="utf-8">
<title>Comics Online - Request Comic</title>

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
         <form method="post" action="WebAppRequestComic.php">
            <div class="row">
            
                <div class="request col-md-2">
                <label for='Scomic'>Enter Comic Details</label>
                    <div class="col-md-12">
                       
                            <input type ="search" name="comicname" id="Scomic" placeholder="Comic Name" class="form-control" required="required">
                        
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <p>The comic you're looking for isn't available? No worries! Just fill out the boxes with the necessary information and your comic will be requested!</p>
                </div>
            
            </div>
            <br>
            <div class="row">

                    <div class="request col-md-2">
                        <div class="col-md-12">

                                <input type ="search" name="issue" id="Scomic" placeholder="Issue No." class="form-control" required="required">

                        </div>
                    </div>

            </div>
            <br>
            <div class="row">

                    <div class="request col-md-2">
                        <div class="col-md-12">

                            <select name="select">
                                <option value="None">None</option>
                                <option value="Silver Age">Silver Age</option>
                                <option value="Golden Age">Golden Age</option>
                                <option value="New 52">New 52</option>
                                <option value="Post-Crisis">Post-Crisis</option>
                                <option value="MARVEL NOW">MARVEL NOW!</option>
                            </select>

                        </div>
                    </div>

            </div>
            <br>
            <div class="row">

                    <div class="request col-md-2">
                        <div class="col-md-12">

                                <input type ="search" name="publisher" id="Scomic" placeholder="Publisher" class="form-control" required="required">
                            <br>
                        </div>
                    </div>

            </div>
                         <div class="row">

                    <div class="request col-md-2">
                        <div class="col-md-12">

                                <input type ="search" name="email" id="Scomic" placeholder="Email" class="form-control" required="required">
                                <br>
                                <button type="submit" onclick="myFunction()" class="btn btn-success" name="request">Submit</button>
                        </div>
                    </div>

            </div>
            <br>
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
    function myFunction(){
        alert("Your comic has been requested! You will be notified when it is available!")
    }
    
    $(document).ready(function(){
        
    });
</script>
