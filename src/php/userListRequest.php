<?php
include_once '../php/dbh.php';
$sql = " SELECT username FROM user;";
$username = array();

$select = mysqli_query($connect,$GLOBALS['sql']);
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['username'][] = $row["username"];
        
    }
}



echo json_encode(
    array(
        'username' => $username
    )
);
