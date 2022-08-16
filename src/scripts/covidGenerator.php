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


while($i <$userlength*4*30){
    $k = rand(0,$userlength-1);
    
    $numofp = rand(0,100);
    $query = "INSERT INTO hasCovid(ID,covid,status) VALUES('$username[$k]',CURRENT_TIMESTAMP - INTERVAL '$day' DAY ,'positive') "; 
    $select = mysqli_query($connect, $query);
    
    if($i%$userlength*4==0){
        
        
            if($day==1){
                break;
            }
            $day--;
        }
    $i++;
}




?>