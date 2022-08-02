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

 mysqli_query($GLOBALS['connect'] ,"delete from popularity;");





	function insertPoi($id,$name,$types,$address,$coords,$rating,$rating_n){
		
		$res = json_encode($types);
		$jcoords = json_encode($coords);

		$query = "INSERT INTO poi(id,name,types,address,coords,rating,rating_n) VALUES('$id','$name','$res','$address','$jcoords','$rating','$rating_n')";

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




	$jsondata = file_get_contents("C:\\xampp\htdocs\data\generic.json");
	$json = json_decode($jsondata,true);

	foreach ($json as $ele) {
		insertPoi($ele["id"],$ele["name"],$ele["types"],$ele["address"],$ele["coordinates"],$ele["rating"],$ele["rating_n"]);
		
		foreach ($ele["populartimes"] as $day) {
			popularity($ele["id"],$day["name"],$day["data"]);
			
		}	
	}	

 ?>