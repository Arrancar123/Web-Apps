<?php
    include "connect.php";
        if(isset($_POST['searchBtn'])){
            $keyword = mysqli_real_escape_string($conn, $_POST['search']);

            $searchQuery = 
                    "SELECT * FROM pictures AS P
                    JOIN customers AS C 
                    ON P.custId = C.customerId
                    JOIN barbers AS B
                    ON P.barbId = B.barberId
                    WHERE C.name LIKE '%{$keyword}%'
                    OR B.name LIKE '%{$keyword}%'
                    OR P.title LIKE '%{$keyword}%'
                    ";

            mysqli_query($conn, $searchQuery);
            header("location:searchRes.php?search={$keyword}");
            
        }
    ?>