<?php

    $name = array();
    $rating = array();
    require_once "dbh.php";
    function popularityH($connect){
        $select = mysqli_query($connect, "SELECT name,rating FROM poi ;");
        if(mysqli_num_rows($select) ){
            while($day = mysqli_fetch_assoc($select)){
                $GLOBALS["name"][] = $day["name"];
                           
                $GLOBALS["rating"][] = $day["rating"];
                
            }
        }
    }
    popularityH($connect);

?>