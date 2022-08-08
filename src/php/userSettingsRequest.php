<?php
session_start();
include '../php/dbh.php';
include_once '../php/functions.php';



$username = $_POST['username'];
$password = $_POST['password'];


$ok = true;
$messages = array();


if(usernameExists($connect, $username)){
    $ok = false;
    $messages[0] = 0;
}else{
    $messages[0] = 1;
}

if(emptyInputSignup($username)){
    $ok = false;
    $messages[1] = 0;
}else{
    $messages[1] = 1;
}

// update username
if ($messages[0] == 1 && $messages[1] == 1){
    updateUser($connect,$_SESSION["username"],$username);
    $_SESSION['username'] = $username;
}

if(emptyPassword($password)){
    $ok = false;
    $messages[2] = 0;
}else{
    $messages[2] = 1;
}

if(smallPassword($password)){
    $ok = false;
    $messages[3] = 0;
}else{
    $messages[3] = 1;
}

if(validPassword($password) !== false){
    $ok = false;
    $messages[4] = 0;
}else{
    $messages[4] = 1;
}

// update password
if($messages[2] == 1 && $messages[3] == 1 && $messages[4] == 1){
    updatePassword($connect,$_SESSION["username"],$password);
}





echo json_encode(
    array(
        'ok' => $ok,
        'messages' => $messages
    )
);

?>