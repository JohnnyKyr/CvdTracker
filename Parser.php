<?php 

//TO DO:
// Find a way to add arrays into the db;


$server = "localhost";
$user = "root";
$ps = "";
$database = "covidtrack";
$GLOBALS['connect'] =  mysqli_connect($server, $user, $ps, $database);


if(!$GLOBALS["connect"]){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
	}
 mysqli_query($GLOBALS['connect'] ,"delete from poi;");
 mysqli_query($GLOBALS['connect'] ,"delete from coords;");
 mysqli_query($GLOBALS['connect'] ,"delete from popularity;");





	function insertPoi($id,$name,$address,$types,$coords,$rating,$rating_n){
	

		$prep = array();
		foreach($types as $k=>$v){
			$prep[':'.$k] = $v;
		}
		$prep = array();
		



		$query = "INSERT INTO poi(id,name,address,types,coordinates,rating,rating_n) VALUES('$id','$name','$address',NULL,Null,'$rating','$rating_n')";

		$res = mysqli_query($GLOBALS['connect'] ,$query);

		if(!$res){
			echo "Error during insert Poi";
		}
	}

	function insertCoords($poiID,$lat,$lng){
		$query = "INSERT INTO coords(poiID,lat,lng) VALUES('$poiID','$lat','$lng')";
		$res = mysqli_query($GLOBALS['connect'] ,$query);

		if(!$res){
			echo "Error during insert Coords";
		}
	}

	function popularity($poiID,$day,$data){
		$query = "INSERT INTO popularity(poiID,day,data) VALUES('$poiID','$day',NULL)";
		$res = mysqli_query($GLOBALS['connect'] ,$query);

		if(!$res){
			echo "Error during insert popularity";
		}
	}




	$jsondata = file_get_contents("..\generic.json");
	$json = json_decode($jsondata,true);

	foreach ($json as $ele) {
		insertPoi($ele["id"],$ele["name"],$ele["address"],$ele["types"],$ele["coordinates"],$ele["rating"],$ele["rating_n"]);
		insertCoords($ele["id"], $ele["coordinates"]["lat"], $ele["coordinates"]["lng"]);
		foreach ($ele["populartimes"] as $day) {
			popularity($ele["id"],$day["name"],$day["data"]);
			
		}	
	}	

 ?>
