<?php include "navBar.php";?>
<?php
include "connect.php";
    $hairStyle = $_GET['title'];
?>
<html>
    <head>
        <title>
            Add Customer
        </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    </head>
    <style>
        .form{
            font-family: 'Arvo', serif;
        }
    </style>
    <body>
        <div class='container-fluid'>
            <div class='col-md-5 col-md-offset-3'>
                <h2 class='form'> <?php echo $hairStyle;?> </h2> <hr>
                <form class='form' method="POST" action="addCust.php">
                    <div class='form-group'>
                                 <?php
                                    $result = mysqli_query($conn, "SELECT * FROM pictures WHERE title = '$hairStyle'");
                                 
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<img src='{$row['picture']}' class='imageView' id='hairCut' alt='{$row['title']}'>
                                        <br><br>
                                        <strong>DATE TAKEN:</strong> {$row['date']}";
                                       
                                    }
                                 ?>
                    </div>
                    
                    
                    <div class='form-group'>
                        <label> Customer </label> <br>
                        <?php
                            $query = "SELECT name FROM customers AS C
                                        JOIN pictures AS P 
                                        ON C.customerId = P.custId
                                        WHERE C.customerId = P.custId 
                                        AND P.title = '$hairStyle'";

                            $retQ = mysqli_query($conn, $query);
                            while($row2 = mysqli_fetch_array($retQ)){
                                echo $row2['name'];
                            }
                        ?> <br><br>
                        <label> Barber </label> <br>
                        <?php
                            $query = "SELECT bname FROM barbers AS B
                                    JOIN pictures AS P 
                                    ON B.barberId = P.barbId
                                    WHERE B.barberId = P.barbId 
                                    AND P.title = '$hairStyle'";

                            $retQ = mysqli_query($conn, $query);
                                while($row2 = mysqli_fetch_array($retQ)){
                                    echo $row2['bname'];
                                }
                        ?><br><br>
                        <label> Hair Type </label> <br>
                        
                                    <?php 
                                    
                                        $result2 = mysqli_query($conn, "SELECT * FROM pictures WHERE title = '$hairStyle'");
                                    
                                        while($row2 = mysqli_fetch_array($result2)){
                                            echo $row2['type'];
                                            $length = $row2['length'];
                                            $condition = $row2['hairCondition'];
                                            $color = $row2['origHairColor'];
                                            $description = $row2['description'];
                                            $dye = $row2['hairDye'];
                                        }
                                    ?> <br><br>
                        
                        <label> Hair Length </label> <br>
                        <?php
                            echo $length;
                        ?>
                        <br><br>
                        
                        <label> Hair Condition </label> <br>
                        <?php
                            echo $condition;
                        ?> <br><br>
                        
                        <label> Original Hair Color </label> <br>
                        <?php
                            echo $color;
                        ?> <br>
                        <br>
                        <label> Hair Dye </label> <br>
                        <?php
                            echo $dye;
                        ?> <br>
                        <br>
                        <label> Description: </label><br>
                        <?php
                            echo $description;
                        ?> <br>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                 .attr('src', e.target.result)
                 .width(241)
                 .height(251);
            };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>