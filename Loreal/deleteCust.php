<?php
    require("connect.php");

    $sql = "DELETE FROM customers WHERE customerId = '{$_POST['data']}'";

    $ret = mysqli_query($conn, $sql);
        

?>