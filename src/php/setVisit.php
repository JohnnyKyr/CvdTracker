<?php
    require_once 'dbh.php';
    $poiId = $_POST['poiID'];
    $username = $_POST['userID'];
    $numofp = $_POST['numOfP'];
    $query = "INSERT INTO place(poiID,userID,numofp) VALUES('$poiId','$username', '$numofp') "; 
    $select = mysqli_query($connect, $query);
   
    ?>
