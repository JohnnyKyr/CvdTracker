<?php
session_start();
include '../php/dbh.php';

$username = $_SESSION['username'];
$date = $_POST['date'];

$sql = "INSERT INTO hasCovid(id,covid,status) VALUES('$username','$date','active')";
$select = mysqli_query($connect, $sql);


echo json_encode(
    array(
        'messages' => $date
    )
);

?>