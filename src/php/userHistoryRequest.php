<?php
session_start();
$userID = $_SESSION['username'];
include_once '../php/dbh.php';
 

$sql = " SELECT poi.name, place.tmstmp FROM poi INNER JOIN place ON poi.id = place.poiID AND place.userID = '$userID' ORDER BY place.tmstmp ASC";
$sqli = "SELECT covid FROM hasCovid WHERE id = '$userID' ORDER BY covid ASC";

$place = array();
$placetmstmp = array();
$cvdtmstmp = array();

$select = mysqli_query($connect,$GLOBALS['sql']);

if(mysqli_num_rows($select) ){
    
    while($row = mysqli_fetch_assoc($select)){
        
        $GLOBALS['place'][] = $row["name"];
        $GLOBALS['placetmstmp'][] = $row["tmstmp"];
        
    }
}

$select = mysqli_query($connect,$GLOBALS['sqli']);
if(mysqli_num_rows($select) ){
    
    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['cvdtmstmp'][] = $row["covid"];
        
    }
}


echo json_encode(
    array(
        'place' => $place,
        'placetmstmp' => $placetmstmp,
        'cvdtmstmp' => $cvdtmstmp
    )
);
