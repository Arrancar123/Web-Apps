<?php
include "connect.php";
            
                if(isset($_POST["addCust"])) {
                    
                    $customer = $_POST['customerName'];
                    $barber = $_POST['barberName'];
                    $description = $_POST['description'];
                    $title = $_POST['title'];
                    
                    $type = $_POST['type'];
                    $color = $_POST['color'];
                    $condition = $_POST['condition'];
                    $length = $_POST['length'];
                    $dye = $_POST['dye'];
                    
                    $target_dir = "uploads/";
                    
                    $count = 1;
                    
                    while(is_dir($target_dir)){
                        $target_dir="{$count}uploads/";
                        $count++;
                    }
                    
                    mkdir($target_dir);
                    
                    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
                    $pathto = $target_dir.$_FILES["picture"]["name"];

                    move_uploaded_file( $_FILES['picture']['tmp_name'],$pathto);

                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    
                    $check = mysqli_query($conn, "SELECT * FROM pictures WHERE title = '$title'");
                    
                    $custCheck = mysqli_query($conn, "SELECT * FROM customers WHERE name = '$customer'");
                    
                    $barbCheck = mysqli_query($conn, "SELECT * FROM barbers WHERE bname = '$barber'");
                    
                    if(mysqli_num_rows($check) == 1){
                        $message = "That title already exists, please choose another!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        header("location:add.php");
                    }else if(mysqli_num_rows($custCheck) != 1 && mysqli_num_rows($barbCheck) != 1){
                        $sqlCust = "INSERT INTO customers (customerId, name)
                                VALUES (null, '$customer')";
                        mysqli_query($conn, $sqlCust);
                        
                        $sqlBarb = "INSERT INTO barbers (barberId, bname)
                                VALUES (null, '$barber')";

                        mysqli_query($conn, $sqlBarb);
                        
                        foreach($type as $t){
                            foreach($color as $c){
                                foreach($condition as $co){
                                    foreach($length as $l){
                                        if($type && $color && $condition && $length){

                                            $sqlAdd = "INSERT INTO pictures 
                                                      (picId, custId, barbId, title, description, hairCondition, type, origHairColor, hairDye, date, length, picture) 
                                                       VALUES (null, 
                                                     (SELECT customerId FROM customers WHERE name = '$customer'), 
                                                      (SELECT barberId FROM barbers WHERE bname = '$barber'), 
                                                      '$title', '$description', '$co', '$t', 
                                                      '$c', '$dye', CURRENT_TIMESTAMP, '$l', '$target_file'
                                                         )";

                                            mysqli_query($conn, $sqlAdd);

                                            $message = "Customer has been added to database!";
                                            echo "<script type='text/javascript'>alert('$message');</script>";
                                            header("location:Home.php");
                                        }
                                    }
                                }
                            }
                        }
                    }else if(mysqli_num_rows($barbCheck) != 1){
                        $sqlBarb = "INSERT INTO barbers (barberId, bname)
                                VALUES (null, '$barber')";

                        mysqli_query($conn, $sqlBarb);
                        
                        foreach($type as $t){
                            foreach($color as $c){
                                foreach($condition as $co){
                                    foreach($length as $l){
                                        if($type && $color && $condition && $length){

                                            $sqlAdd = "INSERT INTO pictures 
                                                      (picId, custId, barbId, title, description, hairCondition, type, origHairColor, hairDye, date, length, picture) 
                                                       VALUES (null, 
                                                     (SELECT customerId FROM customers WHERE name = '$customer'), 
                                                      (SELECT barberId FROM barbers WHERE bname = '$barber'), 
                                                      '$title', '$description', '$co', '$t', 
                                                      '$c', '$dye', CURRENT_TIMESTAMP, '$l', '$target_file'
                                                         )";

                                            mysqli_query($conn, $sqlAdd);

                                            $message = "Customer has been added to database!";
                                            echo "<script type='text/javascript'>alert('$message');</script>";
                                            header("location:Home.php");
                                        }
                                    }
                                }
                            }
                        }
                        
                    }else if(mysqli_num_rows($custCheck) != 1){
                        $sqlCust = "INSERT INTO customers (customerId, name)
                                VALUES (null, '$customer')";
                        mysqli_query($conn, $sqlCust);
                        
                        foreach($type as $t){
                            foreach($color as $c){
                                foreach($condition as $co){
                                    foreach($length as $l){
                                        if($type && $color && $condition && $length){

                                            $sqlAdd = "INSERT INTO pictures 
                                                      (picId, custId, barbId, title, description, hairCondition, type, origHairColor, hairDye, date, length, picture) 
                                                       VALUES (null, 
                                                     (SELECT customerId FROM customers WHERE name = '$customer'), 
                                                      (SELECT barberId FROM barbers WHERE bname = '$barber'), 
                                                      '$title', '$description', '$co', '$t', 
                                                      '$c', '$dye', CURRENT_TIMESTAMP, '$l', '$target_file'
                                                         )";

                                            mysqli_query($conn, $sqlAdd);

                                            $message = "Customer has been added to database!";
                                            echo "<script type='text/javascript'>alert('$message');</script>";
                                            header("location:Home.php");
                                        }
                                    }
                                }
                            }
                        }
                        
                    }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

                        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        echo "<script type='text/javascript'>alert('$message');</script>";

                    }else{
                    
                    foreach($type as $t){
                        foreach($color as $c){
                            foreach($condition as $co){
                                foreach($length as $l){
                                    if($type && $color && $condition && $length){
                                        
                                        $sqlAdd = "INSERT INTO pictures 
                                                  (picId, custId, barbId, title, description, hairCondition, type, origHairColor, hairDye, date, length, picture) 
                                                   VALUES (null, 
                                                 (SELECT customerId FROM customers WHERE name = '$customer'), 
                                                  (SELECT barberId FROM barbers WHERE bname = '$barber'), 
                                                  '$title', '$description', '$co', '$t', 
                                                  '$c', '$dye', CURRENT_TIMESTAMP, '$l', '$target_file'
                                                     )";

                                        mysqli_query($conn, $sqlAdd);

                                        $message = "Customer has been added to database!";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
                                         header("location:Home.php");
                                    }
                                }
                            }
                        }
                    }
                }
            }
            ?>