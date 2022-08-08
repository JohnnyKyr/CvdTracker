<?php 


$server = "localhost";
$user = "root";
$ps = "";
$database = "covidtrack";
$GLOBALS['connect'] =  mysqli_connect($server, $user, $ps, $database);


if(!$GLOBALS["connect"]){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
	}

//Clear data from tables;
 mysqli_query($GLOBALS['connect'] ,"delete from poi;");

 //mysqli_query($GLOBALS['connect'] ,"delete from popularity;");





	function insertPoi($id,$name,$types,$address,$lat,$lng,$rating,$rating_n){
		
		$res = json_encode($types);
		
		$query = "INSERT INTO poi(id,name,types,address,lat,lng,rating,rating_n) VALUES('$id','$name','$res','$address','$lat','$lng','$rating','$rating_n')";

		$res = mysqli_query($GLOBALS['connect'] ,$query);

		if(!$res){
			echo "Error during insert Poi";
		}
	}

	

	function popularity($poiID,$day,$data){
		$res = json_encode($data);
		$query = "INSERT INTO popularity(popID,day,data) VALUES('$poiID','$day','$res')";
		$res = mysqli_query($GLOBALS['connect'] ,$query);

		if(!$res){
			echo "Error during insert popularity";
		}
	}


	function main($path){

	$jsondata = file_get_contents($path);
	$json = json_decode($jsondata,true);

	foreach ($json as $ele) {
		echo $ele["coordinates"]["lat"]. "<br>";
		insertPoi($ele["id"],$ele["name"],$ele["types"],$ele["address"],$ele["coordinates"]["lat"],$ele["coordinates"]["lng"],$ele["rating"],$ele["rating_n"]);
		
		foreach ($ele["populartimes"] as $day) {
			popularity($ele["id"],$day["name"],$day["data"]);
			
		}	
	}	
}
	main("../../../data/starting_pois.json");
	main("../../../data/generic.json");
	main("../../../data/specific.json");
	

 ?>