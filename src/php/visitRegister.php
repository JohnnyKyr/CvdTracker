<?php
    require_once 'dbh.php';
    $poiId = $_POST['poiID'];
    $username = $_POST['userID'];
    
    $query = "INSERT INTO place(poiID,userID,tmstmp,numofp) VALUES($poiId,$username,NULL,NULL) "; 
    $select = mysqli_query($connect, $query);
  
    ?>