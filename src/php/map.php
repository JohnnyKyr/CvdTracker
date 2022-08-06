<?php
    require_once 'dbh.php';

    $lng = array();
    $lat = array();
    $id = array();
    $name = array();
    $rating = array();
    $data = array();
    $address = array();
    
    $day = "Friday";
    $query = "select popularity.data,poi.name,poi.id,poi.coords,
     poi.address,poi.rating from poi inner join popularity on poi.id=popularity.popID
      where popularity.day='$day';";
    
    function getCoords($connect){
        
        $select = mysqli_query($connect,$GLOBALS['query']);
        if(mysqli_num_rows($select) ){
            while($row = mysqli_fetch_assoc($select)){
                $temp = json_decode($row["coords"],true);
                $GLOBALS['lat'][] = $temp["lat"];
                $GLOBALS['lng'][] = $temp["lng"];
                $GLOBALS['id'][] = $row["id"];
                $GLOBALS['name'][] = $row["name"];
                $GLOBALS['rating'][] = $row["rating"];
                $GLOBALS['data'][] = $row["data"];
                $GLOBALS['address'][] = $row["address"];
            }
        }
    }


    getCoords($connect);

    echo json_encode(
        array(
            'lat' => $lat,
            'lng' => $lng,
            'id' => $id,
            'name'=> $name,
            'rating'=>$rating,
            'data'=>$data,
            'address'=>$address
        )
    );

    ?>