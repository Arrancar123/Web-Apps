<?php include "navBar.php";?>
<?php
    include "connect.php";

?>
<html>
<br>
    <?php
            $count = 1;
                
            $result = "SELECT * FROM pictures";
            $set = mysqli_query($conn, $result);
            while($row = mysqli_fetch_array($set)){
                if($count%6 == 1){
                    echo "<div class='row'>";
                }
                echo "<div class='col-md-2 padd'>
                        <a href='viewStyle.php?title={$row['title']}'>
                            <img src='{$row['picture']}' class='image'>
                        </a>
                        <a href='viewStyle.php?title={$row['title']}' class='link'>
                            <strong class='style'>{$row['title']}</strong>
                        </a>
                        </div>";
                if($count%6 == 0){
                    echo "</div><br>";
                }
                    $count++;
                }
                if ($count%6 != 1){
                     echo "</div>";
                }
        ?>
    <br>
</html>
