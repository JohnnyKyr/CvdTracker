<?php
// random user
//reandom place
//random numberofp
require_once "../php/dbh.php";
require_once "UserGenerator.php";
$username = array();
$poi= array();

$select = mysqli_query($connect,"SELECT username FROM user");
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['username'][] = $row["username"];
        
    }
}

$select = mysqli_query($connect,"SELECT id FROM poi");
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['poi'][] = $row["id"];
        
    }
}
$userlength = count($username);
$poilength = count($poi);
$i=0;
while($i <$poilength){
    $k = rand(0,$userlength-1);
    
    $numofp = rand(0,100);
    $query = "INSERT INTO place(poiID,userID,numofp) VALUES('$poi[$i]','$username[$k]','$numofp') "; 
    $select = mysqli_query($connect, $query);
    $i++;
}



?>