<?php

if(isset($_POST['submit'])){
    $file = $_FILES['files']['name'];
    $temp_location = $_FILES['files']['tmp_name'];

    $fileDestination = 'uploads/'. $file;
    echo $fileDestination;
    move_uploaded_file($temp_location, $fileDestination);
    header("location: ../html/adminDashboard.php");
}
?>