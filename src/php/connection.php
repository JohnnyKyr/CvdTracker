<?php 
$server = "localhost";
$user = "root";
$ps = "";
$database = "covidtrack";

$connect = mysqli_connect($server, $user, $ps, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}

 ?>