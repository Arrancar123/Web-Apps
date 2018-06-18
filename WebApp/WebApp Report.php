<!DOCTYPE html>
<?php include "loginCheck.php"; ?>
<?php

    require("connect.php");

    ini_set( 'SMTP', "localhost" );  
    ini_set( 'smtp_port', 25 );

    $user = $_SESSION['username'];

    if(isset($_POST['report']))
    {
        $reported = $_POST['reportText'];
       
        
        $sql = "INSERT INTO report (report_id, user_id, reportText, date) VALUES(null, (SELECT user_id FROM register WHERE username = '$user' ), '$reported', CURRENT_TIMESTAMP)";
        
                    
        $mail = "SELECT * FROM register WHERE username = '$user'";

        $mailto = mysqli_query($conn, $mail);
        while($row = mysqli_fetch_array($mailto)){
            $from = $row['email'];
        }
        $to = "ttcatane@gmail.com";

        $subject = "Comic Report";
        $message = "I would like to report this comic for blah blah";

        $headers = "From: " . $from;
        mail($to, $subject, $message, $headers);

        mysqli_query($conn, $sql);  
        header("location: WebApp Report.php");  
    }


    if((isset($_SESSION['username']))){
         $user = $_SESSION['username'];
    }

?>
<html>
<head>
<meta charset ="utf-8">
<title>Comics Online - Report</title>

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
                <a href ='WebApp Report.php'>Report</a>
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
                echo 'Current User : '.$_SESSION['username']; 
            ?>
            </div>       
		</ul>
		
		<div class='banner'>
			<img class="banner-image" src="img/ComicsBanner1.jpg">
		</div>
        <hr>
        <div class="row">
            <div class="container">
                    <div class="barTitle">
                       <h3>Report Error(s)</h3> 
                    </div>
                    <hr>
                    <div class="barContent">
                        <p>
                            <b>Report Spoiler: </b>
                            Revealing spoilers about upcoming issues is forbidden, if any is found please report them.
                        </p>
                        <p>
                            <b>Other problems: </b>
                            <br>
                            --Please provide <b>as many details</b> as possible, include useful information such as screenshots and send us a message.
                        </p>
                        <br>
                        <div class="rowcol-xs-offset-1">
                            <label>Enter report here:</label>
                        </div>
                        <form method="POST" action="WebApp Report.php">
							<textarea id = "myTextArea" rows = "3" cols = "80" placeholder="Your text here..." name="reportText"></textarea>
							<br>
							<a href="#"><button type="submit" class="btn btn-success" name="report" onclick="myFunction1();">Submit</button></a>
						</form>
                    </div>
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
    function myFunction1() {
        alert("Thank you!");    
    }
    
    $(document).ready(function() {  
     
    });  
</script>
