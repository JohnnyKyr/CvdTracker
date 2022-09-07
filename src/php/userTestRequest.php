<?php
session_start();
include '../php/dbh.php';
$error = false;
$username = $_SESSION['username'];
$date = $_POST['date'];

$timestamp = "";
$status =1;
$sql = "SELECT cast(covid as date) from hascovid where id ='$username' ORDER BY (covid) DESC LIMIT 1";

$select = mysqli_query($connect, $sql);
if(!mysqli_num_rows($select)){
    $status=2;
}

    $row = mysqli_fetch_assoc($select);
    
    $GLOBALS['timestamp'] = $row["cast(covid as date)"];
    
    if($date > date('Y-m-d', strtotime('+14 days', strtotime($timestamp)))){
        $status = 0;
        

    }
    

if($status ==0 || $status==2){
    $sql1 = "INSERT INTO hasCovid(id,covid,status) VALUES('$username','$date','active')";
        $select2 = mysqli_query($connect, $sql1);
}else if($status==1 ){
    $error = true;
}


echo json_encode(
    array(
        'messages' => $date,
        'error' => $error
    )
);

?>