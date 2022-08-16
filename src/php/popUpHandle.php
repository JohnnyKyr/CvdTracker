<?php
    require_once "dbh.php";
    $id = $_GET['id'];

    $name = array();
    $rating = array();
    $data = array();
    $address = array();
    
    $day = "Friday";
    
    $query = "select popularity.data,poi.name,  poi.address,poi.rating from poi inner join popularity on poi.id=popularity.popID where poi.id=$id and popularity.day=$day;";
    
    function popularityH($connect,$id){
        $select = mysqli_query($connect, $query);
        if(mysqli_num_rows($select) ){
            while($day = mysqli_fetch_assoc($select)){
                $GLOBALS["name"][] = $day["name"];
                $GLOBALS["data"][] = $day["data"];
                $GLOBALS["address"][] = $day["address"];           
                $GLOBALS["rating"][] = $day["rating"];
                
            }
        }
    }
    popularityH($connect,$id);

    echo json_encode(
        array(
            'name' => $name,
            'rating' => $rating,
            'data' => $data,
            'address' => $address
        )
    );

?>