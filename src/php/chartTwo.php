<?php
require_once 'dbh.php';


$sql = ("SELECT COUNT(username) as total FROM user");
$select = mysqli_query($connect, $sql);
$total = mysqli_fetch_assoc($select)['total'];


$sql = ("SELECT COUNT(id) as ccNumber FROM hasCovid");
$select = mysqli_query($connect, $sql);
$ccNumber = mysqli_fetch_assoc($select)['ccNumber'];


echo json_encode(
    array(
       "total" => $total,
       "ccNumber" => $ccNumber
    )
);
?>
