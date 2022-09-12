<?php
// random user
//reandom place
//random numberofp
require_once "../php/dbh.php";
//require_once "UserGenerator.php";
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

date_default_timezone_set("Europe/Athens");
$date = date('Y-m-d H:i:s');
$userlength = count($username);
$poilength = count($poi);


$i=0;
$day = 62;
$hour = 0;

        while($i <$poilength*4*30*24){
            $k = rand(0,$userlength-1);
            $j = rand(0,$poilength-1);
            $day = rand(1,31);
            $hour = rand(0,2);


            $numofp = rand(0,10);
            $query = "INSERT INTO place(poiID,userID,tmstmp,numofp) VALUES('$poi[$j]','$username[$k]',CURRENT_TIMESTAMP -INTERVAL '$hour' HOUR,'$numofp') "; 
            $select = mysqli_query($connect, $query);
            
            
            $i++;
        }



?>