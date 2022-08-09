
<?php
session_start();

$username =  $_SESSION["username"];

echo json_encode(
    array(
        'username' => $username
    )
);


?>
