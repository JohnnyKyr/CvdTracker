<?php 

$server = "localhost";
$user = "root";
$ps = "";
$database = "covidtrack";

$connect = mysqli_connect($server, $user, $ps, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}



function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

	function random_username($string) {
		$pattern = " ";
		$firstPart = strstr(strtolower($string), $pattern, true);
		$secondPart = substr(strstr(strtolower($string), $pattern, false), 0,3);
		$nrRand = rand(0, 100);

		$username = trim($firstPart).trim($secondPart).trim($nrRand);
		return $username;
	}

$firstNameCollection = array("Harry","Ross",
                        "Bruce","Cook",
                        "Carolyn","Morgan",
                        "Albert","Walker",
                        "Randy","Reed",
                        "Larry","Barnes",
                        "Lois","Wilson",
                        "Jesse","Campbell",
                        "Ernest","Rogers",
                        "Theresa","Patterson",
                        "Henry","Simmons",
                        "Michelle","Perry",
                        "Frank","Butler",
                        "Shirley");

$middleNameCollection = array("Brooks",
                    "Rachel","Edwards",
                    "Christopher","Perez",
                    "Thomas","Baker",
                    "Sara","Moore",
                    "Chris","Bailey",
                    "Roger","Johnson",
                    "Marilyn","Thompson",
                    "Anthony","Evans",
                    "Julie","Hall",
                    "Paula","Phillips",
                    "Annie","Hernandez",
                    "Dorothy","Murphy",
                    "Alice","Howard");

$lastNameCollection = array("Ruth","Jackson",
                    "Debra","Allen",
                    "Gerald","Harris",
                    "Raymond","Carter",
                    "Jacqueline","Torres",
                    "Joseph","Nelson",
                    "Carlos","Sanchez",
                    "Ralph","Clark",
                    "Jean","Alexander",
                    "Stephen","Roberts",
                    "Eric","Long",
                    "Amanda","Scott",
                    "Teresa","Diaz",
                    "Wanda","Thomas");


$fullNameCollection = array();
for($i = 0; $i < 1000;$i++) {
    $newFirstName = $firstNameCollection[rand(0, count($firstNameCollection)-1)];
    $newMiddleName = $middleNameCollection[rand(0, count($middleNameCollection)-1)];
    $newLastName = $lastNameCollection[rand(0, count($lastNameCollection)-1)];

    $fullNameCollection[] = $newFirstName." ".$newMiddleName." ".$newLastName;
}
foreach ($fullNameCollection as $key ) {
	
	$username= random_username($key);
	$email = "$username"."@mail.com";
	$password = randomPassword();
	$uniqid = uniqid();
	$userQuery = "INSERT INTO user (id,username, password, email) VALUES ('$uniqid','$username','$password','$email')";
	$result = mysqli_query($connect, $userQuery);
	if (!$result){
	    die("Could not run query". mysqli_error($connect));
	}
	else{
	    print("User Added <br>");
	}
}


?>