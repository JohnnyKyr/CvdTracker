<?php
    require_once 'dbh.php';

    $lng = array();
    $lat = array();

    $data = array();
  
    
    $day = "Saturday";
    $query = "select popularity.data,poi.lat,poi.lng from poi inner join popularity on poi.id=popularity.popID
      where popularity.day='$day';";
    
    function getCoords($connect){
        
        $select = mysqli_query($connect,$GLOBALS['query']);
        if(mysqli_num_rows($select) ){
            while($row = mysqli_fetch_assoc($select)){
               
                $GLOBALS['lat'][] = $row["lat"];
                $GLOBALS['lng'][] = $row["lng"];
                $GLOBALS['data'][] = $row["data"];
               
            }
        }
    }


    getCoords($connect);

    echo json_encode(
        array(
            'lat' => $lat,
            'lng' => $lng,
            'data'=>$data
        )
    );

    ?>