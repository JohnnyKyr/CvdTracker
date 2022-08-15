<?php
require_once 'dbh.php';
$dates = array();
$values = array();
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];   

$sql = ("SELECT DISTINCT cast(tmstmp as date) FROM place WHERE cast(tmstmp as date) >= '$startDate' AND cast(tmstmp as date) <= '$endDate' ORDER BY (cast(tmstmp as date)) ASC;");
$select = mysqli_query($connect,$GLOBALS['sql']);

if(mysqli_num_rows($select) ){
    
    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['dates'][] = $row["cast(tmstmp as date)"];
        
    }
}



for($i = 0; $i < sizeof($dates); $i++){
   
    $sql = ("SELECT COUNT(tmstmp) FROM PLACE WHERE cast(tmstmp as date) = '$dates[$i]'");
    $select = mysqli_query($connect,$GLOBALS['sql']);
    $row = mysqli_fetch_assoc($select);
    $GLOBALS['values'][] = $row["COUNT(tmstmp)"];
    // print_r($row["COUNT(tmstmp)"]);

}

echo json_encode(
    array(
        'dates' => $dates,
        'values' => $values

    )
);
?>