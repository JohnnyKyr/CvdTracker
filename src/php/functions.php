<?php

function emptyInputSignup($username){
    $result;
    if(empty($username)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function usernameExists($connect, $username){
    $select = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($select)){
    return true;
    }else{
        return false;
    }
}

function invalidUsername($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function emptyEmail($email){
    $result;
    if(empty($email)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function emptyPassword($password){
    $result;
    if(empty($password)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function smallPassword($password){
    $result;
    if(strlen($password) < 8) {
       return true;
    }else{ return false; }
}

function validPassword($password){
    $result;
    if(!preg_match("/^([a-z0-9\!\@\#\$\%\^\&\*]*([A-Z]+)[a-z0-9\!\@\#\$\%\^\&\*]*)+$/", $password)) {
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}


function createUser($connect, $username, $password, $email,$privilages){
    $sql = "INSERT INTO user (username, password, email,privilages) VALUES (?, ?, ?,?);";
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }

    $hashedPassowrd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssi", $username, $hashedPassowrd, $email, $privilages);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //exit();
    
}


function doNotMatch($connect,$username, $password){
    $select = mysqli_query($connect, "SELECT password FROM user WHERE username = '$username'");
    if(mysqli_num_rows($select) ){
        while($hash = mysqli_fetch_assoc($select)){
            if (!password_verify($password, $hash["password"])) {return true;} }
        
    }else{
        return false;
    }
}

function updateUser($connect,$username,$newUsername){

    $sql = "UPDATE user SET username = '$newUsername'  WHERE username = '$username'";
    $select = mysqli_query($connect, $sql);
}

function isAdmin($connect,$username){
    $sql = "SELECT privilages FROM user WHERE username = '$username'";
    $select = mysqli_query($connect,$sql);
    
    if(!mysqli_num_rows($select)){
        return false;
    }
    $response= mysqli_fetch_assoc($select);
    
    if($response['privilages'][0] == 0){
        return false;
    }else{
        return true;
    }
}

function updatePassword($connect,$username,$password){
        $hashedPassowrd = password_hash($password, PASSWORD_DEFAULT);
        $sql = ("UPDATE user SET password = '$hashedPassowrd' WHERE username = '$username'");
        $select = mysqli_query($connect, $sql);
    
}

?>