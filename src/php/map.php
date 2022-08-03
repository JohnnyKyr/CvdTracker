<?php
    require_once 'dbh.php';

    $lng = array();
    $lat = array();
    $id = array();
    function getCoords($connect){
        $select = mysqli_query($connect, "SELECT coords,id FROM poi ;");
        if(mysqli_num_rows($select) ){
            while($row = mysqli_fetch_assoc($select)){
                $temp = json_decode($row["coords"],true);
                $GLOBALS['lat'][] = $temp["lat"];
                $GLOBALS['lng'][] = $temp["lng"];
                $GLOBALS['id'][] = $row["id"];
                
            }
        }
    }


    getCoords($connect);

    echo json_encode(
        array(
            'lat' => $lat,
            'lng' => $lng,
            'id' => $id
        )
    );
