<?php
    require_once 'dbh.php';
    $poiId = $_POST['poiID'];
    $username = $_POST['userID'];
   
    $query = "INSERT INTO place(poiID,userID,numofp) VALUES('$poiId','$username', NULL) "; 
    $select = mysqli_query($connect, $query);
   
    ?>
