<?php
$server = "localhost";
$user = "root";
$db_password = "";
$database = "covidtrack";

$connect = mysqli_connect($server, $user, $db_password, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}