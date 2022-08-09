
<?php
session_start();

require_once '../php/dbh.php';

// get the views from the database
// $sql = ("SELECT views FROM views");
// $select = mysqli_query($connect, $sql);
// $dbViews = mysqli_fetch_assoc($select)['views'];
// $_SESSION["views"] = $dbViews;

// if(isset($_SESSION['views'])){
//     $_SESSION['views']++;
// }

// $views = $_SESSION["views"];

// // update views to the database
// $sql = ("UPDATE views SET views = '$views'");
// $select = mysqli_query($connect, $sql);

$userID = $_SESSION["username"];
$timezone = date_default_timezone_set('Europe/Athens');
$timestamp = date('Y/m/d h:i:s ', time());
// insert name and timestamp into the database
$sql = ("INSERT INTO log(userID, tmstmp) VALUES('$userID','$timestamp')");
$select = mysqli_query($connect, $sql);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVDtrack User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/adminDashboard.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>
    
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
    <style>#map { height: 500px; box-shadow: 0 7px 25px 0 rgba(0, 0, 0, 0.5); margin: 10px 100px; }</style>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2>CVDtrack</h2>
            </div>
            <div class="search">
                <input type="text" id="searcn" placeholder="search">
                <label for="search"> <i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell"></i>
            <div class="user">
                <img src="../images/user.png" alt="user image">
            </div>
        </div>


        <div class="sidebar">
            <ul>
            <li>
                    <a href="user.php">
                    <i class="fa-solid fa-map"></i>
                    <div>Map</div>
                    </a>
                </li>

                <li>
                    <a href="userTest.php">
                    <i class="fa-solid fa-virus"></i>
                    <div>Test</div>
                    </a>
                </li>

                <li>
                    <a href="userList.php">
                    <i class="fa-solid fa-rectangle-list"></i>
                    <div>List</div>
                    </a>
                </li>
          
                <li>
                    <a href="userSettings.php">
                    <i class="fas fa-cog"></i>
                    <div>Settings</div>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        
                        <i class="fa-solid fa-right-from-bracket"></i>
                    <div>Log Out</div>
                    </a>
                </li>

            </ul>
        </div>

        <div class="main">
            <div id="map"></div>
                
                <button type="submit" id="submit" name="map-submit">Show Map</button>
                <button type="center" id= "center" name="map-center">User </button>             
                <button type="bot" id= "bot" name="bot-mover">$Enable User Movement </button>    


        </div>
    </div>

    <script>
        var defaultPos = {coords :[38.25, 21.745] , zoom :12};

        var map = L.map('map').setView(defaultPos.coords,defaultPos.zoom);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    </script>
    <script src="../javascript/map.js"></script>
    <!-- <script src="../javascript/user.js"></script> -->
    
</body>

</html>