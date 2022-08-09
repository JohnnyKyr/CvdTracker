<?php
session_start();
include '../php/dbh.php';

$username = $_SESSION['username'];
$date = $_POST['date'];

$sql = ("UPDATE user SET cvdtmstmp = '$date' WHERE username = '$username'");
$select = mysqli_query($connect, $sql);


echo json_encode(
    array(
        'messages' => $date
    )
);

?>