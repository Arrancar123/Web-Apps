<?php
    $conn = mysqli_connect("localhost", "root", "", "login");

	if(!$conn){
		echo "Error connecting to database";
		exit();
	}
?>
