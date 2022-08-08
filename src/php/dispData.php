<?php
    require_once 'dbh.php';

    $lat = $_POST['lat'];
    $lng = $_POST['lng'];


  
    $id = array();
    $name = array();
    $rating = array();
    $data = array();
    $address = array();
    
    $day = "Saturday";
    $query = "select popularity.data,poi.name,poi.id,
     poi.address,poi.rating from poi inner join popularity on poi.id=popularity.popID
      where poi.lat='$lat' and poi.lng='$lng'";
    
    function getCoords($connect){
        
        $select = mysqli_query($connect,$GLOBALS['query']);
        if(mysqli_num_rows($select) ){
            $row = mysqli_fetch_assoc($select);
            
                
                $GLOBALS['id'][] = $row["id"];
                $GLOBALS['name'][] = $row["name"];
                $GLOBALS['rating'][] = $row["rating"];
                $GLOBALS['data'][] = $row["data"];
                $GLOBALS['address'][] = $row["address"];
            
        }
    }


    getCoords($connect);

    echo json_encode(
        array(
            'id' => $id,
            'name'=> $name,
            'rating'=>$rating,
            'data'=>$data,
            'address'=>$address
        )
    );

    ?>

