<?php
session_start();

require_once '../php/dbh.php';
// get the views
$sql = ("SELECT views FROM log  ORDER BY log . views DESC");
$select = mysqli_query($connect, $sql);
$dbViews = mysqli_fetch_assoc($select)['views'];
$_SESSION["views"] = $dbViews;

//get the total users
$sql = ("SELECT COUNT(username) as total FROM user");
$select = mysqli_query($connect, $sql);
$total = mysqli_fetch_assoc($select)['total'];
$_SESSION["total"] = $total;

//get the confirmed cases
$sql = ("SELECT COUNT(id) as ccNumber FROM hasCovid");
$select = mysqli_query($connect, $sql);
$ccNumber = mysqli_fetch_assoc($select)['ccNumber'];
$_SESSION["ccNumber"] = $ccNumber;

//get visits from CC
$sql = "SELECT COUNT(*) as tracker  from place INNER JOIN hascovid ON place.userID = hascovid.id WHERE day(hascovid.covid)>=day(hascovid.covid - INTERVAL 7 DAY) AND day(hascovid.covid)<=day(hascovid.covid + INTERVAL 14 DAY);";
$select = mysqli_query($connect, $sql);
$visits = mysqli_fetch_assoc($select)['tracker'];
$_SESSION["visits"] = $visits;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/adminDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="topbar" id="topbar">
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
                    <a href="#">
                    <i class="fas fa-th-large"></i>
                    <div>Dashboard</div>
                    </a>
                </li>

                <li>
                    <a href="adminAnalytics.php">
                    <i class="fas fa-chart-bar"></i>
                    <div>Analytics</div>
                    </a>
                </li>

                <li type="button" id="btn" onclick="doThis()">
                    <a class = "uploaded">
                    <i class="fa-solid fa-upload"></i>


                    <form id="form" action="../php/adminUpload.php" method="POST" enctype="multipart/form-data">
                        <input type="file" onchange="doThat()" accept=".json, .txt" id="file" name="files">
                        <input type="submit" name="submit" id="submitButton">
                    </form>
                    
                    <div class= "uploadfile">Upload</div>
                    </a>
                </li>


                <li  id="delete">
                    <a href="#">
                        <i class="fa-solid fa-trash-can"></i>
                    <div>Delete POIs</div>
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
        <div class="main" id="main">

        <div class="alert" id="alert">
            <span class="closebtn" id="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p id="text">...</p>
        </div> 

            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $_SESSION["views"];?></div>
                        <div class="card-name">Views</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $_SESSION["total"];?></div> 
                        <div class="card-name">Total Users</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $_SESSION["ccNumber"];?></div> 
                        <div class="card-name">Confirmed Cases</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-mask-face"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="number"><?php echo $_SESSION["visits"];?></div>
                        <div class="card-name">Visits of CC</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-shop"></i>
                    </div>
                </div>
            </div>

            <div class="charts">
                <div class="chart">
                    <h2>Visits</h2>
                    <canvas id="lineChart"></canvas>
                    <div class="divisor">
                        <input type="date" name="start" id="start" min = '2019-12-31' value = "<?php echo date( "Y-m-d", strtotime('-6 days')); ?>" max = "<?php echo date('Y-m-d'); ?>">
                        <input type="date"name="end" id="end" value="<?php echo date('Y-m-d'); ?>" max = "<?php echo date('Y-m-d'); ?>">
                        <button id = "filter">filter</button>
                    </div>
                </div>


                <div class="chart" id="doughnutChart">
                    <h2>Covid Percentage</h2>
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        function doThis(){
            document.getElementById('btn').onclick = function() {
            document.getElementById('file').click();
            
        }
        
        }
        function doThat(){
            document.getElementById('submitButton').click();
            closebtn = document.getElementById("closebtn");
            closebtn.parentElement.style.display='block';
            text = document.getElementById("text");
            text.innerText = "Inserting POIs data to the database...";
            topbar = document.getElementById("topbar");
            main = document.getElementById("main");
            topbar.style.cursor = "wait"; 
            main.style.cursor = "wait";
        }

    </script>

    <script src="../javascript/deletePois.js"></script>
    <script src="../javascript/chart1.js"></script>
    <script src="../javascript/chart2.js"></script>
</body>

</html>