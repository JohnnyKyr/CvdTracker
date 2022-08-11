<?php
include_once '../php/dbh.php';


$sql = " SELECT place.name FROM place INNER JOIN user on user.username = place.userID INNER JOIN hasCovid on user.username=hasCovid.id where hascovid.status = 'active' and  where hour(place.tmstmp) >=hour(current_timestamp())-2 and hour(place.tmstmp) <=hour(current_timestamp())+2;";
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
