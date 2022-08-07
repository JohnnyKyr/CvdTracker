<?php
session_start();
include '../php/dbh.php';
include_once '../php/functions.php';



$username = $_POST['username'];
$password = $_POST['password'];


$ok = true;
$message = 900;


if(usernameExists($connect, $username)){
    $ok = false;
    $message = 0;
}else{
    $message = 1;
    updateUser($connect,$_SESSION["username"],$username);
}






echo json_encode(
    array(
        'ok' => $ok,
        'message' => $message
    )
);

?>