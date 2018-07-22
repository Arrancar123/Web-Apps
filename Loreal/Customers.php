<?php include_once'navBar.php'?>
<?php
    include "connect.php";
    
    $allCust = "SELECT * FROM pictures AS P
                JOIN customers AS C
                ON P.custId = C.customerId ORDER BY name";
    $allQuery = mysqli_query($conn, $allCust);

    

    $allQuery1 = mysqli_query($conn, $allCust);

?>
<html>
    <head>
        <title>
            Customers
        </title>
        
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel='stylesheet' type="text/css" href="DataTables-1.10.18/css/dataTables.bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        
    </head>
    <style>
        #customerTable{
            margin-top: 15px;
            width:100%;
        }
        #customerTableHeader{
            background-color: #e1a566;
            color:white;
            font-family: 'Arvo', serif;
        }
        .tableContainer{
            margin-top: 20px;
        }
    </style>
    <body>
        <!--Modal test-->
        <?php
        
        while($roww = mysqli_fetch_array($allQuery1)){
        
            echo"
                <div class='modal fade' id='customerModal{$roww['custId']}{$roww['picId']}' tabindex='-1' role='dialog' aria-labelledbye='customerModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='customerModalLabel'>View Pictures</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>

                            <div class='modal-body'>";

                        $modalPics = "SELECT * FROM pictures AS P
                                    JOIN customers AS C
                                    ON P.custId = C.customerId
                                    WHERE P.custId = {$roww['custId']}";
                            
                    echo "
                        <img src = '{$roww['picture']}' class='imageModal'>
                        <br><br>
                        <strong class='style' style: 'text-align:center;'>{$roww['title']}</strong>
                        </div>

                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>    
                </div>";
        }
        ?>

        
        <div class='container-fluid'>
            <div class='tableContainer'>
                <table id='customerTable' class='table-condensed'>
                    <thead id='customerTableHeader'>
                        <tr>
                            <th>View</th>
                            <th>Customer</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($allQuery)){
                                echo "<tr>
                                <td class='course'>
                                    <button class='btn btn-primary' role='button' data-toggle='modal' data-target='#customerModal{$row['customerId']}{$row['picId']}'> View <span class='glyphicon glyphicon-eye-open'></span> </button>        
                                </td>
                                <td class='course'>
                                    {$row['name']}
                                </td>
                                <td class='course'>
                                <button type='submit' class='btn btn-danger delete_btn' name='delete' id = '{$row['customerId']}'>
                                     Delete <span class='glyphicon glyphicon-trash'> </span>
                                </button>
                                </td>
                                </tr>";
                            }    
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<script type='text/javascript' src='jquery-3.2.1.min.js'></script>
<script type='text/javascript' src='DataTables-1.10.18/js/jquery.dataTables.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#customerTable').DataTable();
        
        $(".delete_btn").on("click", function(){
        var custId = this.id;
 
            $.ajax({
                    url: "deleteCust.php",
                    method: "POST",
                    data :{
                        data: custId
                    },
                    success: function(data){
                        alert("This customer has been deleted.");
                        location.reload();   
                    },

            });
		
        });
    });
</script>