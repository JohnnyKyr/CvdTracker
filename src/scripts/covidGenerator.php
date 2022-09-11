<?php

require_once "../php/dbh.php";

$username = array();
$poi= array();

$select = mysqli_query($connect,"SELECT username FROM user");
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['username'][] = $row["username"];
        
    }
}
$userlength = count($username);


$i=0;
$day = 31;


while(1){
    $k = rand(0,$userlength-1);
    
    $numofp = rand(0,100);

    $select = mysqli_query($connect, "call dateConflict($day,'$username[$k]');");
    
    if($i%$userlength*4==0){
        
            if($day==1){
                break;
            }
            $day--;
        }
    $i++;
}




?>