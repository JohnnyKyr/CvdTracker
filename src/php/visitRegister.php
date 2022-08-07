<?php
    require_once 'dbh.php';
    $poiId = $_POST['poiID'];
    $username = $_POST['userID'];
    $tmstmp = $_POST['tmstmp'];
    $numofp = $_POST['numofp'];
    
    $query = "INSERT INTO place(poiID,userID,tmstmp,numofp) VALUES($poiId,$username,$tmstmp,$numofp) "; 
    $select = mysqli_query($connect, $query);
  
    ?>