<?php
session_start();
$userID = $_SESSION['username'];
include_once '../php/dbh.php';

$sql = "call conn('$userID')";
$name = array();
$date = array();

$select = mysqli_query($connect,$GLOBALS['sql']);
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['name'][] = $row["name"];
        $GLOBALS['date'][] = $row["tempdate"];
        
    }
}



echo json_encode(
    array(
        'name' => $name,
        'date' => $date
    )
);
