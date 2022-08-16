<?php
require_once 'dbh.php';
$dates = array();
$values = array();
$hours = array();
$startDate = $_POST['startDate'];
$allHours = array();

$dates = [$startDate];

$sql = ("SELECT DISTINCT HOUR(tmstmp) FROM place WHERE cast(tmstmp as date) = '$startDate' ORDER BY (HOUR(tmstmp)) ASC;");
$select = mysqli_query($connect,$GLOBALS['sql']);

if(mysqli_num_rows($select) ){
    
    while($row = mysqli_fetch_assoc($select)){
        $GLOBALS['hours'][] = $row["HOUR(tmstmp)"];
        
    }

}

for($i = 0; $i < sizeof($hours); $i++){
   
    $sql = ("SELECT COUNT(tmstmp) FROM PLACE WHERE cast(tmstmp as date) = '$startDate' AND HOUR(tmstmp) = '$hours[$i]';");
    $select = mysqli_query($connect,$GLOBALS['sql']);
    $row = mysqli_fetch_assoc($select);
    $GLOBALS['values'][] = $row["COUNT(tmstmp)"];


}

$j = 0;
for ($i = 0; $i < 24; $i++){
    if(!in_array($i, $hours)){
        $allHours[] = 0;
    }else{
        $allHours[] = $values[$j];
        $j++;
    }
}


echo json_encode(
    array(
        'dates' => $dates,
        'allHours' => $allHours
        

    )
);
?>