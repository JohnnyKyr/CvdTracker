<?php
session_start();

require_once '../php/dbh.php';
$userID = $_SESSION["username"];
$day = '';

$sql = "SELECT covid FROM hasCovid WHERE id='$userID' ORDER BY(covid) DESC LIMIT 1";
$select = mysqli_query($connect,$sql);

if(mysqli_num_rows($select) ){
    $row = mysqli_fetch_assoc($select);
    $day = $row['covid'];
    $day = date('Y-m-d', strtotime('+14 days', strtotime($day)));

}

// testarw thetontas day = se ligo
echo json_encode(
    array(
        'day' => $day,
    )
);

?>