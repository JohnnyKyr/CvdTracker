<?php
session_start();
$userID = $_SESSION['username'];
include_once '../php/dbh.php';

$sql = " SELECT username FROM user;";
$sqli = "SELECT cvdtmstmp FROM user WHERE username = '$userID' ";

$username = array();
$cvdtmstmp = array();

$select = mysqli_query($connect,$GLOBALS['sql']);
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['username'][] = $row["username"];
        
    }
}

$select = mysqli_query($connect,$GLOBALS['sqli']);
if(mysqli_num_rows($select) ){

    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['cvdtmstmp'][] = $row["cvdtmstmp"];
        
    }
}


echo json_encode(
    array(
        'username' => $username,
        'cvdtmstmp' => $cvdtmstmp
    )
);
