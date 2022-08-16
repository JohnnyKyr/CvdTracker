<?php
require_once 'dbh.php';

$sql = ("DELETE FROM poi");
$select = mysqli_query($connect, $sql);

echo json_encode(
    array(
        'ok' => 'ok'
    )
);
?>