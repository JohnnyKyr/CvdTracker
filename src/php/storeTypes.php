<?php


session_start();
include 'dbh.php';
$sql1 = "SELECT types from poi INNER JOIN place on place.poiID = poi.id ";
$sql2 = "SELECT types from poi INNER JOIN place on place.poiID = poi.id INNER JOIN hascovid ON place.userID = hascovid.id WHERE day(hascovid.covid)>=day(hascovid.covid - INTERVAL 7 DAY) AND day(hascovid.covid)<=day(hascovid.covid + INTERVAL 14 DAY)";
$select1 = mysqli_query($connect, $sql1);
$select2 = mysqli_query($connect, $sql2);


$types = array();
$covidtypes =array();
function typeParse($select){



    while($row = mysqli_fetch_assoc($select)){
        //print_r(var_dump(json_decode( $row["types"])[0]).'<br>');
        $temp = json_decode( $row["types"])[0];
        $GLOBALS["types"][$temp] ++;
    }

arsort($GLOBALS["types"]);
}

function covidTypeParse($select){



    while($row = mysqli_fetch_assoc($select)){
        //print_r(var_dump(json_decode( $row["types"])[0]).'<br>');
        $temp = json_decode( $row["types"])[0];
        $GLOBALS["covidtypes"][$temp] ++;
    }

arsort($GLOBALS["covidtypes"]);
}

@typeParse($select1);
@covidTypeParse($select2);

echo json_encode(
    array(
       "types" => $types,
       "covidtypes" => $covidtypes
    )
);

?>

