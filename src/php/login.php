<?php
$server = "localhost";
$user = "root";
$ps = "";
$database = "test";

$connect = mysqli_connect($server, $user, $ps, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$userQuery = "INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')";
$result = mysqli_query($connect, $userQuery);
if (!$result){
    die("Could not run query". mysqli_error($connect));
}
else{
   readfile("../html/map.html");
}

?>