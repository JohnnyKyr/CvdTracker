<?php
    require_once 'dbh.php';

    $lat = $_POST['lat'];
    $lng = $_POST['lng'];


  
    $id = "";
    $name = "";
    $rating = "";
    $data = "";
    $address = "";
    $numofp = "";   

    date_default_timezone_set('Europe/Paris');
    $day = date('l');
    
    $query = "select popularity.data,poi.name,poi.id,
    poi.address,poi.rating from poi inner join popularity on poi.id=popularity.popID
     where poi.lat='$lat' and poi.lng='$lng'";
    
    function getCoords($connect){
        
        $select = mysqli_query($connect,$GLOBALS['query']);
        if(mysqli_num_rows($select) ){
            $row = mysqli_fetch_assoc($select);
            
                
                $GLOBALS['id'] = $row["id"];
                $GLOBALS['name'] = $row["name"];
                $GLOBALS['rating'] = $row["rating"];
                $GLOBALS['data'] = $row["data"];
                $GLOBALS['address'] = $row["address"];
                
            
        }
    }


    function getNumOfP($connect,$id){
        $select = mysqli_query($connect,"SELECT numofp FROM place WHERE poiID = '$id'");
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                $GLOBALS['numofp'] = $row["numofp"];
            }
    }


    getCoords($connect);
    getNumOfP($connect,$id);
    echo json_encode(
        array(
            'id' => $id,
            'name'=> $name,
            'rating'=>$rating,
            'data'=>$data,
            'address'=>$address,
            'numofp' =>$numofp
        )
    );

    ?>

