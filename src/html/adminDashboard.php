<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/adminDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.0/dist/chart.min.js"></script>
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
                    <a href="#">
                    <i class="fas fa-th-large"></i>
                    <div>Dashboard</div>
                    </a>
                </li>

                <li>
                    <a href="#">
                    <i class="fas fa-chart-bar"></i>
                    <div>Analytics</div>
                    </a>
                </li>
          
                <li>
                    <a href="#">
                    <i class="fas fa-cog"></i>
                    <div>Settings</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa-solid fa-upload"></i>
                    <div>Upload</div>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    <div>Log Out</div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="main">
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number">1217</div>
                        <div class="card-name">Views</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <div class="number">68</div>
                        <div class="card-name">Total</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-database"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <div class="number">42</div>
                        <div class="card-name">Confirmed Cases</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-mask-face"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="number">250</div>
                        <div class="card-name">Views of CC</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-arrows-to-eye"></i>
                    </div>
                </div>
            </div>

            <div class="charts">
                <div class="chart">
                    <h2>Earnings (past 12 months)</h2>
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="chart" id="doughnutChart">
                    <h2>Employees</h2>
                    <canvas id="doughnut"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="../javascript/chart1.js"></script>
    <script src="../javascript/chart2.js"></script>
</body>

</html>