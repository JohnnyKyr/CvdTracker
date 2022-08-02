<?php
$server = "localhost";
$user = "root";
$db_password = "";
$database = "covidtrack";

$connect = mysqli_connect($server, $user, $db_password, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}

$lng = array();
$lat = array();
function getPois($connect){
    $select = mysqli_query($connect, "SELECT coords FROM poi ;");
    if(mysqli_num_rows($select) ){
        while($coords = mysqli_fetch_assoc($select)){
            $temp = json_decode($coords["coords"],true);
            $GLOBALS['lat'][] = $temp["lat"];
            $GLOBALS['lng'][] = $temp["lng"];
            
            
        }
    }
}
getPois($connect);

echo json_encode(
    array(
        'lat' => $lat,
        'lng' => $lng
    )
);
