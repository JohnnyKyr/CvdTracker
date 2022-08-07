<?php
session_start();

$si_username = $_POST['si_username'];
$si_password = $_POST['si_password'];


require_once 'dbh.php';
require_once 'functions.php';

$ok = true;
$messages = array();

if (emptyInputSignup($si_username) !== false) {
    $ok = false;
    $messages[0] = 0;
}else{
    $messages[0] = 1;
}

if (emptyPassword($si_password) !== false){
    $ok = false;
    $messages[1] = 0;
}else{
    $messages[1] = 1;
}

if(doNotMatch($connect,$si_username, $si_password)){
    $ok = false;
    $messages[2] = 0;
}else{
    $messages[2] = 1;
}

if (!usernameExists($connect,$si_username) !== false){
    $ok = false;
    $messages[3] = 0;
}else{
    $messages[3] = 1;
}

$_SESSION["username"] = $si_username;

echo json_encode(
    array(
        'ok' => $ok,
        'messages' => $messages
    )
);

?>