<?php 

require_once "../php/functions.php";
require_once "../php/dbh.php";

$server = "localhost";
$user = "root";
$ps = "";
$database = "covidtrack";

$connect = mysqli_connect($server, $user, $ps, $database);
if(!$connect){
    die("Error: Cannot connect to database" . mysqli_coonect_errno());
}



function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()';
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

$jsondata = file_get_contents("firstname.json");
$firstNameCollection = json_decode($jsondata,true);

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
for($i = 0; $i < 300;$i++) {
    $newFirstName = $firstNameCollection[rand(0, count($firstNameCollection)-1)];
    $newLastName = $lastNameCollection[rand(0, count($lastNameCollection)-1)];

    $fullNameCollection[] = $newFirstName." ".$newLastName;
}
foreach ($fullNameCollection as $key ) {
   
	$username= random_username($key);
	$email = "$username"."@mail.com";
	$password = randomPassword();
    createUser($connect, $username, $password, $email,0);
}
//Admin Users

    createUser($connect, "Giannis","A123123U","Janni@gmail.com",1);
    createUser($connect,"Xaris","123qwe!@#QWE","xaroulis@gmail.com",1);
?>