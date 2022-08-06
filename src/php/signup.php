<?php


$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

require_once 'dbh.php';
require_once 'functions.php';

$ok = true;
$messages = array();

if (emptyInputSignup($username) !== false) {
    $ok = false;
    $messages[0] = 0;
}else{
    $messages[0] = 1;
}

if (invalidUsername($username) !== false){
    $ok = false;
    $messages[1] = 0;
}else{

    $messages[1] = 1;
}

if (usernameExists($connect, $username) !== false) {
    $ok = false;
    $messages[2] = 0;
}else{

    $messages[2] = 1;
}

if($messages[0] == 1 && $messages[1] == 1 && $messages[2] == 1){
    $messages[8] = 1;
}


if (emptyEmail($email) !== false) {
    $ok = false;
    $messages[3] = 0;
}else{
    $messages[3] = 1;
}

if (invalidEmail($email) !== false) {
    $ok = false;
    $messages[4] = 0;
}else{
    $messages[4] = 1;
}

if($messages[3] == 1 && $messages[4] == 1 ){
    $messages[9] = 1;
}

if (emptyPassword($password) !== false){
    $ok = false;
    $messages[5] = 0;
}else{
    $messages[5] = 1;
}

if (smallPassword($password) !== false) {
    $ok = false;
    $messages[6] = 0;
}else{
    $messages[6] = 1;
}

if (validPassword($password) !== false) {
    $ok = false;
    $messages[7] = 0;
}else{
    $messages[7] = 1;
}

if($messages[5] == 1 && $messages[6] == 1 && $messages[7] == 1){
    $messages[10] = 1;
}


if($ok == true){

    echo json_encode(
        array(
            'ok' => $ok,
            'messages' => $messages
        )
    );

    createUser($connect, $username, $password, $email);
    exit;
}

echo json_encode(
    array(
        'ok' => $ok,
        'messages' => $messages
    )
);

?>
