<?php include 'navBar.php'?>
    <?php
include "connect.php";
            $keyword = $_GET['search'];

            $SR = 
                    "SELECT * FROM pictures AS P
                    JOIN barbers AS B
                    ON P.barbId = B.barberId
                    JOIN customers AS C 
                    ON P.custId = C.customerId
                    WHERE C.name LIKE '%{$keyword}%'
                    OR B.bname LIKE '%{$keyword}%'
                    OR P.title LIKE '%{$keyword}%'
                    ";

            $searchResult = mysqli_query($conn, $SR);
            
    ?>
<html>
    <head>
        <title>
            Search Results
        </title>
    </head>
    <style>
        #displayTable{
            background-color: #e1a566;
            color:white;
            font-family: 'Arvo', serif;
        }
        #data{
            background-color: #d7915a;
            color:white;
            font-family: 'Arvo', serif;
        }
        .tableContainer{
             margin-top: 20px;
        }
        #fullPage{
            background-color:  aliceblue;
            border-color: aliceblue;
            color: #e1a566;

        }
    </style>
    <body>
        <div class='tableContainer'>
            <table class='table table-condensed' id='displayTable'>
                <thead id='displayTable'>
                    <tr>
                        <td>Picture</td>
                        <td>Haircut</td>
                        <td>Customer</td>
                        <td>Barber</td>
                        <td>Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                    
                        while($row = mysqli_fetch_array($searchResult)){
                             echo "<tr id='data'>
                                    <td class='course'>
                                        <a href='viewStyle.php?title={$row['title']}'>
                                        <img src='{$row['picture']}' class='image'>
                                        </a>
                                    </td>
                                    <td class='course'>
                                        <strong> {$row['title']}
                                        </strong>
                                    </td>
                                    <td class='course'>
                                        <strong> {$row['name']}&nbsp&nbsp
                                        </strong>
                                    </td>
                                    <td class='course'>
                                        <strong> {$row['bname']}&nbsp&nbsp
                                        </strong>
                                    </td>
                                    <td class='course'>
                                        <strong>{$row['date']}
                                        </strong>
                                    </td>
                                    <td class='course'>
                                        <a href='viewStyle.php?title={$row['title']}'>
                                        <button id='fullPage' type='button'class='btn btn-success'>Go To Full Page</button>
                                        </a>
                                                  
                                    </td>
                                </tr>";
                                    }    

                                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>